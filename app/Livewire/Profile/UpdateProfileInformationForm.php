<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateProfileInformationForm extends Component
{

    public $name;

    public function mount()
    {
        $this->name = Auth::user()->name;
    }

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:65'],
        ];
    }


    public function save()
    {
        $this->validate();

        $user = Auth::user();

        $user->update([
            'name' => $this->name
        ]);


        session()->flash('message', 'Profile updated successfully.');
    }

    public function render()
    {
        return view('livewire.profile.update-profile-information-form');
    }
}
