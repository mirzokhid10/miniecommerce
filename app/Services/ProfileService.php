<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class ProfileService
{
    public function updateProfile($request)
    {
        $user = Auth::user();

        // Handle Image Upload
        if ($request->hasFile('image')) {
            if ($user->image && File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }

            $image      = $request->file('image');
            $imageName  = uniqid() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/userProfileImage'), $imageName);

            $user->image = "/uploads/userProfileImage/" . $imageName;
        }

        // Update profile fields
        $user->update([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'phone'    => $request->phone,
        ]);
    }

    public function updatePassword($request)
    {
        $request->user()->update([
            'password' => bcrypt($request->password),
        ]);
    }
}
