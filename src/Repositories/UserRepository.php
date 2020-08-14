<?php


namespace Project\Repositories;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Project\Models\UserModel;

class UserRepository
{
    public function checkIsEmailRegistered(string $email): bool
    {
        return UserModel::query()->where('email', '=', $email)->exists();
    }

    public function saveModel(UserModel $user): UserModel
    {
        $user->save();

        return $user;
    }

    /**
     * @param string $email
     * @return Builder|Model|object|UserModel|null
     */
    public function getUserByEmail(string $email): ?UserModel
    {
        return UserModel::query()->where('email', '=', $email)->first();

    }

    /**
     * @return UserModel[]
     */
    public function getAll(): array
    {
        return UserModel::query()->get()->all();
    }
}
