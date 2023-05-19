<?php

namespace App\Http\Controllers\Auth\Author;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public $uploaded = false;
    public function index()
    {
        $subcategories = SubCategory::all();
        return view('layouts.partials.frontend.pages.add-post', compact('subcategories'), ['uploaded' => $this->uploaded]);
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'post_title' => 'required|unique:posts,post_title',
            'post_slug' => 'required|unique:posts,post_slug',
            'post_category' => 'required|exists:sub_categories,id',
            'post_content' => 'required',
            'featured_image' => 'required|mimes:jpeg,jpg,png|max:1024',
        ]);

        if ($request->hasFile('featured_image')) {
            $path = 'uploads/posts';
            $file = $request->file('featured_image');
            $filename = $file->getClientOriginalName();
            $new_filename = time() . '_' . $filename;

            $upload = Storage::disk('public')->put($path . $new_filename, (string) file_get_contents($file));
            $upload = $file->move($path, $new_filename);
            $post_thumbnails_path = $path . 'thumbnails';
            if (!Storage::disk('public')->exists($post_thumbnails_path)) {
                Storage::disk('public')->makeDirectory($post_thumbnails_path, 0755, true, true);
            }

            //create square thumbnail
            Image::make(storage_path('app/public/' . $path.$new_filename))
                ->fit(200, 200)
                ->save(storage_path('app/public/' . $path . 'thumbnails/' . 'thumb_' . $new_filename));

            //create resized image
            Image::make(storage_path('app/public/' . $path.$new_filename))
                ->fit(530, 350)
                ->save(storage_path('app/public/' . $path . 'thumbnails/' . 'resized_' . $new_filename));

            if ($upload) {
                $post = new Post();
                $post->author_id = auth()->id();
                $post->category_id = $request->post_category;
                $post->post_title = $request->post_title;
                $post->post_slug = Str::slug($request->post_slug);
                $post->post_content = $request->post_content;
                $post->featured_image = $new_filename;
                $saved = $post->save();
                if ($saved) {
                    toastr()->success('New Post has been successfully created.');
                    return redirect('author/posts/add-post');
                } else {
                    toastr()->error('Something went wrong for saveing post data.');
                    return redirect('author/posts/add-post');
                }
            } else {
                toastr()->error('Something went wrong for uploading featured image.');
                return redirect('author/posts/add-post');
            }
        }
    }
}
