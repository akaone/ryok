<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_users', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->primary('id');
            $table->timestamps();
            
            $table->enum('state', ['ACTIVATED', 'DEACTIVATED', 'DELETED'])->default('ACTIVATED');
            $table->text('state_reason')->nullable();

            $table->string('app_id');
            $table->foreign('app_id')
                ->references('id')->on('apps')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_users');
    }
}
