<?php

use Illuminate\Database\Seeder;

class StorePhieunhapTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon\Carbon::now();
        DB::table('store_phieunhap')->insert(
            [
                [ 'id' => '1', 'so_phieunhap' => 'NTKDK000001/201803', 'ngay_nhapkho' => $now, 'ngay_laphoadon' => $now, 'ngay_xacnhan' => $now, 'lydo_nhap' => 'Nhập tồn kho đầu kỳ', 'nguoi_giaohang' => 'Nguyễn Văn Giao Hàng', 'so_chungtu' => null, 'nhapxuat_id' => 45, 'phieuxuat_id' => null, 'nhacungcap_id' => null, 'chuongtrinh_id' => null, 'soketoan_id' => 1, 'nhap_tu_kho_id' => null, 'nhap_vao_kho_id' => 1, 'nguoi_lapphieu_id' => 1, 'created_at' => $now],
            ]
        );

        DB::statement('ALTER TABLE `store_phieunhap` AUTO_INCREMENT=1;');
    }
}
