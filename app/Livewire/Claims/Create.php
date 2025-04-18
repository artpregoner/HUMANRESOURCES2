<?php

namespace App\Livewire\Claims;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Claim;
use App\Models\ClaimItem;
use App\Models\ClaimsAttachment;
use App\Models\ClaimsCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Create extends Component
{
    use WithFileUploads;

    // Form Fields
    public $currency = 'PHP';
    public $expense_date;
    public $description;
    public $comments;
    public $reimbursement_required = true;
    public $fileSizes = [];


    // Claim Lines
    public $claim_lines = [];
    public $total = 0;
    public $maxLines = 5;

    // File Upload
    public $files = [];
    public $uploadProgress = 0;



    protected function rules()
    {
        return [
            'currency' => 'required|in:PHP,USD',
            'expense_date' => 'required|date_format:Y-m-d\TH:i|before_or_equal:now',
            'description' => 'required|string|max:255',
            'comments' => 'nullable|string',
            'reimbursement_required' => 'boolean',
            'claim_lines.*.category' => 'required|exists:claims_categories,id',
            'claim_lines.*.details' => 'required|string|max:255',
            'claim_lines.*.amount' => 'required|numeric|min:0.01|max:99999.99',
            'files.*' => 'image|max:4048',
        ];
    }


    protected $messages = [
        'expense_date.required' => 'The date field is required.',
        'expense_date.date_format' => 'Please enter a valid date and time in the format YYYY-MM-DD HH:MM.',
        'expense_date.before_or_equal' => 'The date cannot be in the future.',
        'claim_lines.*.category.required' => 'The category field is required.',
        'claim_lines.*.details.required' => 'The details field is required.',
        'claim_lines.*.amount.required' => 'The amount field is required.',
        'claim_lines.*.amount.min' => 'The amount must be greater than 0.',
        'claim_lines.*.amount.max' => 'The maximum amount is 99999.99 per line',
        'description.*.required'=> 'The description field is required.',
    ];


    public function mount()
    {
        // $this->expense_date = date('Y-m-d H:i');
        $this->expense_date = now()->format('Y-m-d\TH:i');
        $this->claim_lines = [[
            'category' => '',
            'details' => '',
            'amount' => '',
            'is_fixed' => true
        ]];
    }


    public function updatedFiles()
    {
        // Allowed file extensions
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];

        // Validate each file before processing
        foreach ($this->files as $index => $file) {
            $extension = strtolower($file->getClientOriginalExtension());

            // Remove unsupported file formats
            if (!in_array($extension, $allowedExtensions)) {
                unset($this->files[$index]);
                session()->flash('error', "File format .$extension is not allowed.");
            }
        }

        // Reindex the array after removing invalid files
        $this->files = array_values($this->files);

        // Check max file count
        if (count($this->files) > 10) {
            $this->reset('files');
            session()->flash('error', 'You can only upload up to 10 images.');
            return;
        }

        // Store file sizes
        $this->fileSizes = array_map(fn($file) => $file->getSize(), $this->files);

        $this->uploadProgress = empty($this->files) ? 0 : 100;
    }



    public function removeFile($index)
    {
        unset($this->files[$index]);
        $this->files = array_values($this->files);
        if (empty($this->files)) {
            $this->uploadProgress = 0;
        }
    }


    public function addClaimLine()
    {
        if (count($this->claim_lines) < $this->maxLines) {
            $this->claim_lines[] = [
                'category' => '',
                'details' => '',
                'amount' => '',
                'is_fixed' => false
            ];
            $this->calculateTotal();
        }
    }


    public function removeClaimLine($index)
    {
        if (!$this->claim_lines[$index]['is_fixed']) {
            unset($this->claim_lines[$index]);
            $this->claim_lines = array_values($this->claim_lines);
            $this->calculateTotal();
        }
    }


    public function updatedClaimLines()
    {
        $this->calculateTotal();
    }


    public function updated($propertyName)
    {
        if ($propertyName === 'currency') {
            $this->calculateTotal(); // Ensure recalculation
            $this->dispatch('totalUpdated', $this->formattedTotal()); // Force Livewire to update UI
        }

        if (str_starts_with($propertyName, 'claim_lines')) {
            $this->calculateTotal();
        }
    }



    private function calculateTotal()
    {
        $this->total = collect($this->claim_lines)
            ->sum(function($line) {
                return is_numeric($line['amount']) ? floatval($line['amount']) : 0;
            });

            // Dispatch an event to update the UI in real-time
            $this->dispatch('totalUpdated', $this->formattedTotal());
    }


    // This function ensures the total amount is formatted with the currency
    public function formattedTotal()
    {
        return number_format($this->total, 2) . ' ' . strtoupper($this->currency);
    }



    private function saveAttachments($claim)
    {
        foreach ($this->files as $file) {
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('claims/receipt' . $claim->id, $filename, 'public');

            ClaimsAttachment::create([
                'claim_id' => $claim->id,
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'file_type' => $file->getMimeType(),
                'file_size' => $file->getSize()
            ]);
        }
    }



    public function submit()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            // Convert to proper format before saving
            $formattedDate = Carbon::createFromFormat('Y-m-d\TH:i', $this->expense_date)->format('Y-m-d H:i:s');
            // Debugging: Check if the conversion is correct
            // dd($this->expense_date, $formattedDate);

            $claim = Claim::create([
                'user_id' => Auth::id(),
                'submitted_by_id' => Auth::id(),
                'expense_date' => $formattedDate, // Save properly formatted date
                'description' => $this->description,
                'comments' => $this->comments,
                'status' => 'submitted',
                'reimbursement_required' => $this->reimbursement_required,
                'total_amount' => $this->total,
                'currency' => $this->currency
            ]);
            // dd($claim);

            // Save claim items
            foreach ($this->claim_lines as $line) {
                ClaimItem::create([
                    'claim_id' => $claim->id,
                    'category_id' => $line['category'],
                    'details' => $line['details'],
                    'amount' => $line['amount'],
                    'currency' => $this->currency
                ]);
            }

            // Save attachments if any
            if (count($this->files) > 0) {
                $this->saveAttachments($claim);
            }

            DB::commit();

            session()->flash('success', 'Claim submitted successfully!');
            return redirect()->route('portal.claims.show', $claim->id);

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error: ' . $e->getMessage());
            logger()->error('Claim submission error: ' . $e->getMessage());
        }
    }



    public function render()
    {
        return view('livewire.claims.create', [
            'categories' => ClaimsCategory::where('is_active', true)->get(),
            'canAddMore' => count($this->claim_lines) < $this->maxLines
        ]);
    }
}


