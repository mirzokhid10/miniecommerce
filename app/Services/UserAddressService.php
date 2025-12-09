<?php

namespace App\Services;

use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;

class UserAddressService
{
    public function listForUser()
    {
        return UserAddress::where('user_id', Auth::id())->get();
    }

    public function store(array $data): UserAddress
    {
        $data['user_id'] = Auth::id();
        return UserAddress::create($data);
    }

    public function update(UserAddress $address, array $data): UserAddress
    {
        $this->ensureOwner($address);

        $address->update($data);
        return $address;
    }

    public function delete(UserAddress $address): void
    {
        $this->ensureOwner($address);

        $address->delete();
    }

    private function ensureOwner(UserAddress $address)
    {
        if ($address->user_id !== Auth::id()) {
            throw new \Exception('Unauthorized access to this address.');
        }
    }
}
