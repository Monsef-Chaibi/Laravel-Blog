<?php

namespace App\Http\Controllers\Auth\Author;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AuthorController extends Controller
{
    public function index()
    {
        return view('layouts.partials.frontend.pages.inc.profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['nullable', 'string'],
            'username' => ['nullable', 'string'],
            'country' => ['nullable', 'string'],
            'state' => ['nullable', 'string'],
            'bio' => ['nullable', 'string', 'max:500'],
            'picture' => ['nullable', 'image', 'max:500'],
            'current_password' => ['nullable', function ($attribute, $value, $fail) {
                if (!Hash::check($value, User::find(auth()->user()->id)->password)) {
                    return $fail('The current password is incorrect..!');
                }
            }],
            'new_password' => ['nullable', 'min:8', 'max:25'],
            'confirm_new_password' => ['nullable', 'same:new_password']
        ]);
        $uploadPath = 'uploads/profile/';
        if ($request->hasFile('picture')) {
            if (File::exists(Auth::user()->picture)) {
                if (public_path(Auth::user()->picture) != "") {
                    File::delete(Auth::user()->picture);
                }
            }
            $picture = $request->file('picture');
            $filename = time() . '.' . $picture->getClientOriginalExtension();
            $picture->move($uploadPath, $filename);
            $picturePathName = $uploadPath . $filename;
        }
        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'country' => $request->country,
            'state' => $request->state,
            'bio' => $request->bio,
            'password' => Hash::make($request->new_password),
            'picture' => $picturePathName ?? Auth::user()->picture
        ]);

        toastr()->info('User Profile Info have been succesfully Updated..!');
        return redirect()->back();
    }
}
