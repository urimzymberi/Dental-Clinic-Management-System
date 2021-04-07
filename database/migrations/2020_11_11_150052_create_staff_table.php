<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('role', 15)->index();
            $table->boolean('isactive');
            $table->string('name', 50)->index();
            $table->string('email',100)->nullable();
            $table->string('password',255);
            $table->string('personal_number', 11)->nullable();
            $table->string('phone', 20)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('image',255)->nullable();
            $table->text('biography')->nullable();
            $table->string('address',255)->nullable();
            $table->string('city',20)->nullable();
            $table->string('state',20)->nullable();
            $table->json('education')->nullable();
            $table->json('experience')->nullable();
            $table->json('service')->nullable();
            $table->json('specialization')->nullable();
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
        Schema::dropIfExists('staff');
    }
}
