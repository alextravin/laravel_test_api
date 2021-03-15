<?php


namespace Tests\Generators;


use App\Models\User;

class UsersGenerator
{
    public static function generateAdmin(array $data = []): User
    {
        return static::generate(array_merge($data,[
            // Some special fields
        ]));
    }

    public static function generateUser(array $data = []): User
    {
        return static::generate(array_merge($data,[
            // Some special fields
        ]));
    }

    protected static function generate(array $data = []): User
    {
        return User::factory()->create($data);
    }

}
