<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreKhoNhapxuatRelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_kho_nhapxuat_rel', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            
            $table->unsignedInteger('tu_kho_id')->comment('Từ kho');
            $table->unsignedInteger('den_kho_id')->nullable()->comment('Đến kho');
            $table->unsignedInteger('nhapxuat_id')->nullable()->comment('Nhập xuất');
            $table->foreign('tu_kho_id')->references('id')->on('store_kho');
            $table->foreign('den_kho_id')->references('id')->on('store_kho');
            $table->foreign('nhapxuat_id')->references('id')->on('store_nhapxuat');
            $table->unique(['tu_kho_id', 'den_kho_id', 'nhapxuat_id'], 'store_kho_nhapxuat_rel_unique');
            
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
        Schema::dropIfExists('store_kho_nhapxuat_rel');
    }
}
