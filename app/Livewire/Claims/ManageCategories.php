<?php

namespace App\Livewire\Claims;

use Livewire\Component;
use App\Models\ClaimsCategory;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;

class ManageCategories extends Component
{
    public $name, $description, $category_id;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:500',
    ];

    public function store()
    {
        $this->validate();

        ClaimsCategory::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Category added successfully.');
        $this->resetInput();
        $this->dispatch('close-add-category-modal');
        $this->dispatch('refreshCategories'); // Notify Livewire to refresh
    }

    public function edit($id)
    {
        $category = ClaimsCategory::findOrFail($id);
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->dispatch('showEditModal');
    }

    public function update()
    {
        $this->validate();

        if ($this->category_id) {
            $category = ClaimsCategory::find($this->category_id);
            $category->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            session()->flash('update', 'Category updated successfully.');
            $this->resetInput();
            $this->dispatch('close-edit-category-modal');
            $this->dispatch('refreshCategories');
        }
    }


    public function delete($id)
    {
        ClaimsCategory::findOrFail($id)->delete();
        session()->flash('delete', 'Category deleted successfully.');
        $this->dispatch('refreshCategories'); // Notify Livewire to refresh
    }

    private function resetInput()
    {
        $this->category_id = null;
        $this->name = '';
        $this->description = '';
    }

    public function render()
    {
        return view('livewire.claims.manage-categories', [
            'categories' => ClaimsCategory::all(), // Always fetch fresh data
        ]);
    }
}
