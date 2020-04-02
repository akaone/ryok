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

    # email should be sent to newly signup users

    # user with existing email can't sign up
}
