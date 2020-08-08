<?php

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class SignUpTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    # a new user can sign up
    public function a_new_user_can_sign_up()
    {
        # arrange

        # act
        $response = $this->post(route('sign-up.store'), [
            'email' => 'desouza.kevin@ryok.com',
            'name' => 'de SOUZA Kevin',
            'gender' => 'M',
            'password' => 'secret',
            'confirm_password' => 'secret'
        ]);

        # assert
        $response->assertStatus(302);
        $this->assertDatabaseHas('users', [
            'email' => 'desouza.kevin@ryok.com',
            'name' => 'de SOUZA Kevin',
            'state' => 'EMAIL',
        ]);
    }

    /** @test */
    # it should display sign up done view
    public function it_should_display_sign_up_done_view()
    {
        # arrange
        $user = factory(User::class)->create([
            'state' => 'EMAIL',
        ]);

        # act
        $response = $this->get(route('sign-up.done', ['userId' => $user->id]));

        # assert
        $response->assertStatus(200);
        $response->assertSee($user->email);
    }

    /** @test */
    # user can verify email with valid email link
    public function user_can_verify_email_with_valid_email_link()
    {
        # arrange
        $user = factory(User::class)->create([
            'state' => 'EMAIL',
            'email_verified' => false,
        ]);

        # act
        $response = $this->get(route('sign-up.verify', ['emailLink' => $user->email_link]));

        # assert
        $response->assertStatus(200);
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'email_link' => $user->email_link
        ]);
    }

    /** @test */
    # user cannot verify without valid email link
    public function user_cannot_verify_without_valid_email_link()
    {
        # arrange
        $user = factory(User::class)->create([
            'state' => 'EMAIL',
            'email_verified' => false,
        ]);

        # act
        $response = $this->get(route('sign-up.verify', ['emailLink' => 'INVALID_EMAIL_LINK']));

        # assert
        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email_link' => $user->email_link
        ]);
    }

    # email should be sent to newly signup users

    # user with existing email can't sign up
}
