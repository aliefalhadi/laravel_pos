<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class TambahUser extends Component
{
    public $name;
    public $email;
    public $password;
    public $type='admin';

    public function resetForm(){
         $this->name ='';
     $this->email = '';
    $this->password = '';
     $this->type='admin';
    }

    public function create()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'type' => 'required',
            ]);


         User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->name),
                'type' => $this->type,
            ]);
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Berhasil menambahkan data']);

        $this->emit('hideModal');

        $this->resetForm();

        $this->emit('refreshData');
    }

    public function render()
    {
        return view('livewire.user.tambah-user');
    }
}
