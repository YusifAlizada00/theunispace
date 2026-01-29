<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class SaveButton extends Component
{
    public $post;
    public $isSaved;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->isSaved = Auth::user()->savedPost()->where('post_id', $post->id)->exists();
    }
    public function save()
    {
        auth()->user()->savedPost()->attach($this->post->id);
        $this->isSaved = true;
    }

    public function unsave()
    {
        auth()->user()->savedPost()->detach($this->post->id);
        $this->isSaved = false;
    }

    public function render()
    {
        return view('livewire.save-button');
    }
}
