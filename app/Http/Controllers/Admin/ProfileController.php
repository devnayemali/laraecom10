<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorBusinessDetail;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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
    public function edit(): View
    {
        $profile = Auth::user();

        $profile_role = null;
        if ($profile->role == 1) {
            $profile_role = 'Super Admin';
        } elseif ($profile->role == 2) {
            $profile_role = 'Admin';
        } elseif ($profile->role == 3) {
            $profile_role = 'Vendor';
        } elseif ($profile->role == 4) {
            $profile_role = 'User';
        }

        return view('admin.modules.profile.profile', compact('profile', 'profile_role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => ['email', 'max:255']
            ]);
            $data = $request->except(['_token', 'old_image', 'role']);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $name = Str::slug($request->input('name'));
                $height = 300;
                $width = 300;
                $path = 'image/profile/';

                // Image Delete
                if (!empty($request->old_image)) {
                    PhotoUploadController::imageUnlink($path, $request->old_image);
                }

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

    // update vendor details
    public function updateVendorDetails(String $slug, Request $request)
    {
        if ($slug == 'personal') {
            if ($request->isMethod('POST')) {
                $rules = [
                    'name' => 'required|string|max:255',
                    'address' => 'required|string|max:255',
                    'city' => 'required|string|max:255',
                    'state' => 'required|string|max:255',
                    'country' => 'required|string|max:255',
                    'pincode' => 'required|max:255',
                    'mobile' => 'required|max:255',
                    'email' => 'required|email|max:255',
                ];

                $messages = [
                    'name.required' => 'Name is required',
                    'address.required' => 'Address is required',
                    'city.required' => 'City is required',
                    'state.required' => 'State is required',
                    'country.required' => 'Country is required',
                    'pincode.required' => 'Pincode is required',
                    'mobile.required' => 'Mobile is required',
                    'email.required' => 'Email is required',
                ];

                $this->validate($request, $rules, $messages);

                $data = $request->except(['_token', 'old_image']);
                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $name = Str::slug($request->input('name'));
                    $height = 300;
                    $width = 300;
                    $path = 'image/vendor/';

                    // Image Delete
                    if (!empty($request->old_image)) {
                        PhotoUploadController::imageUnlink($path, $request->old_image);
                    }

                    // crop image upload
                    $data['image'] = PhotoUploadController::imageUpload($name, $width, $height, $path, $file);
                }

                $data['user_id'] = Auth::id();
                $vendor_exit = Vendor::where('user_id', Auth::id())->first();
                if ($vendor_exit) {
                    $vendor_exit->update($data);
                } else {
                    Vendor::create($data);
                }

                session()->flash('cls', 'success');
                session()->flash('msg', 'Vendor Details Update Successfully.');
                return redirect()->route('admin.updatevendordetails', $slug);
            }
            $vendorData = Vendor::where('user_id', Auth::id())->first();
            return view('admin.modules.vendor.vendor', compact('slug', 'vendorData'));
        } elseif ($slug == 'business') {

            if ($request->isMethod('POST')) {
                $rules = [
                    'shop_name' => 'required|string|max:255',
                    'shop_address' => 'required|string|max:255',
                    'shop_city' => 'required|string|max:255',
                    'shop_state' => 'required|string|max:255',
                    'shop_country' => 'required|string|max:255',
                    'shop_pincode' => 'required|max:255',
                    'shop_mobile' => 'required|max:255',
                    'shop_email' => 'required|email|max:255',
                    'address_proof' => 'required|max:255',
                    'business_license_number' => 'required|max:255',
                    'gst_number' => 'required|max:255',
                    'pan_number' => 'required|max:255',
                ];

                $messages = [
                    'shop_name.required' => 'Shop Name is required',
                    'shop_address.required' => 'Shop Address is required',
                    'shop_city.required' => 'Shop City is required',
                    'shop_state.required' => 'Shop State is required',
                    'shop_country.required' => 'Shop Country is required',
                    'shop_pincode.required' => 'Shop Pincode is required',
                    'shop_mobile.required' => 'Shop Mobile is required',
                    'shop_email.required' => 'Shop Email is required',
                    'address_proof.required' => 'Shop Address Proof is required',
                    'business_license_number.required' => 'Business License Number is required',
                    'gst_number.required' => 'GST Number is required',
                    'pan_number.required' => 'Pan Number is required',
                ];

                $this->validate($request, $rules, $messages);

                $data = $request->except(['_token', 'old_image']);
                if ($request->hasFile('address_proof_image')) {
                    $file = $request->file('address_proof_image');
                    $name = Str::slug($request->input('shop_name'));
                    $path = 'image/vendor/';

                    // Image Delete
                    if (!empty($request->old_image)) {
                        PhotoUploadController::imageUnlink($path, $request->old_image);
                    }

                    // crop image upload
                    $data['address_proof_image'] = PhotoUploadController::orginalImageUpload($name, $path, $file);
                }

                $vendor = Vendor::where('user_id', Auth::id())->select('id')->first();
                $data['vendor_id'] =  $vendor->id;
                $data['user_id'] = Auth::id();
                $vendor_business_exit = VendorBusinessDetail::where('user_id', Auth::id())->first();
                if ($vendor_business_exit) {
                    $vendor_business_exit->update($data);
                } else {
                    VendorBusinessDetail::create($data);
                }

                session()->flash('cls', 'success');
                session()->flash('msg', 'Vendor Business Details Update Successfully.');
                return redirect()->route('admin.updatevendordetails', $slug);
            }

            $vendorBusinessData = VendorBusinessDetail::where('user_id', Auth::id())->first();
            return view('admin.modules.vendor.vendor', compact('slug', 'vendorBusinessData'));
        } elseif ($slug == 'bank') {
            return "bangk";
        }
    }
}
