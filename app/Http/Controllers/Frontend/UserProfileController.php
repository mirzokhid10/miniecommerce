<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\ProfileService;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    protected ProfileService $service;

    public function __construct(ProfileService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('frontend.dashboard.profile');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $this->service->updateProfile($request);

        notify()->success('Profile Information Updated Successfully!');
        return back();
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $this->service->updatePassword($request);

        notify()->success('Password Updated Successfully!');
        return back();
    }
}
