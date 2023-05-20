<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\SubCategory;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AllPosts extends Component
{
    use WithPagination;
    public $perPage = 6;
    public $search = null;
    public $author = null;
    public $category = null;
    public $orderBy = "desc";

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingAuthor()
    {
        $this->resetPage();
    }

    public function render()
    {
        $subcategories = SubCategory::whereHas('posts')->get();
        $authors = User::whereHas('posts')->get();
        return view('livewire.all-posts', [
            'posts' => auth()->user()->role == 'admin' ?
                Post::search(trim($this->search))
                ->when($this->category, function ($query) {
                    $query->where('category_id', $this->category);
                })->when($this->author, function ($query) {
                    $query->where('author_id', $this->author);
                })->when($this->orderBy, function ($query) {
                    $query->orderBy('id', $this->orderBy);
                })
                ->paginate($this->perPage) :
                Post::search(trim($this->search))
                ->when($this->category, function ($query) {
                    $query->where('category_id', $this->category);
                })->when($this->orderBy, function ($query) {
                    $query->orderBy('id', $this->orderBy);
                })
                ->where('author_id', auth()->id())->paginate($this->perPage),
            "subcategories" => $subcategories,
            "authors" => $authors,
        ]);
    }
}
