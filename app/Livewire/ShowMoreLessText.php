<?php

namespace App\Livewire;

use Livewire\Component;

class ShowMoreLessText extends Component
{

    public $post;
    public $expanded = false;

    public function toggle()
    {
        $this->expanded = !$this->expanded;
    }

    public function render()
    {
        return view('livewire.show-more-less-text');
    }
}
