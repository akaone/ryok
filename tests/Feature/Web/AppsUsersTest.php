<?php

use function Pest\Livewire\livewire;
use App\Models\User;
use App\Models\App;
use App\Models\AppUser;
use App\Http\Livewire\LivewireAppsUsersCreate;
use App\Http\Livewire\LivewireAppsUsersShow;
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


test('app_user can see the detail page of another app_user', function() {
    # arrange
    $admin = factory(User::class)->create([
        'type' => 'member',
        'state' => 'ACTIVATED',
        'email' => 'member@ryok.com',
    ]);

    $app = factory(App::class)->states('MOBILE')->create([
        'state' => 'PENDING',
    ]);

    $anotherUser = factory(User::class,)->create();
    $anotherAppUser = AppUser::create([
        'app_id' => $app->id,
        'user_id' => $anotherUser->id,
        'state' => 'ACTIVATED',
    ]);
    $anotherAppUser->assignRole('operation');

    $appUser = AppUser::create([
        'app_id' => $app->id,
        'user_id' => $admin->id,
        'state' => 'ACTIVATED',
    ]);
    $appUser->assignRole('admin');

    # act
    $short = new ShortUuid();
    $encodedAppId = $short->encode(Uuid::fromString($app->id));
    $encodedAppUserId = $short->encode(Uuid::fromString($anotherAppUser->id));
    $this->actingAs($admin);
    $response = $this->get(route('dashboard.apps.users.show', ['appId' => $encodedAppId, 'userId' => $encodedAppUserId ]));

    # assert
    $response->assertSee($anotherUser->email);
    $response->assertSee($anotherUser->name);
    $response->assertSee($anotherAppUser->created_at);
    $response->assertSee('operation');

});


test('admin app_user can change a member role', function() {
    # arrange
    $admin = factory(User::class)->create([
        'type' => 'member',
        'state' => 'ACTIVATED',
        'email' => 'member@ryok.com',
    ]);

    $app = factory(App::class)->states('MOBILE')->create([
        'state' => 'PENDING',
    ]);

    $anotherUser = factory(User::class,)->create();
    $anotherAppUser = AppUser::create([
        'app_id' => $app->id,
        'user_id' => $anotherUser->id,
        'state' => 'ACTIVATED',
    ]);
    $anotherAppUser->assignRole('operation');

    $appUser = AppUser::create([
        'app_id' => $app->id,
        'user_id' => $admin->id,
        'state' => 'ACTIVATED',
    ]);
    $appUser->assignRole('admin');

    # act
    $short = new ShortUuid();
    $encodedAppId = $short->encode(Uuid::fromString($app->id));
    $encodedAppUserId = $short->encode(Uuid::fromString($anotherAppUser->id));
    $this->actingAs($admin);
    $component  = livewire(LivewireAppsUsersShow::class, ['appId' => $encodedAppId, 'userId' => $encodedAppUserId]);
    $component->set('newRole', 'support');
    $component->call('updateUserRole');
    $component->assertHasNoErrors();

    $this->assertTrue($anotherAppUser->fresh()->hasRole('support'));
    $this->assertFalse($anotherAppUser->fresh()->hasRole('operation'));
});


test('admin app_user can not change another app_user admin role', function() {
    # arrange
    $admin = factory(User::class)->create([
        'type' => 'member',
        'state' => 'ACTIVATED',
        'email' => 'member@ryok.com',
    ]);

    $app = factory(App::class)->states('MOBILE')->create([
        'state' => 'PENDING',
    ]);

    $anotherUser = factory(User::class,)->create();
    $anotherAppUser = AppUser::create([
        'app_id' => $app->id,
        'user_id' => $anotherUser->id,
        'state' => 'ACTIVATED',
    ]);
    $anotherAppUser->assignRole('admin');

    $appUser = AppUser::create([
        'app_id' => $app->id,
        'user_id' => $admin->id,
        'state' => 'ACTIVATED',
    ]);
    $appUser->assignRole('admin');

    # act
    $short = new ShortUuid();
    $encodedAppId = $short->encode(Uuid::fromString($app->id));
    $encodedAppUserId = $short->encode(Uuid::fromString($anotherAppUser->id));
    $this->actingAs($admin);
    $component  = livewire(LivewireAppsUsersShow::class, ['appId' => $encodedAppId, 'userId' => $encodedAppUserId]);
    $component->set('newRole', 'support');
    $component->call('updateUserRole');
    $component->assertHasNoErrors();

    $this->assertTrue($anotherAppUser->fresh()->hasRole('admin'));
    $this->assertFalse($anotherAppUser->fresh()->hasRole('support'));
});

# can activate a member

# can deactivate a member

# only app_user with app-users-edit permission can change app_user role

# only app_user with app-users-create permission can invite member to app