<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class LoginUserTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function users_should_be_able_to_login(): void
    {
        // TODO
    }

    /** @test */
    public function email_should_be_required(): void
    {
        $response = $this->postJson(route('auth.login'), [
            'email' => '', 
            'password' => '12345', 
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors([
            'email' => __('validation.required', ['attribute' => 'email']),
        ]);
    }
    
    /** @test */
    public function email_should_be_a_valid_email(): void
    {
        $response = $this->postJson(route('auth.login'), [
            'email' => 'invalid email', 
            'password' => '12345', 
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors([
            'email' => __('validation.email', ['attribute' => 'email']),
        ]);
    }
    
    /** @test */
    public function password_should_be_required(): void
    {
        $response = $this->postJson(route('auth.login'), [
            'email' => 'email@email.com', 
            'password' => '', 
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors([
            'password' => __('validation.required', ['attribute' => 'password']),
        ]);
    }
}
