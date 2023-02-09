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
        Schema::create('metadata_users', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->mediumText('medical_history')->nullable();
            $table->string('address')->nullable()->default('Sin datos');
            $table->string('city')->nullable()->default('Sin datos');
            $table->string('state')->nullable()->default('Sin datos');
            $table->string('country')->nullable()->default('Sin datos');
            $table->string('phone')->nullable()->default('Sin teléfono');
            $table->integer('sex')->default(0);
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
        Schema::dropIfExists('metadata_users');
    }
};
