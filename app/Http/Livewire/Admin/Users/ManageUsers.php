<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ManageUsers extends Component
{
    use WithPagination;
    public function render()
    {
        $users = User::latest()->paginate(10);
        return view('livewire.admin.users.manage-users', compact('users'));
    }
}