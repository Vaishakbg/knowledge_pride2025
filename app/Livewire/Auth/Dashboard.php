<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.auth.dashboard')->with('layout', 'components.layouts.app');
    }

    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    }
}

