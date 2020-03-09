<?php

namespace Tests\Feature\Web;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function active_staff_user_can_login()
    {
        # arrange
        $user = factory(User::class)->create([
            'type' => 'staff',
            'state' => 'ACTIVATED',
            'email' => 'desouzakevinm@gmail.com',
        ]);

        # act
        $response = $this->post('/login', [
            'email' => 'desouzakevinm@gmail.com',
            'password' => 'password',
        ]);

        # asser
        $response->assertRedirect(route('dashboard.apps.index'));
    }
    
    /** @test */
    public function active_member_user_can_login()
    {
        # arrange
        $user = factory(User::class)->create([
            'type' => 'member',
            'state' => 'ACTIVATED',
            'email' => 'member@ryok.com',
        ]);

        # act
        $response = $this->post(route('login'), [
            'email' => 'member@ryok.com',
            'password' => 'password',
        ]);

        # asser
        $response->assertRedirect(route('dashboard.apps.index'));
    }
    
    /** @test */
    public function not_active_user_cannot_login()
    {
        # arrange
        $user = factory(User::class)->create([
            'type' => 'member',
            'state' => 'DEACTIVATED',
            'email' => 'member@ryok.com',
        ]);

        # act
        $response = $this->post(route('login'), [
            'email' => 'member@ryok.com',
            'password' => 'password',
        ]);

        # asser
        $response->assertRedirect(route('login'));
    }
}
