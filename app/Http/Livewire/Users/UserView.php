<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class UserView extends Component
{
    public $users;
    public $search;
    protected $listeners = ['refreshUserTable' => 'mount'];

    public function mount()
    {
        $this->users = $this->searchQuery();
    }

    public function deleteUser($id)
    {
        User::whereId($id)->delete();
        $this->emit('refreshUserTable');
    }

    public function searchQuery()
    {
        $query = User::role('user')
            ->with('courses');
        if ($this->search) {
            $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        return  $query->get();
    }

    public function render()
    {
        return view('livewire.users.user-view');
    }

    public function updatedSearch()
    {
        $this->users =  $this->searchQuery();
    }
}
