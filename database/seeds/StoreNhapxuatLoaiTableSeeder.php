<?php

use Illuminate\Database\Seeder;

class StoreNhapxuatLoaiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon\Carbon::now();
        DB::table('store_nhapxuat_loai')->insert(
            [
                [ 'id' => '1', 'ma_loai_nhapxuat' => 'LNX1', 'ten_loai_nhapxuat' => 'Nhập từ bên ngoài', 'la_nhap' => '1', 'la_noibo' => '0', 'la_hoantra' => '0', 'created_at' => $now],
                [ 'id' => '2', 'ma_loai_nhapxuat' => 'LNX2', 'ten_loai_nhapxuat' => 'Xuất ra bên ngoài', 'la_nhap' => '0', 'la_noibo' => '0', 'la_hoantra' => '0', 'created_at' => $now],
                [ 'id' => '3', 'ma_loai_nhapxuat' => 'LNX3', 'ten_loai_nhapxuat' => 'Nhập hoàn trả nội bộ', 'la_nhap' => '1', 'la_noibo' => '1', 'la_hoantra' => '1', 'created_at' => $now],
                [ 'id' => '4', 'ma_loai_nhapxuat' => 'LNX4', 'ten_loai_nhapxuat' => 'Xuất hoàn trả nội bộ', 'la_nhap' => '0', 'la_noibo' => '1', 'la_hoantra' => '1', 'created_at' => $now],
                [ 'id' => '6', 'ma_loai_nhapxuat' => 'LNX6', 'ten_loai_nhapxuat' => 'Xuất nội bộ', 'la_nhap' => '0', 'la_noibo' => '1', 'la_hoantra' => '0', 'created_at' => $now],
                [ 'id' => '8', 'ma_loai_nhapxuat' => 'LNX8', 'ten_loai_nhapxuat' => 'Xuất hủy', 'la_nhap' => '0', 'la_noibo' => '0', 'la_hoantra' => '0', 'created_at' => $now],
                [ 'id' => '9', 'ma_loai_nhapxuat' => 'LNX9', 'ten_loai_nhapxuat' => 'Xuất trả bên ngoài', 'la_nhap' => '0', 'la_noibo' => '0', 'la_hoantra' => '0', 'created_at' => $now],
                [ 'id' => '10', 'ma_loai_nhapxuat' => 'LNX10', 'ten_loai_nhapxuat' => 'Nhập nội bộ', 'la_nhap' => '1', 'la_noibo' => '1', 'la_hoantra' => '0', 'created_at' => $now],
                [ 'id' => '11', 'ma_loai_nhapxuat' => 'LNX11', 'ten_loai_nhapxuat' => 'Nhập tồn kho', 'la_nhap' => '1', 'la_noibo' => '0', 'la_hoantra' => '0', 'created_at' => $now],
                [ 'id' => '12', 'ma_loai_nhapxuat' => 'LNX12', 'ten_loai_nhapxuat' => 'Nhập hoàn trả từ bên ngoài', 'la_nhap' => '1', 'la_noibo' => '0', 'la_hoantra' => '0', 'created_at' => $now],
            ]
        );

        DB::statement('ALTER TABLE `store_nhapxuat_loai` AUTO_INCREMENT=1;');
    }
}
