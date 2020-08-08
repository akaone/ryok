<?php

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\App;
use App\Models\AppUser;

class AppsUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    # user admin can invite people to an app
    public function user_admin_can_invite_people_to_an_app()
    {
        # arrange
        $admin = factory(User::class)->create([
            'type' => 'member',
            'state' => 'ACTIVATED',
            'email' => 'member@ryok.com',
        ]);

        $app = factory(App::class)->states('MOBILE')->create([
            'state' => 'PENDING',
        ]);
        $appUser = AppUser::create([
            'app_id' => $app->id,
            'user_id' => $admin->id,
            'state' => 'ACTIVATED',
        ]);
        $appUser->assignRole('admin');

        # act

        # assert
    }
}
