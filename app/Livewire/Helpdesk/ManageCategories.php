<?php

namespace App\Livewire\Helpdesk;

use Livewire\Component;
use App\Models\TicketCategory;
use App\Models\Ticket;
use Illuminate\Support\Facades\Session;

class ManageCategories extends Component
{
    public $categories, $category_name, $description, $category_id;

    protected $rules = [
        'category_name' => 'required|string|max:255',
        'description' => 'required|string|max:500',
    ];

    public function mount()
    {
        $this->categories = TicketCategory::all();
    }

    public function store()
    {
        $this->validate([
            'category_name' => 'required',
            'description' => 'required',
        ]);

        TicketCategory::create([
            'category_name' => $this->category_name,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Category added successfully.');

        $this->resetInput(); // Reset form fields
        $this->dispatch('close-add-category-modal'); // Trigger JavaScript event

        $this->dispatch('refreshCategories'); // Refresh category list

    }

    public function edit($id)
    {
        $category = TicketCategory::findOrFail($id);
        $this->category_id = $category->id;
        $this->category_name = $category->category_name;
        $this->description = $category->description;

        // Updated from $emit to dispatch
        $this->dispatch('showEditModal');
    }

    public function update()
    {
        $this->validate([
            'category_name' => 'required',
            'description' => 'required',
        ]);

        if ($this->category_id) {
            $category = TicketCategory::find($this->category_id);
            $category->update([
                'category_name' => $this->category_name,
                'description' => $this->description,
            ]);

            session()->flash('success', 'Category updated successfully.');

            $this->resetInput();
            $this->dispatch('close-edit-category-modal');
            $this->dispatch('refreshCategories'); // Refresh category list

        }
    }

    public function delete($id)
    {
        TicketCategory::findOrFail($id)->delete();
        Session::flash('success', 'Category deleted successfully.');
    }
    private function resetInput()
    {
        $this->category_id = null;
        $this->category_name = '';
        $this->description = '';
    }

    public function render()
    {
        return view('livewire.helpdesk.manage-categories', [
            'categories' => TicketCategory::all(), // Fetch fresh data
        ]);
    }

}
