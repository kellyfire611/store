<?php

use Illuminate\Database\Seeder;

class StoreSoketoanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon\Carbon::now();
        DB::table('store_soketoan')->insert(
            [
                [ 'id' => '1', 'ma_soketoan' => '201803', 'ngay_batdau' => $now, 'ngay_ketthuc' => null, 'ngay_khoaso' => null, 'created_at' => $now],
            ]
        );

        DB::statement('ALTER TABLE `store_soketoan` AUTO_INCREMENT=1;');
    }
}
