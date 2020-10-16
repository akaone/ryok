<?php

use function Pest\Livewire\livewire;
use App\Http\Livewire\LivewireAppsList;
use App\Http\Livewire\Components\LivewireAppsDropdown;
use App\Models\User;
use App\Models\App;
use App\Models\AppUser;


test('staff user can see all created apps by users', function () {
    # arrange
    $user = factory(User::class)->create([
        'type' => 'staff',
        'state' => 'ACTIVATED',
        'email' => 'desouzakevinm@gmail.com',
    ]);
    
    factory(App::class, 5)->create();
    
    # act
    $this->actingAs($user);
    $component  = livewire(LivewireAppsList::class);
    $renderedView = $component->lastRenderedView;
    # dd($component->lastRenderedView->getData()['appsList']);


    # assert
    $this->assertEquals(5, count($renderedView->__get('appsList')));
});

test('member user cannot see route apps list', function () {
    # arrange
    $user = factory(User::class)->create([
        'type' => 'member',
        'state' => 'ACTIVATED',
        'email' => 'desouzakevinm@gmail.com',
    ]);

    factory(App::class, 5)->create();

    # act
    $this->actingAs($user);
    $response = $this->get(route('dashboard.apps.list'));

    # assert
    $response->assertViewIs('acl.no-access');
    $response->assertViewHas('title', trans('acl.exception.not-staff-member'));
});

test('member user can only see app of which he is a app_user', function () {
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

    # act
    $this->actingAs($user);
    $component  = livewire(LivewireAppsDropdown::class);
    $renderedView = $component->lastRenderedView;

    # assert
    $this->assertEquals(2, count($renderedView->__get('allApps')));
});

test('member can only see app where he is activated', function () {
    # arrange
    $user = factory(User::class)->create([
        'type' => 'member',
        'state' => 'ACTIVATED',
        'email' => 'desouzakevinm@gmail.com',
    ]);
    
    factory(App::class, 5)->create();
    $userAppOne = factory(App::class)->create();
    $userAppTwo = factory(App::class)->create();

    AppUser::create([
        'app_id' => $userAppOne->id,
        'user_id' => $user->id,
        'state' => 'DEACTIVATED'
    ]);
    AppUser::create([
        'app_id' => $userAppTwo->id,
        'user_id' => $user->id,
        'state' => 'ACTIVATED'
    ]);
    
    
    $this->actingAs($user);
    $component  = livewire(LivewireAppsDropdown::class);
    $renderedView = $component->lastRenderedView;

    # assert
    $this->assertEquals(1, count($renderedView->__get('allApps')));
});