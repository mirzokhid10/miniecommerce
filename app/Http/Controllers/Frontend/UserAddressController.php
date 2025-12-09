<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserAddressRequest;
use App\Http\Requests\UpdateUserAddressRequest;
use App\Models\UserAddress;
use App\Services\UserAddressService;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{

    public function __construct(
        protected UserAddressService $service
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userAddresses = $this->service->listForUser();
        return view('frontend.dashboard.address.index', compact('userAddresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.dashboard.address.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserAddressRequest $request)
    {
        $this->service->store($request->validated());

        notify()->success('Address added successfully!');
        return redirect()->route('user.address.index');
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
    public function edit(UserAddress $address)
    {
        // Authorization inside service layer
        return view('frontend.dashboard.address.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserAddressRequest $request, UserAddress $address)
    {
        try {
            $this->service->update($address, $request->validated());
            notify()->success('Address updated successfully!');
        } catch (\Exception $e) {
            notify()->error($e->getMessage());
        }

        return redirect()->route('user.address.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserAddress $address)
    {
        try {
            $this->service->delete($address);
            notify()->success('Address deleted successfully!');
        } catch (\Exception $e) {
            notify()->error($e->getMessage());
        }

        return redirect()->route('user.address.index');
    }
}
