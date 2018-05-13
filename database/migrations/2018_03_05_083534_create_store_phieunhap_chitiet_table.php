<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStorePhieunhapChitietTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_phieunhap_chitiet', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->dateTime('ngay_sudungdautien')->nullable()->comment('Ngày sử dụng đầu tiên');
            $table->decimal('dongianhap', 16, 6)->comment('Đơn giá nhập');
            $table->decimal('soluongnhap', 16, 6)->comment('Số lượng nhập');
            $table->decimal('soluong_conlai', 16, 6)->comment('Số lượng còn lại');
            $table->decimal('thue', 16, 6)->nullable()->comment('Thuế');
            $table->dateTime('hansudung')->nullable()->comment('Hạn sử dụng');
            $table->text('so_lo')->nullable()->comment('Số lô');
            $table->text('so_chungtu')->nullable()->comment('Số chứng từ');
            
            $table->unsignedInteger('nhapxuat_id')->comment('Nhập xuất');
            $table->unsignedInteger('phieunhap_id')->comment('Phiếu nhập');
            $table->unsignedInteger('soketoan_id')->comment('Sổ kế toán');
            $table->unsignedInteger('nhap_vao_kho_id')->comment('Nhập vào kho');
            $table->unsignedInteger('sanpham_id')->comment('Sản phẩm');
            $table->unsignedInteger('donvitinh_id')->comment('Đơn vị tính');
            $table->foreign('donvitinh_id')->references('id')->on('store_donvitinh');
            $table->foreign('phieunhap_id')->references('id')->on('store_phieunhap');
            $table->foreign('sanpham_id')->references('id')->on('store_sanpham');
            $table->foreign('nhap_vao_kho_id')->references('id')->on('store_kho');
            $table->foreign('nhapxuat_id')->references('id')->on('store_nhapxuat');
            $table->foreign('soketoan_id')->references('id')->on('store_soketoan');
            
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
        Schema::dropIfExists('store_phieunhap_chitiet');
    }
}
