<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $profile = Auth::user();
        return view('admin.modules.profile.profile', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => ['email', 'max:255']
            ]);
            $data = $request->except(['_token', 'old_image']);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $name = Str::slug($request->input('name'));
                $height = 300;
                $width = 300;
                $path = 'image/profile/';

                // Image Delete
                PhotoUploadController::imageUnlink($path, $request->old_image);
                // crop image upload
                $data['image'] = PhotoUploadController::imageUpload($name, $width, $height, $path, $file);
            }

            $data['id'] = Auth::id();
            User::where('id', $data['id'])->update($data);
            session()->flash('cls', 'success');
            session()->flash('pmsg', 'Profile Updated Successfully.');
            return redirect()->route('admin.profile');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function check_current_password(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();
            if (Hash::check($data['current_password'], Auth::user()->password)) {
                return "true";
            } else {
                return "false";
            }
        }
    }

    public function update_password(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();
            if (Hash::check($data['current_password'], Auth::user()->password)) {
                if ($data['new_password'] == $data['confirm_password']) {
                    User::where('id', Auth::id())->update(['password' => bcrypt($data['new_password'])]);
                    session()->flash('cls', 'success');
                    session()->flash('msg', 'Password Updated Successfully.');
                    return redirect()->back();
                } else {
                    session()->flash('cls', 'danger');
                    session()->flash('msg', 'New Password and Confirm Password are not correct.');
                    return redirect()->back();
                }
            } else {
                session()->flash('cls', 'danger');
                session()->flash('msg', 'Your Current Password is not correct.');
                return redirect()->back();
            }
        }
    }

}
