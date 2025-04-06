<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateUserAvatar extends Component
{
    use WithFileUploads;

    public $photo;

    // Reset any error messages when the component initializes
    public function mount()
    {
        session()->forget('message');
    }

    public function cancelPhoto()
    {
        $this->reset('photo');
        $this->dispatch('photo-canceled');
    }

    public function removePhoto()
    {
        $user = Auth::user();

        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
            $user->profile_photo_path = null;
            $user->save();
        }

        $this->reset('photo');
        session()->flash('message', 'Profile photo removed successfully.');
        $this->dispatch('photo-removed');
    }

    public function save()
    {
        $this->validate([
            'photo' => ['required', 'image', 'max:5120'], // 5MB Max
        ]);

        $user = Auth::user();

        // Store the new photo
        $path = $this->photo->store('profile-photos', 'public');

        // Delete old photo if exists
        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        // Update user record
        $user->profile_photo_path = $path;
        $user->save();

        // Reset state and show success message
        $this->reset('photo');
        session()->flash('message', 'Profile photo updated successfully.');
        $this->dispatch('photo-updated');
    }

    public function render()
    {
        return view('livewire.profile.update-user-avatar');
    }
}
