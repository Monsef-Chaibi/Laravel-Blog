<?php

namespace App\Http\Controllers\Auth\Author;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GeneralSettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::get()->first();
        return view('layouts.partials.admin.pages.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'blog_name' => ['required', 'string'],
            'blog_email' => ['required', 'string'],
            'blog_description' => ['required', 'string'],
        ]);

        $settings = Setting::get()->first();
        $query = $settings->update([
            'blog_name' => $request->blog_name,
            'blog_email' => $request->blog_email,
            'blog_description' => $request->blog_description,
        ]);

        if ($query) {
            toastr()->info('Settings Info have been succesfully Updated..!');
        } else {
            toastr()->error('Something went Wrong..!');
        }
        return redirect()->back();
    }

    public function changeBlogLogo(Request $request)
    {
        $request->validate([
            'blog_logo' => "image|mimes:png,jpg,jpeg"
        ]);

        $settings = Setting::get()->first();
        $logo_path = "uploads/logo/";
        $file = $request->file('blog_logo');
        $filename = $logo_path.time() . '_' . rand(1, 1000) . '_blog_logo.png';
        if ($request->hasFile('blog_logo')) {
            if (File::exists($settings->blog_logo)) {
                File::delete($settings->blog_logo);
            }
            $upload = $file->move($logo_path, $filename);
            $settings->update([
                'blog_logo' => $filename,
                'blog_favicon' => $filename
            ]);
            if ($upload) {
                toastr()->success('logo uploaded successfully..!');
            } else {
                toastr()->error('Something went Wrong..!');
            }
        }

        return redirect()->back();
    }
}
