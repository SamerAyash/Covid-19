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
            $table->enum('status',['healthy','injured ','contact']);
            $table->string('id_number')->unique();
            $table->string('first_name');
            $table->string('father_name');
            $table->string('granddad_name');
            $table->string('last_name');
            $table->enum('gender',['male','female']);
            $table->string('phone');
            $table->string('city');
            $table->string('area');
            $table->date('date_injury')->nullable();
            $table->date('injury_days')->nullable();
            $table->date('date_healing')->nullable();
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
