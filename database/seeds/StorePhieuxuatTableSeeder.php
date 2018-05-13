<?php

use Illuminate\Database\Seeder;

class StorePhieuxuatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon\Carbon::now();
        // Xuất Nội bộ
        DB::table('store_phieuxuat')->insert(
            [
                [ 'id' => '1', 'so_phieuxuat' => 'XKL000001/201803', 'ngay_xuatkho' => $now, 'ngay_xacnhan' => $now, 'lydo_xuat' => 'Xuất từ Kho Miền tây -> kho lẻ Cần Thơ', 'nguoi_nhanhang' => 'Nguyễn Văn Cần Thơ', 'so_chungtu' => null, 'nhapxuat_id' => 9, 'nhacungcap_id' => null, 'chuongtrinh_id' => null, 'soketoan_id' => 1, 'xuat_tu_kho_id' => 1, 'xuat_den_kho_id' => 2, 'nguoi_lapphieu_id' => 1, 'created_at' => $now],
            ]
        );

        // Tạo phiếu nhập Nội bộ tương ứng
        DB::table('store_phieunhap')->insert(
            [
                [ 'id' => '2', 'so_phieunhap' => 'XKL000001/201803', 'ngay_nhapkho' => $now, 'ngay_laphoadon' => $now, 'ngay_xacnhan' => $now, 'lydo_nhap' => 'Nhập từ phiếu Xuất XKL000001/201803', 'nguoi_giaohang' => 'Nguyễn Văn Cần Thơ', 'so_chungtu' => null, 'nhapxuat_id' => 29, 'phieuxuat_id' => 1, 'nhacungcap_id' => null, 'chuongtrinh_id' => null, 'soketoan_id' => 1, 'nhap_tu_kho_id' => 1, 'nhap_vao_kho_id' => 2, 'nguoi_lapphieu_id' => 1, 'created_at' => $now],
            ]
        );

        DB::statement('ALTER TABLE `store_phieuxuat` AUTO_INCREMENT=1;');
    }
}
