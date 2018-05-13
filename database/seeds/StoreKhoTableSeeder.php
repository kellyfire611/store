<?php

use Illuminate\Database\Seeder;

class StoreKhoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon\Carbon::now();
        DB::table('store_kho')->insert(
            [
                [ 'id' => 1, 'ma_kho' => 'khochan_mientay', 'ten_kho' => 'Kho Chẵn Miền Tây', 'created_at' => $now],
                [ 'id' => 2, 'ma_kho' => 'khole_cantho', 'ten_kho' => 'Kho lẻ Cần Thơ', 'created_at' => $now],
                [ 'id' => 3, 'ma_kho' => 'khole_longan', 'ten_kho' => 'Kho lẻ Long An', 'created_at' => $now],
            ]
        );

        DB::statement('ALTER TABLE `store_kho` AUTO_INCREMENT=1;');
    }
}
