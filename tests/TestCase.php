<?php

namespace Tests;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Contracts\Auth\Authenticatable;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function makeUser(UserType $type = UserType::Regular, float $balance = 0): Authenticatable|User
    {
        /** @var Authenticatable|User $user */
        $user = User::factory()->create(['type' => $type->value]);
        $user->wallet()->create(['balance' => $balance]);

        return $user;
    }
}
