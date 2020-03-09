<?php

namespace Tests\Feature\Web;

use Tests\TestCase;
use App\Models\User;
use App\Models\App;
use App\Models\AppUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppsIndexTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    # a staff user can see all created app by users
    public function staff_user_can_see_all_created_apps_by_users()
    {
        # arrange
        $user = factory(User::class)->create([
            'type' => 'staff',
            'state' => 'ACTIVATED',
            'email' => 'desouzakevinm@gmail.com',
        ]);
        
        factory(App::class, 5)->create();
        
        Auth::attempt(
            ['email' => $user->email, 'password' => 'password', 'state' => 'ACTIVATED']
        );
        # act
        $response = $this->get(route('dashboard.apps.index'));
        $pageProps = $response->getOriginalContent()->getData()['page']['props'];

        # assert
        $this->assertEquals(5, count($pageProps['apps']));
    }

    /** @test */
    # a member user can only see app of which he is a app_user
    public function a_member_can_only_see_app_of_which_he_is_a_app_user()
    {
        # arrange
        $user = factory(User::class)->create([
            'type' => 'member',
            'state' => 'ACTIVATED',
            'email' => 'desouzakevinm@gmail.com',
        ]);
        
        factory(App::class, 5)->create();
        $userApps = factory(App::class, 2)->create();

        foreach ($userApps as $key => $value) {
            AppUser::create([
                'app_id' => $value->id,
                'user_id' => $user->id,
                'state' => 'ACTIVATED',
            ]);
        }
        
        Auth::attempt(
            ['email' => $user->email, 'password' => 'password', 'state' => 'ACTIVATED']
        );
        # act
        $response = $this->get(route('dashboard.apps.index'));
        $pageProps = $response->getOriginalContent()->getData()['page']['props'];

        # assert
        $this->assertEquals(2, count($pageProps['apps']));
    }

    /** @test */
    public function a_member_can_only_see_app_where_he_is_activated()
    {
        # arrange
        $user = factory(User::class)->create([
            'type' => 'member',
            'state' => 'ACTIVATED',
            'email' => 'desouzakevinm@gmail.com',
        ]);
        
        factory(App::class, 5)->create();
        $userApps = factory(App::class, 2)->create();

        foreach ($userApps as $key => $value) {
            AppUser::create([
                'app_id' => $value->id,
                'user_id' => $user->id,
                'state' => 'DEACTIVATED'
            ]);
        }
        
        Auth::attempt(
            ['email' => $user->email, 'password' => 'password', 'state' => 'ACTIVATED']
        );
        # act
        $response = $this->get(route('dashboard.apps.index'));
        $pageProps = $response->getOriginalContent()->getData()['page']['props'];

        # assert
        $this->assertEquals(0, count($pageProps['apps']));

    }

}
