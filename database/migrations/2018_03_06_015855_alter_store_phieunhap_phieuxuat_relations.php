<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterStorePhieunhapPhieuxuatRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('store_phieunhap', function (Blueprint $table) {
            $table->foreign('phieuxuat_id')->references('id')->on('store_phieuxuat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('store_phieunhap', function (Blueprint $table) {
            $table->dropForeign(['phieuxuat_id']);
        });
    }
}
