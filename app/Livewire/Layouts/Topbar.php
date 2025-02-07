<?php

namespace App\Livewire\Layouts;

use Livewire\Component;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Events\NotificationEvent;

class Topbar extends Component
{
    public $showNotificationDropdown = false;
    public $showUserDropdown = false;
    public $showMobileMenu = false;
    public $notifications = [];

    protected $listeners = [
        'closeDropdowns' => 'closeDropdowns',
        'echo-private:notifications.' . 'user_id' . ',notification.received' => 'refreshNotifications',
    ];

    public function mount()
    {
        $this->notifications = Notification::where('user_id', Auth::id())->latest()->get();
    }

    public function toggleMobileMenu()
    {
        $this->showMobileMenu = !$this->showMobileMenu;
    }

    public function toggleNotificationDropdown()
    {
        $this->showNotificationDropdown = !$this->showNotificationDropdown;
        $this->showUserDropdown = false;
    }

    public function toggleUserDropdown()
    {
        $this->showUserDropdown = !$this->showUserDropdown;
        $this->showNotificationDropdown = false;
    }

    public function closeDropdowns()
    {
        $this->showNotificationDropdown = false;
        $this->showUserDropdown = false;
    }

    public function refreshNotifications()
    {
        $this->notifications = Notification::where('user_id', Auth::id())->latest()->get();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.layouts.topbar');
    }
}















// namespace App\Livewire\Layouts;

// use Livewire\Component;
// use App\Models\Notification;
// use Illuminate\Support\Facades\Auth;

// class Topbar extends Component
// {
//     public $showNotificationDropdown = false;
//     public $showUserDropdown = false;
//     public $showMobileMenu = false;


//     protected $listeners = ['closeDropdowns' => 'closeDropdowns'];
//     public function toggleMobileMenu()
//     {
//         $this->showMobileMenu = !$this->showMobileMenu;
//     }

//     public function toggleNotificationDropdown()
//     {
//         $this->showNotificationDropdown = !$this->showNotificationDropdown;
//         $this->showUserDropdown = false;
//     }

//     public function toggleUserDropdown()
//     {
//         $this->showUserDropdown = !$this->showUserDropdown;
//         $this->showNotificationDropdown = false;
//     }

//     public function closeDropdowns()
//     {
//         $this->showNotificationDropdown = false;
//         $this->showUserDropdown = false;
//     }

//     public function logout()
//     {
//         Auth::logout();
//         return redirect()->route('login');
//     }

//     public function render()
//     {
//         return view('livewire.layouts.topbar');
//     }
// }
