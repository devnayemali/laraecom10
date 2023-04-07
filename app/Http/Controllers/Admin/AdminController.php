<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function dashboard()
    {
        return view('admin.modules.dashboard');
    }

    public function profile()
    {
        $adminData = Auth::user();
        return view('admin.modules.profile.profile', compact('adminData'));
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
                }else{
                    session()->flash('cls', 'danger');
                    session()->flash('msg', 'New Password and Confirm Password are not same.');
                    return redirect()->back();
                }
            } else {
                session()->flash('cls', 'danger');
                session()->flash('msg', 'Your Current Password is not correct');
                return redirect()->back();
            }
        }
    }
}
