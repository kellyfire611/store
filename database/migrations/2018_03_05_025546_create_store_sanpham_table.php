<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreSanphamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_sanpham', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('ma_sanpham', 191)->unique()->comment('Mã sản phẩm');
            $table->string('ten_sanpham', 191)->comment('Tên sản phẩm');
            $table->mediumText('ten_hoatchat')->nullable()->comment('Tên hoạt chất');
            $table->mediumText('nongdo_hamluong')->nullable()->comment('Nồng độ hàm lượng');
            $table->string('sokiemsoat')->nullable()->comment('Số kiểm soát');
            $table->string('anh', 4000)->nullable()->comment('Ảnh');
            
            $table->unsignedInteger('donvitinh_id')->nullable()->comment('Đơn vị tính');
            $table->unsignedInteger('nha_sanxuat_id')->nullable()->comment('Nhà sản xuất');
            $table->unsignedInteger('nuoc_sanxuat_id')->nullable()->comment('Nước sản xuất');
            
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
        Schema::dropIfExists('store_sanpham');
    }
}
