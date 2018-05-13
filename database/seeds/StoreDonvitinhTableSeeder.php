<?php

use Illuminate\Database\Seeder;

class StoreDonvitinhTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon\Carbon::now();
        DB::table('store_donvitinh')->insert(
            [
                [ 'id' => '1', 'ma_donvitinh' => 'B', 'ten_donvitinh' => 'Bình', 'created_at' => $now],
                [ 'id' => '2', 'ma_donvitinh' => 'C', 'ten_donvitinh' => 'Cái', 'created_at' => $now],
                [ 'id' => '3', 'ma_donvitinh' => 'CA', 'ten_donvitinh' => 'Cây', 'created_at' => $now],
                [ 'id' => '4', 'ma_donvitinh' => 'CAN', 'ten_donvitinh' => 'Can', 'created_at' => $now],
                [ 'id' => '5', 'ma_donvitinh' => 'CH', 'ten_donvitinh' => 'Chai', 'created_at' => $now],
                [ 'id' => '6', 'ma_donvitinh' => 'CU', 'ten_donvitinh' => 'Cục', 'created_at' => $now],
                [ 'id' => '7', 'ma_donvitinh' => 'ĐV', 'ten_donvitinh' => 'Đơn Vị', 'created_at' => $now],
                [ 'id' => '8', 'ma_donvitinh' => 'G', 'ten_donvitinh' => 'Gram', 'created_at' => $now],
                [ 'id' => '9', 'ma_donvitinh' => 'GI', 'ten_donvitinh' => 'Giờ', 'created_at' => $now],
                [ 'id' => '10', 'ma_donvitinh' => 'GO', 'ten_donvitinh' => 'Gói', 'created_at' => $now],
                [ 'id' => '11', 'ma_donvitinh' => 'H', 'ten_donvitinh' => 'Hộp', 'created_at' => $now],
                [ 'id' => '12', 'ma_donvitinh' => 'L', 'ten_donvitinh' => 'Lít', 'created_at' => $now],
                [ 'id' => '13', 'ma_donvitinh' => 'LA', 'ten_donvitinh' => 'Lần', 'created_at' => $now],
                [ 'id' => '14', 'ma_donvitinh' => 'LI', 'ten_donvitinh' => 'Liều', 'created_at' => $now],
                [ 'id' => '15', 'ma_donvitinh' => 'LO', 'ten_donvitinh' => 'Lọ', 'created_at' => $now],
                [ 'id' => '16', 'ma_donvitinh' => 'M', 'ten_donvitinh' => 'Miếng', 'created_at' => $now],
                [ 'id' => '17', 'ma_donvitinh' => 'ML', 'ten_donvitinh' => 'ml', 'created_at' => $now],
                [ 'id' => '18', 'ma_donvitinh' => 'O', 'ten_donvitinh' => 'Ống', 'created_at' => $now],
                [ 'id' => '19', 'ma_donvitinh' => 'QU', 'ten_donvitinh' => 'Quả', 'created_at' => $now],
                [ 'id' => '20', 'ma_donvitinh' => 'Q', 'ten_donvitinh' => 'Que', 'created_at' => $now],
                [ 'id' => '21', 'ma_donvitinh' => 'S', 'ten_donvitinh' => 'Sợi', 'created_at' => $now],
                [ 'id' => '22', 'ma_donvitinh' => 'T', 'ten_donvitinh' => 'Tube', 'created_at' => $now],
                [ 'id' => '23', 'ma_donvitinh' => 'TE', 'ten_donvitinh' => 'Tép', 'created_at' => $now],
                [ 'id' => '24', 'ma_donvitinh' => 'TH', 'ten_donvitinh' => 'Thùng', 'created_at' => $now],
                [ 'id' => '25', 'ma_donvitinh' => 'THA', 'ten_donvitinh' => 'Thanh', 'created_at' => $now],
                [ 'id' => '26', 'ma_donvitinh' => 'TU', 'ten_donvitinh' => 'Túi', 'created_at' => $now],
                [ 'id' => '27', 'ma_donvitinh' => 'V', 'ten_donvitinh' => 'Viên', 'created_at' => $now],
                [ 'id' => '28', 'ma_donvitinh' => 'VI', 'ten_donvitinh' => 'Vĩ', 'created_at' => $now],
                [ 'id' => '29', 'ma_donvitinh' => 'X', 'ten_donvitinh' => 'Xấp', 'created_at' => $now],
                [ 'id' => '30', 'ma_donvitinh' => 'CUON', 'ten_donvitinh' => 'Cuộn', 'created_at' => $now],
                [ 'id' => '31', 'ma_donvitinh' => 'KG', 'ten_donvitinh' => 'Kg', 'created_at' => $now],
                [ 'id' => '32', 'ma_donvitinh' => 'MET', 'ten_donvitinh' => 'Mét', 'created_at' => $now],
                [ 'id' => '33', 'ma_donvitinh' => 'CHIEC', 'ten_donvitinh' => 'Chiếc', 'created_at' => $now],
                [ 'id' => '34', 'ma_donvitinh' => 'BUT', 'ten_donvitinh' => 'Bút', 'created_at' => $now],
                [ 'id' => '35', 'ma_donvitinh' => 'BIC', 'ten_donvitinh' => 'Bịch', 'created_at' => $now],
                [ 'id' => '36', 'ma_donvitinh' => 'BO', 'ten_donvitinh' => 'Bộ', 'created_at' => $now],
                [ 'id' => '37', 'ma_donvitinh' => 'CAP', 'ten_donvitinh' => 'Cặp', 'created_at' => $now],
                [ 'id' => '38', 'ma_donvitinh' => 'TEST', 'ten_donvitinh' => 'Test', 'created_at' => $now],
                [ 'id' => '39', 'ma_donvitinh' => 'ĐÔI', 'ten_donvitinh' => 'Đôi', 'created_at' => $now],
                [ 'id' => '40', 'ma_donvitinh' => 'CM', 'ten_donvitinh' => 'cm', 'created_at' => $now],
                [ 'id' => '41', 'ma_donvitinh' => 'BONG', 'ten_donvitinh' => 'Bóng', 'created_at' => $now],
                [ 'id' => '42', 'ma_donvitinh' => 'MUI', 'ten_donvitinh' => 'mũi', 'created_at' => $now],
                [ 'id' => '43', 'ma_donvitinh' => 'DAY', 'ten_donvitinh' => 'dây', 'created_at' => $now],
                [ 'id' => '44', 'ma_donvitinh' => 'BAO', 'ten_donvitinh' => 'bao', 'created_at' => $now],
                [ 'id' => '45', 'ma_donvitinh' => 'LOO', 'ten_donvitinh' => 'lỗ', 'created_at' => $now],
                [ 'id' => '46', 'ma_donvitinh' => 'QUYEN', 'ten_donvitinh' => 'Quyển', 'created_at' => $now],
                [ 'id' => '47', 'ma_donvitinh' => 'TO', 'ten_donvitinh' => 'Tờ', 'created_at' => $now],
            ]
        );

        DB::statement('ALTER TABLE `store_donvitinh` AUTO_INCREMENT=1;');
    }
}
