<?php

namespace App\Http\Controllers\Auth\Author;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\CommentReply;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function postComment(Request $request, $post)
    {
        if (Auth::check()) {
            $post = Post::where('id', $post)->first();
            if ($post) {
                $data = $request->validate([
                    'comment' => 'required|string|max:500'
                ]);
                $saved = Comment::create([
                    "author_id" => auth()->user()->id,
                    "post_id" => $post->id,
                    "comment" => $data['comment'],
                ]);

                if ($saved) {
                    toastr()->success('Thank you for your comment! We appreciate your feedback');
                    return redirect()->back();
                } else {
                    toastr()->error('Something went wrong! try again later!');
                    return redirect()->back();
                }
            } else {
                toastr()->error('Unable to find the post!, Please refresh the page and try again.');
                return redirect()->back();
            }
        } else {
            toastr()->error('You must sign in first!');
            return redirect()->back();
        }
    }

    public function postCommentReply(Request $request, $commentId)
    {
        $data = $request->validate([
            'replyComment' => 'required|string|max:500'
        ]);

        $comment = Comment::where('id', $commentId)->first();

        if ($comment) {
            try {
                CommentReply::create([
                    "comment_id" => $commentId,
                    "author_id" => auth()->user()->id,
                    "reply_comment" => $data['replyComment'],
                ]);

                toastr()->success('Your reply has been posted successfully!');
                return redirect()->back();
            } catch (Exception $e) {
                toastr()->error('An error occurred while posting your reply.');
                return redirect()->back();
            }
        } else {
            toastr()->error('Something went wrong! Please try again later.');
            return redirect()->back();
        }
    }
}
