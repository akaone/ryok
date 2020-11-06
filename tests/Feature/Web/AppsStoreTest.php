<?php

namespace Tests\Feature\Web;

use App\Models\Carrier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;
use App\Models\App;
use App\Models\AppKey;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use App\Http\Livewire\LivewireAppsCreate;

class AppsStoreTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    public function a_user_can_submit_an_app_request_with_icon()
    {
        # arrange
        $user = factory(User::class)->create([
            'type' => 'member',
            'state' => 'ACTIVATED',
            'email' => 'member@ryok.com',
        ]);

        // Storage::fake('images');
        $file = UploadedFile::fake()->image('app_icon_img.jpg');
        $recto = UploadedFile::fake()->image('cfe_recto.jpg');
        $verso = UploadedFile::fake()->image('cfe_verso.jpg');

        // Create carrier
        $carrier = Carrier::create(['name' => 'Togocom', 'ibm' => '605-01', 'country' => 'TG', 'phone_regex' => '^91|90']);

        # action
        $this->actingAs($user);
        Livewire::test(LivewireAppsCreate::class)
            ->set('appName','my first app')
            ->set('website', 'http://ryoktest.com')
            ->set('webhookUrl', 'http://ryoktest.com/hook')
            ->set('organization', 'Ryok')
            ->set('nif', '123456TG')
            ->set('appIcon', $file)
            ->set('cfe_recto', $recto)
            ->set('cfe_verso', $verso)
            ->set('pickedCarriers', [$carrier->ibm])
            ->call('save')
        ;

        # assert
        $this->assertDatabaseHas('apps', [
            'name' => 'my first app',
            'state' => 'PENDING',
            'platform' => 'HYBRIDE',
        ]);
        $this->assertDatabaseHas('app_users', [
            'user_id' => $user->id,
        ]);

        // Storage::disk('images')->assertExists($file->hashName());
    }


    /** @test  */
    # created app should be create with app key
    public function created_app_should_be_created_with_app_key()
    {
        # arrange
        $user = factory(User::class)->create([
            'type' => 'member',
            'state' => 'ACTIVATED',
            'email' => 'member@ryok.com',
        ]);

        $file = UploadedFile::fake()->image('app_icon_img.jpg');
        $recto = UploadedFile::fake()->image('cfe_recto.jpg');
        $verso = UploadedFile::fake()->image('cfe_verso.jpg');

        // Create carrier
        $carrier = Carrier::create(['name' => 'Togocom', 'ibm' => '605-01', 'country' => 'TG', 'phone_regex' => '^91|90']);

        # action
        $this->actingAs($user);
        Livewire::test(LivewireAppsCreate::class)
            ->set('appName','my first app')
            ->set('website', 'http://ryoktest.com')
            ->set('webhookUrl', 'http://ryoktest.com/hook')
            ->set('organization', 'Ryok')
            ->set('nif', '123456TG')
            ->set('appIcon', $file)
            ->set('cfe_recto', $recto)
            ->set('cfe_verso', $verso)
            ->set('pickedCarriers', [$carrier->ibm])
            ->call('save')
        ;

        # assert
        $this->assertDatabaseHas('apps', [
            'name' => 'my first app',
            'state' => 'PENDING',
            'platform' => 'HYBRIDE',
        ]);
        $this->assertDatabaseHas('app_users', [
            'user_id' => $user->id,
        ]);
        $this->assertEquals(1, AppKey::count());
    }

    /** @test  */
    # created app should have a default account
    public function created_app_should_have_a_default_account()
    {
        # arrange
        $user = factory(User::class)->create([
            'type' => 'member',
            'state' => 'ACTIVATED',
            'email' => 'member@ryok.com',
        ]);

        $file = UploadedFile::fake()->image('app_icon_img.jpg');
        $recto = UploadedFile::fake()->image('cfe_recto.jpg');
        $verso = UploadedFile::fake()->image('cfe_verso.jpg');

        // Create carrier
        $carrier = Carrier::create(['name' => 'Togocom', 'ibm' => '605-01', 'country' => 'TG', 'phone_regex' => '^91|90']);

        # action
        $this->actingAs($user);
        Livewire::test(LivewireAppsCreate::class)
            ->set('appName','my first app')
            ->set('website', 'http://ryoktest.com')
            ->set('webhookUrl', 'http://ryoktest.com/hook')
            ->set('organization', 'Ryok')
            ->set('nif', '123456TG')
            ->set('appIcon', $file)
            ->set('cfe_recto', $recto)
            ->set('cfe_verso', $verso)
            ->set('pickedCarriers', [$carrier->ibm])
            ->call('save')
        ;

        # assert
        $this->assertDatabaseHas('apps', [
            'name' => 'my first app',
            'state' => 'PENDING',
            'platform' => 'HYBRIDE',
        ]);
        $this->assertDatabaseHas('app_users', [
            'user_id' => $user->id,
        ]);

        $app = App::where('name', 'my first app')->first();
        $this->assertDatabaseHas('accounts', [
            'app_id' => $app->id,
            'type' => 'APP',
        ]);
    }

}
