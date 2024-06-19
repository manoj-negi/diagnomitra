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
        if (!Schema::hasTable('appointments')) {
            Schema::create('appointments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('doctor_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreignId('patient_id')->references('id')->on('users')->onDelete('cascade');
                $table->boolean('by_turn_time')->default(0)->comment('0=>turn,1=>time');
                $table->date('date')->nullable();
                $table->time('time')->nullable();
                $table->integer('pin_number')->nullable();
                $table->enum('consult_type', ['physical', 'virtual'])->default('physical');
                $table->boolean('status')->default(0);
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
        Schema::dropIfExists('appointments');
    }
};