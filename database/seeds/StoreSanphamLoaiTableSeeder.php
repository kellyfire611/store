<?php

use Illuminate\Database\Seeder;

class StoreSanphamLoaiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon\Carbon::now();
        DB::table('store_sanpham_loai')->insert(
            [
                [ 'id' => '1', 'ma_loai_sanpham' => 'T', 'ten_loai_sanpham' => 'Thuốc', 'created_at' => $now],
                [ 'id' => '2', 'ma_loai_sanpham' => 'HC', 'ten_loai_sanpham' => 'Hóa chất', 'created_at' => $now],
                [ 'id' => '3', 'ma_loai_sanpham' => 'TP', 'ten_loai_sanpham' => 'Thuốc phiến', 'created_at' => $now],
                [ 'id' => '4', 'ma_loai_sanpham' => 'VT', 'ten_loai_sanpham' => 'Vật tư y tế', 'created_at' => $now],
                [ 'id' => '5', 'ma_loai_sanpham' => 'VC', 'ten_loai_sanpham' => 'Vắc xin, sinh phẩm', 'created_at' => $now],
                [ 'id' => '6', 'ma_loai_sanpham' => 'M', 'ten_loai_sanpham' => 'Máu', 'created_at' => $now],
                [ 'id' => '7', 'ma_loai_sanpham' => 'O', 'ten_loai_sanpham' => 'Oxy thở', 'created_at' => $now],
                [ 'id' => '8', 'ma_loai_sanpham' => 'AP', 'ten_loai_sanpham' => 'Ấn phẩm', 'created_at' => $now],
            ]
        );

        DB::statement('ALTER TABLE `store_sanpham_loai` AUTO_INCREMENT=1;');
    }
}
