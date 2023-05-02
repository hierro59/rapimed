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
        Schema::table('notifications_control_citas', function (Blueprint $table) {
            $table->integer('ncc_mas_un_dia')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications_control_citas', function (Blueprint $table) {
            $table->dropColumn('ncc_mas_un_dia');
        });
    }
};
