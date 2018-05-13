<?php

use Illuminate\Database\Seeder;

class StoreKhoLoaiRelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon\Carbon::now();
        DB::table('store_kho_loai_rel')->insert(
            [
                [ 'id' => '1', 'kho_id' => 1, 'kho_loai_id' => 1, 'created_at' => $now],
                [ 'id' => '2', 'kho_id' => 2, 'kho_loai_id' => 2, 'created_at' => $now],
            ]
        );

        DB::statement('ALTER TABLE `store_kho_loai_rel` AUTO_INCREMENT=1;');
    }
}
