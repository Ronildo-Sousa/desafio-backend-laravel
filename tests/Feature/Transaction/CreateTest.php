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
        $user = $this->makeUser(balance: 120);
        $user2 = $this->makeUser();

        $this->actingAs($user)
            ->postJson(route('transactions.store'), [
                'sender_id' => $user->wallet->id,
                'receiver_id' => $user2->wallet->id,
                'amount' => 50,
            ])
            ->assertStatus(Response::HTTP_CREATED);

        $user->refresh();
        $user2->refresh();

        $this->assertDatabaseCount('transactions', 1);
        $this->assertEquals($user2->wallet->balance, 50);
        $this->assertEquals($user->wallet->balance, 70);
    }
}
