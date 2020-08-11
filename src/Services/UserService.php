<?php
declare(strict_types=1);

namespace Project\Services;


use Project\Models\UserModel;

class UserService
{
    public function signUp(string $email, string $name): UserModel
    {
        //TODO implement
        $user = new UserModel();
        $user->name = $name;
        $user->email = $email;

        return $user;
    }

    public function signIn(string $email): ?UserModel //? = null
    {
        // TODO implement
        return null;
    }

    public function signOut(): void
    {

    }
}