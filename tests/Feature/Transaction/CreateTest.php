<?php

namespace Tests\Feature\Transaction;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function regular_user_can_make_a_transaction()
    {
        $user = $this->makeUser(balance: 100);
        $user2 = $this->makeUser();

        $this->actingAs($user)
            ->postJson(route('transaction.store'), [
                'sender' => $user->wallet->id,
                'receiver' => $user2->wallet->id,
                'amount' => 50,
            ])
            ->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseCount('transactions', 1);
    }
}
