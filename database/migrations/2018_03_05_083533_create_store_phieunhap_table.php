<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStorePhieunhapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_phieunhap', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('so_phieunhap', 191)->unique()->comment('Số phiếu nhập');
            $table->dateTime('ngay_nhapkho')->comment('Ngày nhập kho');
            $table->dateTime('ngay_laphoadon')->nullable()->comment('Ngày lập hóa đơn');
            $table->dateTime('ngay_xacnhan')->nullable()->comment('Ngày xác nhận');
            $table->text('lydo_nhap')->nullable()->comment('Lý do nhập');
            $table->text('nguoi_giaohang')->nullable()->comment('Người giao hàng');
            $table->text('so_chungtu')->nullable()->comment('Số chứng từ');
            
            $table->unsignedInteger('nhapxuat_id')->comment('Nhập xuất');
            $table->unsignedInteger('phieuxuat_id')->nullable()->comment('Phiếu xuất');
            $table->unsignedInteger('nhacungcap_id')->nullable()->comment('Nhà cung cấp');
            $table->unsignedInteger('chuongtrinh_id')->nullable()->comment('Chương trình');
            $table->unsignedInteger('soketoan_id')->comment('Sổ kế toán');
            $table->unsignedInteger('nhap_tu_kho_id')->nullable()->comment('Nhập từ kho');
            $table->unsignedInteger('nhap_vao_kho_id')->comment('Nhập vào kho');
            $table->unsignedInteger('nguoi_lapphieu_id')->comment('Người lập phiếu');
            $table->foreign('nhap_tu_kho_id')->references('id')->on('store_kho');
            $table->foreign('nhap_vao_kho_id')->references('id')->on('store_kho');
            $table->foreign('nhacungcap_id')->references('id')->on('store_nhacungcap');
            $table->foreign('chuongtrinh_id')->references('id')->on('store_chuongtrinh');
            $table->foreign('soketoan_id')->references('id')->on('store_soketoan');
            $table->foreign('nguoi_lapphieu_id')->references('id')->on('users');
            $table->foreign('nhapxuat_id')->references('id')->on('store_nhapxuat');

            /*
            Tổ kiểm nhập: nhiều người (họ tên, chức vụ)
            Lý do kiểm nhập:
            Địa điểm kiểm nhập:
            Kết quả: là các dòng chi tiết
                - Quy cách đóng gói
                - Nguồn???? : NSNN (Ngân sách nhà nước); QTC (Quần tài trợ)
            Ý kiến đề xuất:

            Thành viên            Thư ký            Chủ tịch hội đồng kiểm nhập
            */
            
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
        Schema::dropIfExists('store_phieunhap');
    }
}
