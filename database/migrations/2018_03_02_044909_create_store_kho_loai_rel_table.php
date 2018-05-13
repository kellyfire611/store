<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreKhoLoaiRelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_kho_loai_rel', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            
            $table->unsignedInteger('kho_id')->comment('Kho');
            $table->unsignedInteger('kho_loai_id')->comment('Loại kho');
            $table->smallInteger('company_id')->nullable();
            $table->foreign('kho_id')->references('id')->on('store_kho');
            $table->foreign('kho_loai_id')->references('id')->on('store_kho_loai');
            $table->unique(['kho_id', 'kho_loai_id'], 'store_kho_loai_rel_unique');
            
            $table->softDeletes();
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
        Schema::dropIfExists('store_kho_loai_rel');
    }
}
