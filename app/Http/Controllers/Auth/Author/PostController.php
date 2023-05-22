<?php

namespace App\Http\Controllers\Auth\Author;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function index()
    {
        $subcategories = SubCategory::all();
        return view('layouts.partials.admin.pages.add-post', compact('subcategories'));
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'post_title' => 'required|unique:posts,post_title',
            'post_slug' => 'required|unique:posts,post_slug',
            'post_category' => 'required|exists:sub_categories,id',
            'post_content' => 'required',
            'featured_image' => 'required|mimes:jpeg,jpg,png,webp|max:2048',
        ]);

        if ($request->hasFile('featured_image')) {
            $path = 'uploads/posts/';
            $file = $request->file('featured_image');
            $filename = $file->getClientOriginalName();
            $new_filename = time() . '_' . $filename;

            $upload = Storage::disk('public')->put($path . $new_filename, (string) file_get_contents($file));
            $file->move($path, $new_filename);
            $post_thumbnails_path = $path . 'thumbnails';
            if (!Storage::disk('public')->exists($post_thumbnails_path)) {
                Storage::disk('public')->makeDirectory($post_thumbnails_path, 0755, true, true);
            }

            //create square thumbnail
            Image::make(storage_path('app/public/' . $path . $new_filename))
                ->fit(200, 200)
                ->save(storage_path('app/public/' . $path . 'thumbnails/' . 'thumb_' . $new_filename));

            //create resized image
            Image::make(storage_path('app/public/' . $path . $new_filename))
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

    public function editPost(Request $request)
    {
        if (!request()->post_id) {
            return abort(404);
        } else {
            $post = Post::find(request()->post_id);
            $subcategories = SubCategory::all();
            $data = [
                "post" => $post,
                "pageTitle" => 'Edit Post',
            ];
            return view('layouts.partials.admin.pages.edit-post', $data, compact('subcategories'));
        }
    }

    public function updatePost(Request $request)
    {
        if ($request->hasFile('featured_image')) {
            $request->validate([
                'post_title' => 'required|unique:posts,post_title,' . $request->post_id,
                'post_slug' => 'required|unique:posts,post_slug,' . $request->post_id,
                'post_category' => 'required|exists:sub_categories,id',
                'post_content' => 'required',
                'featured_image' => 'mimes:jpeg,jpg,png,webp|max:2048',
            ]);
            $path = 'uploads/posts/';
            $file = $request->file('featured_image');
            $filename = $file->getClientOriginalName();
            $new_filename = time() . '_' . $filename;

            $upload = Storage::disk('public')->put($path . $new_filename, (string) file_get_contents($file));
            $file->move($path, $new_filename);

            $post_thumbnails_path = $path . 'thumbnails';
            if (!Storage::disk('public')->exists($post_thumbnails_path)) {
                Storage::disk('public')->makeDirectory($post_thumbnails_path, 0755, true, true);
            }
            //create square thumbnail
            Image::make(storage_path('app/public/' . $path . $new_filename))
                ->fit(200, 200)
                ->save(storage_path('app/public/' . $path . 'thumbnails/' . 'thumb_' . $new_filename));

            //create resized image
            Image::make(storage_path('app/public/' . $path . $new_filename))
                ->fit(530, 350)
                ->save(storage_path('app/public/' . $path . 'thumbnails/' . 'resized_' . $new_filename));

            if ($upload) {
                $old_post_image = Post::find($request->post_id)->featured_image;

                if ($old_post_image != null && Storage::disk('public')->exists($path . $old_post_image)) {
                    Storage::disk('public')->delete($path . $old_post_image);

                    if (Storage::disk('public')->exists($path . 'thumbnails/resized_' . $old_post_image)) {
                        Storage::disk('public')->delete($path . 'thumbnails/resized_' . $old_post_image);
                    }
                    if (Storage::disk('public')->exists($path . 'thumbnails/thumb_' . $old_post_image)) {
                        Storage::disk('public')->delete($path . 'thumbnails/thumb_' . $old_post_image);
                    }
                    if (File::exists($path . $old_post_image)) {
                        File::delete($path . $old_post_image);
                    }
                }
                $post = Post::find($request->post_id);
                $post->category_id = $request->post_category;
                $post->post_title = $request->post_title;
                $post->post_slug = $request->post_slug;
                $post->post_content = $request->post_content;
                $post->featured_image = $new_filename;
                $saved = $post->save();

                if ($saved) {
                    toastr()->success('Post has been successfully updated.');
                    return redirect()->to('/author/posts/all');
                } else {
                    toastr()->error('Something went wrong for updating this post.');
                    return redirect()->back();
                }
            } else {
                toastr()->success('Error in uploading new featured image.');
                return redirect()->back();
            }
        } else {
            $request->validate([
                'post_title' => 'required|unique:posts,post_title,' . $request->post_id,
                'post_content' => 'required',
                'post_category' => 'required|exists:sub_categories,id',
            ]);

            $post = Post::find($request->post_id);
            $post->category_id = $request->post_category;
            $post->post_title = $request->post_title;
            $post->post_slug = $request->post_slug;
            $post->post_content = $request->post_content;
            $saved = $post->save();

            if ($saved) {
                toastr()->success('Post has been successfully updated.');
                return redirect()->back();
            } else {
                toastr()->error('Something went wrong for updating this post.');
                return redirect()->back();
            }
        }
    }

    public function destroyPost(Request $request)
    {
        $post = Post::find($request->post_id);
        $path = 'uploads/posts/';
        $featured_image = $post->featured_image;

        if ($featured_image != null && Storage::disk('public')->exists($path . $featured_image)) {
            // delete resized image
            if (Storage::disk('public')->exists($path . 'thumbnails/resized_' . $featured_image)) {
                Storage::disk('public')->delete($path . 'thumbnails/resized_' . $featured_image);
            }
            //delete thumb image
            if (Storage::disk('public')->exists($path . 'thumbnails/thumb_' . $featured_image)) {
                Storage::disk('public')->delete($path . 'thumbnails/thumb_' . $featured_image);
            }
            // delete post featured image
            Storage::disk('public')->delete($path . $featured_image);
            if (File::exists($path . $featured_image)) {
                File::delete($path . $featured_image);
            }
        }
        $deleted = $post->delete();
        if ($deleted) {
            toastr()->success('Post has been successfully deleted.');
            return redirect()->back();
        } else {
            toastr()->success('Error in deleting this post.');
            return redirect()->back();
        }
    }
}
