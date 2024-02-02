<?php

namespace Tests\Feature\Auth;

use App\Enums\UserType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function regular_user_should_be_able_to_register(): void
    {
        $response = $this->postJson(route('auth.register'), [
            'full_name' => 'Joe Doe',
            'email' => 'joe@doe.com',
            'document' => '12345678910',
            'password' => 'password',
            'type' => UserType::Regular->value,
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas('users', [
            'email' => 'joe@doe.com',
            'document' => '12345678910',
        ]);
    }

    /** @test */
    public function shopkeeper_user_should_be_able_to_register(): void
    {
        $response = $this->postJson(route('auth.register'), [
            'full_name' => 'Joe Doe',
            'email' => 'joe@doe.com',
            'document' => '12345678910',
            'password' => 'password',
            'type' => UserType::Shopkeeper->value,
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas('users', [
            'email' => 'joe@doe.com',
            'document' => '12345678910',
            'type' => UserType::Shopkeeper->value,
        ]);
    }

    /** @test */
    public function users_should_send_all_fields_to_register(): void
    {
        $response = $this->postJson(route('auth.register'), [
            'full_name' => '',
            'email' => '',
            'document' => '',
            'password' => '',
            'type' => '',
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors([
            'full_name' => __('validation.required', ['attribute' => 'full name']),
            'email' => __('validation.required', ['attribute' => 'email']),
            'document' => __('validation.required', ['attribute' => 'document']),
            'password' => __('validation.required', ['attribute' => 'password']),
            'type' => __('validation.required', ['attribute' => 'type']),
        ]);
    }
}
