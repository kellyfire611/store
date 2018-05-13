<?php

use Illuminate\Database\Seeder;

class StoreKhoLoaiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon\Carbon::now();
        DB::table('store_kho_loai')->insert(
            [
                [ 'id' => '1', 'ma_loai_kho' => 'KC', 'ten_loai_kho' => 'Kho Chẳn', 'created_at' => $now],
                [ 'id' => '2', 'ma_loai_kho' => 'KL', 'ten_loai_kho' => 'Kho Lẻ', 'created_at' => $now],
                [ 'id' => '3', 'ma_loai_kho' => 'TT', 'ten_loai_kho' => 'Tủ trực', 'created_at' => $now],
                [ 'id' => '4', 'ma_loai_kho' => 'KK', 'ten_loai_kho' => 'Kho tại khoa', 'created_at' => $now],
                [ 'id' => '5', 'ma_loai_kho' => 'KT', 'ten_loai_kho' => 'Kho HC, VTYT, DY', 'created_at' => $now],
            ]
        );

        DB::statement('ALTER TABLE `store_kho_loai` AUTO_INCREMENT=1;');
    }
}
