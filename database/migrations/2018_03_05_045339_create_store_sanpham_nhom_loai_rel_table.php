<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreSanphamNhomLoaiRelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_sanpham_nhom_loai_rel', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            
            $table->unsignedInteger('sanpham_id')->comment('Sản phẩm');
            $table->unsignedInteger('sanpham_nhom_id')->comment('Nhóm sản phẩm');
            $table->unsignedInteger('sanpham_loai_id')->comment('Loại sản phẩm');
            $table->foreign('sanpham_id')->references('id')->on('store_sanpham');
            $table->foreign('sanpham_nhom_id')->references('id')->on('store_sanpham_nhom');
            $table->foreign('sanpham_loai_id')->references('id')->on('store_sanpham_loai');
            $table->unique(['sanpham_id', 'sanpham_nhom_id', 'sanpham_loai_id'], 'store_sanpham_nhom_loai_rel_unique');
            
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
        Schema::dropIfExists('store_sanpham_nhom_loai_rel');
    }
}
