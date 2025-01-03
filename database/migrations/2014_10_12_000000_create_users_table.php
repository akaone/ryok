<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->primary('id');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('email_link')->unique();
            $table->boolean('email_verified')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('state', [
                'INVITED', "EMAIL", "ACTIVATED", "DEACTIVATED", "DELETED"
            ])->default('EMAIL');
            $table->enum('gender', ['M', 'F'])->default('M');
            $table->enum('type', ['staff', 'member'])->default('member');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
