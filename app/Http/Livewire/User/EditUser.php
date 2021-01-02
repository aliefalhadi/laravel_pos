<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class EditUser extends Component
{
    public $idUser;
    public $name;
    public $email;
    public $type = "admin";

    protected $listeners = ["updateData"];

    public function updateData($data)
    {
        $this->idUser = $data["id"];
        $this->name = $data["name"];
        $this->email = $data["email"];
        $this->type = $data["type"];
    }

    public function update()
    {
        $this->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email," . $this->idUser,
            "type" => "required",
        ]);

        $user = User::where(["id" => $this->idUser])->first();

        $user->update([
            "name" => $this->name,
            "email" => $this->email,
            "type" => $this->type,
        ]);

        $this->dispatchBrowserEvent("alert", [
            "type" => "success",
            "message" => "Berhasil edit data",
        ]);

        $this->emit("hideModalEdit");

        $this->emit("refreshData");
    }

    public function render()
    {
        return view("livewire.user.edit-user");
    }
}
