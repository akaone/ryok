<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->primary('id');
            $table->timestamps();


            $table->string('name');
            $table->string('icon')->nullable();
            $table->string('cfe_recto')->nullable();
            $table->string('cfe_verso')->nullable();
            $table->string('nif')->nullable();
            $table->string('organization')->nullable();
            $table->enum('platform', ['ANDROID', 'IOS', 'WEB', 'HYBRIDE'])->default('HYBRIDE');
            $table->string('package_name')->nullable();
            $table->string('website_url')->nullable();
            $table->string('webhook_url')->nullable();
            
            $table->enum('state', ['PENDING', 'ACTIVATED', 'DEACTIVATED', 'REJECTED', 'DELETED'])->default('PENDING');
            $table->text('state_reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apps');
    }
}
