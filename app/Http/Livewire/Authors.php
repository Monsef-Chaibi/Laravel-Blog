<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;
use Nette\Utils\Random;

class Authors extends Component
{
    use WithPagination;
    public $name, $username, $email, $author_type, $direct_publisher;
    public $search;
    public $selected_author_id;
    public $blocked = 0;
    public $perpage = 6;

    protected $listeners = [
        'resetForm',
        "deleteAuthorAction"
    ];

    public function mount()
    {
        $this->resetPage();
    }

    public function resetForm()
    {
        $this->reset(); // This will reset all Livewire component data properties to their default values.
        $this->resetValidation(); // This will clear all validation errors.
    }

    public function addAuthor()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username|min:6|max:20',
            'author_type' => 'required',
            "direct_publisher" => 'required',
        ], [
            'author_type.required' => 'Choose author type',
            'direct_publisher.required' => 'Specify author publication access',
        ]);

        if ($this->isOnline()) {
            $default_password = Random::generate(8);

            $author = new User();
            $author->name = $this->name;
            $author->username = $this->username;
            $author->email = $this->email;
            $author->password = Hash::make($default_password);
            $author->role = $this->author_type;
            $author->direct_publish = $this->direct_publisher;
            $saved = $author->save();

            $data = array(
                'name' => $this->name,
                'username' => $this->username,
                'email' => $this->email,
                'password' => $default_password,
                'url' => route('author.profile')
            );

            $author_name = $this->name;
            $author_email = $this->email;
            if ($saved) {
                Mail::send('layouts.partials.frontend.email.new-author-email-template', $data, function ($message) use ($author_name, $author_email) {
                    $message->from('reply@example.com', 'blog');
                    $message->to($author_email, $author_name)->subject('Account creation');
                });
                toastr()->success('New author has been added to blog.');
                $this->resetForm();
                $this->dispatchBrowserEvent('hide-modal');
            } else {
                toastr()->error('Somthing Went Wrong..!');
            }
        } else {
            toastr()->error('You are offline, check your connection and submit form again later');
        }
    }

    public function isOnline($site = "https://www.youtube.com/")
    {
        if (fopen($site, 'r')) {
            return true;
        } else {
            return false;
        }
    }

    public function editAuthor($author)
    {
        $this->selected_author_id = $author['id'];
        $this->name = $author['name'];
        $this->email = $author['email'];
        $this->username = $author['username'];
        $this->author_type = $author['role'];
        $this->direct_publisher = $author['direct_publish'];
        $this->blocked = $author['blocked'];
        // $this->dispatchBrowserEvent('showEditAuthorModel');
    }

    public function updateAuthor()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->selected_author_id,
            'username' => 'required|min:6|max:20|unique:users,username,' . $this->selected_author_id,
            'author_type' => 'required',
            "direct_publisher" => 'required',
        ]);

        if ($this->selected_author_id) {
            $author = User::find($this->selected_author_id);
            $author->update([
                'name' => $this->name,
                'email' =>  $this->email,
                'username' =>  $this->username,
                'role' =>  $this->author_type,
                "direct_publisher" =>  $this->direct_publisher,
                "blocked" => $this->blocked,
            ]);

            $this->dispatchBrowserEvent('hide_edit_author_modal');
            toastr()->success('Author details has been successfully updated.');
        }
    }

    public function deleteAuthor($author)
    {
        $this->selected_author_id = $author['id'];
    }

    public function destroyAuthor()
    {
        $author = User::find($this->selected_author_id);
        if (File::exists($author->picture)) {
            if (public_path($author->picture) != "C:\Users\EL MaaZouZi\OneDrive\Documents\projet_stage\public\uploads/profile/default_profile_picture.jpg") {
                File::delete($author->picture);
            }
        }
        $author->delete();
        toastr()->info('Author has been deleted.');
        $this->dispatchBrowserEvent('deleteAuthorAction');
    }

    public function render()
    {
        return view('livewire.authors', [
            'authors' => User::when($this->search, function ($query) {
                $query->where('name', 'LIKE', '%' . trim($this->search) . '%')
                    ->orWhere('email', 'LIKE', '%' . trim($this->search) . '%')
                    ->orWhere('username', 'LIKE', '%' . trim($this->search) . '%');
            })->paginate($this->perpage)
        ]);
    }
}
