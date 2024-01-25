<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class HomePosts extends Component
{
    use WithPagination;

    public $searchTerm;

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function searchPage()
    {
        $this->resetPage();
    }

    public function getPostsProperty()
    {
        return Post::where('title', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('content', 'like', '%' . $this->searchTerm . '%')
            ->latest()
            ->paginate(4);
    }

    public function render()
    {
        return view('livewire.home-posts')
            ->with('posts', $this->getPostsProperty());
    }
}
