<?php

namespace App\Http\Livewire;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class PostCreate extends Component
{

    public $title;
    public $content;
    public $images = [];

    public function addImage($image)
    {
        $this->images[] = $image;
    }

    public function save()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $post = Post::create([
            'title' => $this->title,
            'content' => $this->content
        ]);

        foreach ($this->images as $img) {

            $img = Image::where('path', $img)->first();

            if(strpos($post->content,$img)){
                $img->update([
                    'imageable_id' => $post->id,
                    'imageable_type' => Post::class
                ]);
            } else {
                Storage::delete($img);
                $img->delete();
            }

        }

        return redirect()->route('posts.show', $post);
    }
    public function render()
    {
        return view('livewire.post-create');
    }
}
