<?php

namespace Tests\Feature\Web;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Livewire\LivewireLoginIndex;

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

        Livewire::test(LivewireLoginIndex::class)
            ->set('email', $user->email)
            ->set('password', 'password')
            ->call('login')
            ->assertRedirect(route('dashboard.app.list'))
        ;
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

        Livewire::test(LivewireLoginIndex::class)
            ->set('email', $user->email)
            ->set('password', 'password')
            ->call('login')
            ->assertRedirect(route('dashboard.stats.index'))
        ;
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

        Livewire::test(LivewireLoginIndex::class)
            ->set('email', $user->email)
            ->set('password', 'password')
            ->call('login')
            ->assertOk()
        ;
    }
}
