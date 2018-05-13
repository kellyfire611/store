<?php

use Illuminate\Database\Seeder;

class StoreKhoNhapxuatRelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon\Carbon::now();
        DB::table('store_kho_nhapxuat_rel')->insert(
            [
                
            ]
        );

        DB::statement('ALTER TABLE `store_kho_nhapxuat_rel` AUTO_INCREMENT=1;');
    }
}
