<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogSocialMedia extends Model
{
    use HasFactory;

    protected $table = 'blog_social_media';

    protected $fillable = [
        "url_facebook",
        "url_instagram",
        "url_youtube",
        "url_twitter"
    ];
}
