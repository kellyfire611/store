<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStorePhieuxuatChitietTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_phieuxuat_chitiet', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->dateTime('ngay_sudungdautien')->nullable()->comment('Ngày sử dụng đầu tiên');
            $table->decimal('dongiaxuat', 16, 6)->comment('Đơn giá xuất');
            $table->decimal('soluongxuat', 16, 6)->comment('Số lượng xuất');
            $table->decimal('thue', 16, 6)->nullable()->comment('Thuế');
            $table->dateTime('hansudung')->nullable()->comment('Hạn sử dụng');
            $table->text('so_lo')->nullable()->comment('Số lô');
            $table->text('so_chungtu')->nullable()->comment('Số chứng từ');
            $table->boolean('cotinhphi')->comment('Có tính phí');
            
            $table->unsignedInteger('nhapxuat_id')->comment('Nhập xuất');
            $table->unsignedInteger('phieuxuat_id')->comment('Phiếu xuất');
            $table->unsignedInteger('soketoan_id')->comment('Sổ kế toán');
            $table->unsignedInteger('xuat_tu_kho_id')->comment('Xuất từ kho');
            $table->unsignedInteger('sanpham_id')->comment('Sản phẩm');
            $table->unsignedInteger('donvitinh_id')->comment('Đơn vị tính');
            $table->unsignedInteger('phieunhap_chitiet_id')->comment('Phiếu nhập chi tiết');
            $table->foreign('donvitinh_id')->references('id')->on('store_donvitinh');
            $table->foreign('phieuxuat_id')->references('id')->on('store_phieuxuat');
            $table->foreign('sanpham_id')->references('id')->on('store_sanpham');
            $table->foreign('xuat_tu_kho_id')->references('id')->on('store_kho');
            $table->foreign('nhapxuat_id')->references('id')->on('store_nhapxuat');
            $table->foreign('phieunhap_chitiet_id')->references('id')->on('store_phieunhap_chitiet');
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
        Schema::dropIfExists('store_phieuxuat_chitiet');
    }
}
