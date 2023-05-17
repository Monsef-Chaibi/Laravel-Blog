<?php

namespace App\Http\Livewire;

use App\Models\BlogSocialMedia as ModelsBlogSocialMedia;
use Livewire\Component;

class BlogSocialMedia extends Component
{
    public $blog_social_media;
    public $url_facebook, $url_youtube, $url_twitter, $url_instagram;
    public function mount()
    {
        $this->blog_social_media = ModelsBlogSocialMedia::find(1) ?? "";
        $this->url_facebook = $this->blog_social_media->url_facebook ?? "";
        $this->url_instagram = $this->blog_social_media->url_instagram ?? "";
        $this->url_twitter = $this->blog_social_media->url_twitter ?? "";
        $this->url_youtube = $this->blog_social_media->url_youtube ?? "";
    }

    public function updateBlogSocialMedia()
    {
        $this->validate([
            "url_facebook" => "nullable|url",
            "url_instagram" => "nullable|url",
            "url_twitter" => "nullable|url",
            "url_youtube" => "nullable|url",
        ]);

        if ($this->blog_social_media == null) {
            $updateData = ModelsBlogSocialMedia::get()->first()->update([
                "url_facebook" => $this->url_facebook,
                "url_instagram" => $this->url_instagram,
                "url_twitter" => $this->url_twitter,
                "url_youtube" => $this->url_youtube
            ]);
        }
        if ($updateData) {
            toastr()->success('Blog Social Media have been succesfully updated..!');
        } else {
            toastr()->error('Something Went Wrong..!');
        }

    }

    public function render()
    {
        return view('livewire.blog-social-media');
    }
}
