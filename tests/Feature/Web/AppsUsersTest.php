<?php

use function Pest\Livewire\livewire;
use App\Models\User;
use App\Models\App;
use App\Models\AppUser;
use App\Http\Livewire\LivewireAppsUsersCreate;
use Livewire\Livewire;
use App\Rules\IsMemberAlreadyAppUser;
use PascalDeVink\ShortUuid\ShortUuid;
use Ramsey\Uuid\Uuid;

test('admin app_user can invite people to an app', function () {
    # arrange
    $admin = factory(User::class)->create([
        'type' => 'member',
        'state' => 'ACTIVATED',
        'email' => 'member@ryok.com',
    ]);

    $existingUser = factory(User::class)->create(['email' => 'kevin@gmail.com', 'state' => 'ACTIVATED']);

    $app = factory(App::class)->states('MOBILE')->create([
        'state' => 'PENDING',
    ]);
    $appUser = AppUser::create([
        'app_id' => $app->id,
        'user_id' => $admin->id,
        'state' => 'ACTIVATED',
    ]);
    $appUser->assignRole('admin');

    $short = new ShortUuid();
    $encodedAppId = $short->encode(Uuid::fromString($app->id));

    # act
    $this->actingAs($admin);
    $component  = livewire(LivewireAppsUsersCreate::class, ['appId' => $encodedAppId]);
    $component->set('members', [
        ['email' => 'alvin@gmail.com', 'role' => 'admin'],
        ['email' => 'kevin@gmail.com', 'role' => 'operation']
    ]);
    $component->call('sendInvites');
    $renderedView = $component->lastRenderedView;

    # assert
    $this->assertDatabaseHas('users', ['email' => 'alvin@gmail.com', 'state' => 'INVITED']);
    $this->assertDatabaseHas('users', ['email' =>  $existingUser->email, 'state' => $existingUser->state]);
    $this->assertDatabaseHas('app_users', ['state' => 'ACTIVATED', 'app_id' => $app->id]);
    # assert against roles
    
});

test('cannot invite the same member twice on the same app', function () {
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

    $existingUser = factory(User::class)->create(['email' => 'kevin@gmail.com', 'state' => 'ACTIVATED']);
    $existingAppUser = AppUser::create([
        'app_id' => $app->id,
        'user_id' => $existingUser->id,
        'state' => 'ACTIVATED',
    ]);
    $existingAppUser->assignRole('operation');

    $short = new ShortUuid();
    $encodedAppId = $short->encode(Uuid::fromString($app->id));

    # act
    $this->actingAs($admin);
    $component  = livewire(LivewireAppsUsersCreate::class, ['appId' => $encodedAppId]);
    $component->set('members', [
        ['email' => 'kevin@gmail.com', 'role' => 'operation']
    ]);
    $component->call('addRow');
    $component->assertHasErrors('members.*.email');
    # $component->call('sendInvites');
    $renderedView = $component->lastRenderedView;

    # assert
    $this->assertEquals(1, AppUser::where(['user_id' =>  $existingUser->id, 'app_id' => $app->id])->count());
    # assert against roles
});

# can not submit form if members array is empty

# can activate a member

# can deactivate a member

# admin app_user can change a member role

# admin app_user can not change another app_user admin role