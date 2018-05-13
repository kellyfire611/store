<?php

use Illuminate\Database\Seeder;

class StoreNhapxuatLoaiRelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon\Carbon::now();
        DB::table('store_nhapxuat_loai_rel')->insert(
            [
                
            ]
        );

        DB::statement('ALTER TABLE `store_nhapxuat_loai_rel` AUTO_INCREMENT=1;');
    }
}
