<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateProfileInformationForm extends Component
{
    use WithFileUploads;

    public $photo;
    public $name;

    public function mount()
    {
        $this->name = Auth::user()->name;
    }

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:65'],
            'photo' => ['nullable', 'image', 'max:5120'], // 5MB Max
        ];
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => ['image', 'max:5120']
        ]);
    }

    public function save()
    {
        $this->validate();

        $user = Auth::user();

        if ($this->photo) {
            $path = $this->photo->store('profile-photos', 'public');

            // Delete old photo if exists
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            $user->update([
                'profile_photo_path' => $path
            ]);
        }

        $user->update([
            'name' => $this->name
        ]);

        // Changed from emit to dispatch
        $this->dispatch('profile-updated');

        session()->flash('message', 'Profile updated successfully.');
        $this->photo = null; // Reset photo after save
    }
    public function render()
    {
        return view('livewire.profile.update-profile-information-form');
    }
}
