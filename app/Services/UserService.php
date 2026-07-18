<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserService
{
    /**
     * Get all users ordered by newest first.
     */
    public function getAllUsers()
    {
        return User::latest()->get();
    }

    /**
     * Store a new user.
     */
    public function createUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    /**
     * Update an existing user.
     */
    public function updateUser(User $user, array $data)
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $user->update($data);
    }

    /**
     * Delete a user if it's not the currently authenticated user.
     * 
     * @throws Exception
     */
    public function deleteUser(User $user)
    {
        if ($user->id === auth()->id()) {
            throw new Exception('Anda tidak dapat menghapus akun Anda sendiri.');
        }

        return $user->delete();
    }
}
