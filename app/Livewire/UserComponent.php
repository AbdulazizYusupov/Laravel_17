<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class UserComponent extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;

    use WithFileUploads;
    public $activeForm = false;
    public $name;
    public $phone;
    public $email;
    public $password;
    public $image;
    public $role;

    public $editId;
    public $editName;
    public $editPhone;
    public $editEmail;
    public $editRole;
    public $editPassword;
    public $editImage;

    protected $rules = [
        'name' => 'required|max:255',
        'phone' => 'required|max:255',
        'email' => 'required|max:255',
        'password' => 'required|min:6',
        'role' => 'required',
        'image' => 'required|image|max:255|mimes:jpeg,png,jpg,svg',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $models = \App\Models\User::orderBy('id', 'desc')->where('role','!=','admin')->paginate(10);
        return view('livewire.user-component',['models' => $models]);
    }

    public function create()
    {
        $this->activeForm = true;
    }

    public function cancel()
    {
        $this->activeForm = false;
    }

    public function save()
    {
        $data = $this->validate();
        if ($this->image) {
            $imagePath = $this->image->store('images', 'public');
            $data['image'] = $imagePath;
        }
        \App\Models\User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
            'image' => $data['image'],
        ]);

        $this->activeForm = false;
        $this->reset(['name', 'phone', 'email', 'role', 'password', 'image']);
    }


    public function delete($id)
    {
        $post = \App\Models\User::findOrFail($id);
        if ($post) {
            $post->delete();
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->editId = $user->id;
        $this->editName = $user->name;
        $this->editPhone = $user->phone;
        $this->editEmail = $user->email;
        $this->editRole = $user->role;
        $this->editPassword = $user->password;
        $this->image = $user->image;
        $this->editImage = null;
    }


    public function update()
    {
        $user = User::findOrFail($this->editId);

        $filePath = $user->image;

        if ($this->editImage) {
            if ($filePath && file_exists(storage_path('app/public/' . $filePath))) {
                unlink(storage_path('app/public/' . $filePath));
            }
            $filePath = $this->editImage->store('images', 'public');
        }

        $user->update([
            'phone' => $this->editPhone,
            'name' => $this->editName,
            'image' => $filePath,
            'email' => $this->editEmail,
            'password' => Hash::make($this->editPassword),
            'role' => $this->editRole,
        ]);

        $this->reset('editPhone', 'editName', 'editEmail', 'editId', 'editImage', 'image','editPassword','editRole');
    }

}
