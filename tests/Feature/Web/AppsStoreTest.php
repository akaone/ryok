<?php

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;
use App\Models\AppKey;
use Illuminate\Support\Facades\Storage;

class AppsStoreTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test  */
    public function a_user_can_submit_an_ios_app_request_with_icon()
    {
        # arrange
        $user = factory(User::class)->create([
            'type' => 'member',
            'state' => 'ACTIVATED',
            'email' => 'member@ryok.com',
        ]);

        // Storage::fake('images');
        $file = UploadedFile::fake()->image('app_icon_img.jpg');

        # action
        $response = $this->actingAs($user)->post(route('dashboard.apps.store'), [
            'name' => 'My cool app',
            'platform' => 'IOS',
            'icon' => $file,
            'package_name' => 'my.cool.app'
        ]);

        # assert
        $this->assertDatabaseHas('apps', [
            'name' => 'My cool app',
            'state' => 'PENDING',
            'platform' => 'IOS',
        ]);
        $this->assertDatabaseHas('app_users', [
            'user_id' => $user->id,
        ]);

        // Storage::disk('images')->assertExists($file->hashName());
        $response->assertStatus(302);
        $response->assertRedirect(route('dashboard.apps.index'));
    }

    
    /** @test  */
    public function a_user_can_submit_an_android_app_request_without_icon()
    {
        # arrange
        $user = factory(User::class)->create([
            'type' => 'member',
            'state' => 'ACTIVATED',
            'email' => 'member@ryok.com',
        ]);

        # action
        $response = $this->actingAs($user)->post(route('dashboard.apps.store'), [
            'name' => 'My cool app',
            'platform' => 'ANDROID',
            'package_name' => 'my.cool.app'
        ]);

        # assert
        $this->assertDatabaseHas('apps', [
            'name' => 'My cool app',
            'state' => 'PENDING',
            'platform' => 'ANDROID',
        ]);
        $this->assertDatabaseHas('app_users', [
            'user_id' => $user->id,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('dashboard.apps.index'));
    }

    
    /** @test  */
    # created app should be create with app key
    public function created_app_should_be_create_with_app_key()
    {
        # arrange
        $user = factory(User::class)->create([
            'type' => 'member',
            'state' => 'ACTIVATED',
            'email' => 'member@ryok.com',
        ]);

        # action
        $response = $this->actingAs($user)->post(route('dashboard.apps.store'), [
            'name' => 'My cool app',
            'platform' => 'ANDROID',
            'package_name' => 'my.cool.app'
        ]);

        # assert
        $this->assertDatabaseHas('apps', [
            'name' => 'My cool app',
            'state' => 'PENDING',
            'platform' => 'ANDROID',
        ]);
        $this->assertDatabaseHas('app_users', [
            'user_id' => $user->id,
        ]);
        $this->assertEquals(1, AppKey::count());
        $response->assertStatus(302);
        $response->assertRedirect(route('dashboard.apps.index'));
    }

}
