<?php

namespace App\Livewire\Helpdesk;

use Livewire\Component;
use App\Models\TicketCategory;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;

class ManageCategories extends Component
{
    public $category_name, $description, $category_id;

    protected $rules = [
        'category_name' => 'required|string|max:255',
        'description' => 'required|string|max:500',
    ];

    public function store()
    {
        $this->validate();

        TicketCategory::create([
            'category_name' => $this->category_name,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Category added successfully.');
        $this->resetInput();
        $this->dispatch('close-add-category-modal');
        $this->dispatch('refreshCategories'); // Notify Livewire to refresh
    }

    public function edit($id)
    {
        $category = TicketCategory::findOrFail($id);
        $this->category_id = $category->id;
        $this->category_name = $category->category_name;
        $this->description = $category->description;

        $this->dispatch('showEditModal');
    }

    public function update()
    {
        $this->validate();

        if ($this->category_id) {
            $category = TicketCategory::find($this->category_id);
            $category->update([
                'category_name' => $this->category_name,
                'description' => $this->description,
            ]);

            session()->flash('update', 'Category updated successfully.');
            $this->resetInput();
            $this->dispatch('close-edit-category-modal');
            $this->dispatch('refreshCategories'); // Notify Livewire to refresh
        }
    }

    public function delete($id)
    {
        TicketCategory::findOrFail($id)->delete();
        session()->flash('delete', 'Category deleted successfully.');
        $this->dispatch('refreshCategories'); // Notify Livewire to refresh
    }

    private function resetInput()
    {
        $this->category_id = null;
        $this->category_name = '';
        $this->description = '';
    }

    #[On('refreshCategories')] // 👈 Listen for event and reload data
    public function render()
    {
        return view('livewire.helpdesk.manage-categories', [
            'categories' => TicketCategory::all(), // Always fetch fresh data
        ]);
    }
}

