<?php


namespace Project\Repositories;


use Project\Models\UserModel;

class UserRepository
{
    public function addUser(string $email, string $name): UserModel
    {

    }

    public function getUser(string $email): ?UserModel
    {
        return null;
    }
}