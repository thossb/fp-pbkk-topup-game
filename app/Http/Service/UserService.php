<?php

// App/Http/Service/UserService.php

namespace App\Http\Service;

use App\Http\Repository\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(array $userData)
    {
        return $this->userRepository->createUser($userData);
    }

    public function getUserList($query)
    {
        return $this->userRepository->getUserList($query);
    }

    public function getUserById($id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function updateUser($user, array $userData)
    {
        $this->userRepository->updateUser($user, $userData);
    }

    public function updateUserProfilePicture($user, $picturePath)
    {
        $this->userRepository->updateUserProfilePicture($user, $picturePath);
    }

    public function deleteUser($user)
    {
        $this->userRepository->deleteUser($user);
    }
}
