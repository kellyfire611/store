<?php

use Illuminate\Database\Seeder;

class StoreNhacungcapTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon\Carbon::now();
        DB::table('store_nhacungcap')->insert(
            [
                [ 'id' => '1', 'ma_nhacungcap' => 'NCC1', 'ten_nhacungcap' => 'CTY TNHH Nhà cung cấp 1', 'diachi_nhacungcap' => 'Địa chỉ CTY TNHH Nhà cung cấp 1', 'sodienthoai_nhacungcap' => 'Số điện thoại CTY TNHH Nhà cung cấp 1', 'created_at' => $now],
            ]
        );

        DB::statement('ALTER TABLE `store_nhacungcap` AUTO_INCREMENT=1;');
    }
}
