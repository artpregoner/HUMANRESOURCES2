<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordForm extends Component
{
    public $current_password;
    public $password;
    public $password_confirmation;

    protected function rules()
    {
        return [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', Password::defaults(), 'confirmed'],
        ];
    }

    public function updatePassword()
    {
        $this->validate();

        if (!Hash::check($this->current_password, auth()->user()->password)) {
            $this->addError('current_password', 'The provided password does not match your current password.');
            return;
        }

        auth()->user()->update([
            'password' => Hash::make($this->password)
        ]);

        $this->reset(['current_password', 'password', 'password_confirmation']);
        session()->flash('message', 'Password updated successfully.');
    }
    public function render()
    {
        return view('livewire.profile.update-password-form');
    }
}
