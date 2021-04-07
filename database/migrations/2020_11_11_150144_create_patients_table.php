<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->boolean('isactive')->default(0);
            $table->string('name', 50)->index();
            $table->date('date_of_birth');
            $table->string('email',100);
            $table->string('password',255);
            $table->string('personal_number',11)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('address',255)->nullable();
            $table->string('city',20)->nullable();
            $table->string('state',20)->nullable();
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
        Schema::dropIfExists('patients');
    }
}
