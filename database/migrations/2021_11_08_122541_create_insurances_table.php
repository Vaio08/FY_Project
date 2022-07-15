<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('insurance_type_id');
            $table->foreign('insurance_type_id')->references('id')->on('insurance_types')->onDelete('cascade');
            $table->integer('policy_no');
            $table->float('insurance_amount');
            $table->float('deposited_money')->default(0);
            $table->date('insurance_date');
            $table->date('mature_date');
            $table->boolean('withdraw_status')->default(false);
            $table->string('withdraw_reason')->nullable();
            $table->date('withdraw_date')->nullable();
            $table->unsignedBigInteger('agent_id');
            $table->foreign('agent_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('insurances');
    }
}
