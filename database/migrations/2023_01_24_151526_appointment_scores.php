<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_scores', function (Blueprint $table) {
            $table->id();
            $table->integer('cita_id');
            $table->integer('customer_id')->nullable();
            $table->integer('specialist_id')->nullable();
            $table->integer('score');
            $table->string('commit')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('appointment_scores');
    }
};
