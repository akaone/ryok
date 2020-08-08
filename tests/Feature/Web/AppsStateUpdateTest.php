<?php

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\App;
use App\Models\AppUser;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AppsStateUpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    # admin staff can validate app
    public function admin_staff_can_validate_pending_app()
    {
        # arrange
        $user = factory(User::class)->create([
            'type' => 'staff',
            'state' => 'ACTIVATED',
            'email' => 'desouzakevinm@gmail.com',
        ]);
        $user->assignRole('staff-admin');

        $app = factory(App::class)->states('MOBILE')->create([
            'state' => 'PENDING',
        ]);
        
        $response = $this->actingAs($user)->patch(
            route('dashboard.apps.state.update', ['appId' => $app->id]),
            ['state' => 'ACTIVATED']
        );

        $response->assertStatus(302);
        $this->assertDatabaseHas('apps', [
            'id' => $app->id,
            'state' => 'ACTIVATED'
        ]);
    }

    /** @test */
    # not admin staff cannot validate app
    # json
    public function not_admin_staff_cannot_validate_app()
    {
        # arrange
        $user = factory(User::class)->create([
            'type' => 'staff',
            'state' => 'ACTIVATED',
            'email' => 'desouzakevinm@gmail.com',
        ]);
        $user->assignRole('admin');

        $app = factory(App::class)->states('MOBILE')->create([
            'state' => 'PENDING',
        ]);
        
        $response = $this->actingAs($user)->json('PATCH',
            route('dashboard.apps.state.update', ['appId' => $app->id]),
            ['state' => 'ACTIVATED']
        );

        $response->assertStatus(401);
        $this->assertDatabaseHas('apps', [
            'id' => $app->id,
            'state' => 'PENDING'
        ]);
    }

    /** @test */
    # admin member can deactivate app
    public function admin_member_can_deactivate_app()
    {
        # arrange
        $user = factory(User::class)->create([
            'type' => 'staff',
            'state' => 'ACTIVATED',
            'email' => 'desouzakevinm@gmail.com',
        ]);

        $app = factory(App::class)->states('MOBILE')->create([
            'state' => 'PENDING',
        ]);
        $appUser = AppUser::create([
            'app_id' => $app->id,
            'user_id' => $user->id,
            'state' => 'ACTIVATED',
        ]);
        $appUser->assignRole('admin');
        
        $response = $this->actingAs($user)->patch(
            route('dashboard.apps.state.update', ['appId' => $app->id]),
            [
                'state' => 'DEACTIVATED',
                'state_reason' => "We are no longer using this app"
            ]
        );

        $response->assertStatus(302);
        $this->assertDatabaseHas('apps', [
            'id' => $app->id,
            'state' => 'DEACTIVATED'
        ]);
    }

    # todo-test: operation member can not edit app statet

    # todo-test: developper member can edit app state
}
