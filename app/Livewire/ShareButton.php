<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class ShareButton extends Component
{
    public $post;
    public $isClicked = false;

    public function mount($post)
    {
        $this->post = $post;
    }

    public function showOverlay()
    {
        $this->isClicked = true;
    }

    public function hideOverlay()
    {
        $this->isClicked = false;
    }

    public function render()
    {
        return view('livewire.share-button', [
            'links' => [
                'facebook' => 'https://facebook.com/sharer/sharer.php?u=' . urlencode(route('single-post', $this->post->slug)),
                'twitter'  => 'https://twitter.com/intent/tweet?url=' . urlencode(route('single-post', $this->post->slug)),
                'linkedin' => 'https://www.linkedin.com/sharing/share-offsite/?url=' . urlencode(route('single-post', $this->post->slug)),
                'whatsapp' => 'https://wa.me/?text=' . urlencode(route('single-post', $this->post->slug)),
            ]
        ]);
    }
}
