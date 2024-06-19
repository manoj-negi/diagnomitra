<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password')->nullable();
                $table->string('number');
                $table->string('age')->nullable();
                $table->enum('sex', ['Male', 'Female', 'Non binary'])->nullable();
                $table->boolean('status')->comment('1=>active,0=>deactive')->default(1);
                $table->boolean('is_online')->comment('1=>online,0=>offline')->default(0);
                $table->boolean('is_virtual')->default(0)->comment('1=>true,0=>false');
                $table->boolean('by_turn_time')->default(0)->comment('0=>turn,1=>time');
                $table->boolean('is_doctor')->default(0)->comment('0=>false,1=>true');
                $table->boolean('is_profile')->default(0)->comment('0=>not updated profile,1=>updated profile');
                $table->string('profile_image')->nullable();
                $table->text('doctor_bio')->nullable();
                $table->integer('experience')->nullable();
                $table->string('address')->nullable();
                $table->string('dob')->nullable();
                $table->enum('is_approved', ['approved', 'pending', 'rejected'])->default('pending');
                $table->unsignedBigInteger('subscription_inventory_id')->nullable();
                $table->string('exequatur_number')->nullable();
                $table->string('otp')->nullable();
                $table->bigInteger('otp_expire')->nullable();
                $table->text('fcm_token')->nullable();
                $table->text('types_of_consultation')->nullable();
                $table->rememberToken();
                $table->timestamps();
            });
        }
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
};