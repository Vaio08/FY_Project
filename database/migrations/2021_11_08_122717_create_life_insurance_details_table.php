<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLifeInsuranceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('life_insurance_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('insurance_id');
            $table->foreign('insurance_id')->references('id')->on('insurances')->onDelete('cascade');
            $table->string('nominee_name', 50);
            $table->string('nominee_relation', 30);
            $table->string('nominee_father', 50);
            $table->string('nominee_mother', 50);
            $table->string('nominee_identity', 20)->nullable();
            $table->string('ensured_person_name', 50);
            $table->string('ensured_person_nid', 20);
            $table->text('details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('life_insurance_details');
    }
}
