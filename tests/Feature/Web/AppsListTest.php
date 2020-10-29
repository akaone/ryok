<?php

use function Pest\Livewire\livewire;
use App\Models\User;
use App\Models\App;
use App\Models\AppUser;
use App\Http\Livewire\LivewireAppsUsersCreate;
use App\Http\Livewire\LivewireAppsUsersShow;
use App\Http\Livewire\LivewireAppsList;
use App\Rules\IsMemberAlreadyAppUser;
use PascalDeVink\ShortUuid\ShortUuid;
use Ramsey\Uuid\Uuid;
use App\Exceptions\UserAccessLevelException;


test("users without app-read permission cannot see the list of submitted app", function() {
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
    $this->assertEquals(0, count($renderedView->__get('appsList')));
})->throws(UserAccessLevelException::class);


test("users with app-read permission can see the list of submitted app", function() {
    # arrange
    $user = factory(User::class)->create([
        'type' => 'staff',
        'state' => 'ACTIVATED',
        'email' => 'desouzakevinm@gmail.com',
    ]);
    $user->assignRole('staff-admin');
    
    factory(App::class, 5)->create();
    
    # act
    $this->actingAs($user);
    $component  = livewire(LivewireAppsList::class);
    $renderedView = $component->lastRenderedView;
    # dd($component->lastRenderedView->getData()['appsList']);


    # assert
    $this->assertEquals(5, count($renderedView->__get('appsList')));
});


# staff user can display app details

# staff with app-state permission can validate an app

# staff with app-state permission can reject an app

# staff with app-state permission can deactivate an app

# only staff with permission can see app payments