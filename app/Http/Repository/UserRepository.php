<?php

// App/Http/Repository/UserRepository.php

namespace App\Http\Repository;

use App\Models\User;

class UserRepository
{
    public function createUser(array $userData)
    {
        return User::create($userData);
    }

    public function getUserList($query)
    {
        return User::query()
            ->where('name', 'LIKE', "%$query%")
            ->orWhere('email', 'LIKE', "%$query%")
            ->orderBy('name', 'asc')
            ->paginate(6);
    }

    public function getUserById($id)
    {
        return User::find($id);
    }

    public function updateUser(User $user, array $userData)
    {
        $user->update($userData);
    }

    public function updateUserProfilePicture(User $user, $picturePath)
    {
        $user->profile_picture = $picturePath;
        $user->save();
    }

    public function deleteUser(User $user)
    {
        $user->delete();
    }
}
