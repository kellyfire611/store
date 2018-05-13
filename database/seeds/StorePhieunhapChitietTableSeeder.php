<?php

use Illuminate\Database\Seeder;

class StorePhieunhapChitietTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon\Carbon::now();
        DB::table('store_phieunhap_chitiet')->insert(
            [
                [ 'id' => '1', 'ngay_sudungdautien' => $now, 'dongianhap' => 157500, 'soluongnhap' => 65, 'soluong_conlai' => 65, 'thue' => 0, 'hansudung' => $now->addMonths(18), 'so_lo' => null, 'so_chungtu' => null, 'nhapxuat_id' => 45, 'phieunhap_id' => 1, 'soketoan_id' => 1, 'nhap_vao_kho_id' => 1, 'sanpham_id' => 1, 'donvitinh_id' => 27, 'created_at' => $now],
            ]
        );

        DB::statement('ALTER TABLE `store_phieunhap_chitiet` AUTO_INCREMENT=1;');
    }
}
