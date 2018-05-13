<?php

use Illuminate\Database\Seeder;

class StoreNguoncungcapTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon\Carbon::now();
        DB::table('store_nguoncungcap')->insert(
            [
                [ 'id' => '1', 'ma_nguoncungcap' => 'BYT', 'ten_nguoncungcap' => 'Bộ y tế Việt Nam', 'created_at' => $now],
                [ 'id' => '2', 'ma_nguoncungcap' => 'WHO', 'ten_nguoncungcap' => 'Tổ chức y tế thế giới', 'created_at' => $now],
            ]
        );

        DB::statement('ALTER TABLE `store_nguoncungcap` AUTO_INCREMENT=1;');
    }
}
