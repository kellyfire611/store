<?php

use Illuminate\Database\Seeder;

class HrmTinhthanhTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon\Carbon::now();
        DB::table('hrm_tinhthanh')->insert(
            [
                [ 'id' => '1', 'ma_tinhthanh' => '1', 'ten_tinhthanh' => 'Hà Nội ', 'created_at' => $now],
                [ 'id' => '2', 'ma_tinhthanh' => '2', 'ten_tinhthanh' => 'Hà Giang ', 'created_at' => $now],
                [ 'id' => '3', 'ma_tinhthanh' => '4', 'ten_tinhthanh' => 'Cao Bằng ', 'created_at' => $now],
                [ 'id' => '4', 'ma_tinhthanh' => '6', 'ten_tinhthanh' => 'Bắc Cạn ', 'created_at' => $now],
                [ 'id' => '5', 'ma_tinhthanh' => '8', 'ten_tinhthanh' => 'Tuyên Quang ', 'created_at' => $now],
                [ 'id' => '6', 'ma_tinhthanh' => '10', 'ten_tinhthanh' => 'Lào Cai ', 'created_at' => $now],
                [ 'id' => '7', 'ma_tinhthanh' => '11', 'ten_tinhthanh' => 'Điện Biên ', 'created_at' => $now],
                [ 'id' => '8', 'ma_tinhthanh' => '12', 'ten_tinhthanh' => 'Lai Châu ', 'created_at' => $now],
                [ 'id' => '9', 'ma_tinhthanh' => '14', 'ten_tinhthanh' => 'Sơn La ', 'created_at' => $now],
                [ 'id' => '10', 'ma_tinhthanh' => '15', 'ten_tinhthanh' => 'Yên Bái', 'created_at' => $now],
                [ 'id' => '11', 'ma_tinhthanh' => '17', 'ten_tinhthanh' => 'Hòa Bình ', 'created_at' => $now],
                [ 'id' => '12', 'ma_tinhthanh' => '19', 'ten_tinhthanh' => 'Thái Nguyên', 'created_at' => $now],
                [ 'id' => '13', 'ma_tinhthanh' => '20', 'ten_tinhthanh' => 'Lạng Sơn ', 'created_at' => $now],
                [ 'id' => '14', 'ma_tinhthanh' => '22', 'ten_tinhthanh' => 'Quảng Ninh ', 'created_at' => $now],
                [ 'id' => '15', 'ma_tinhthanh' => '24', 'ten_tinhthanh' => 'Bắc Giang ', 'created_at' => $now],
                [ 'id' => '16', 'ma_tinhthanh' => '25', 'ten_tinhthanh' => 'Phú Thọ ', 'created_at' => $now],
                [ 'id' => '17', 'ma_tinhthanh' => '26', 'ten_tinhthanh' => 'Vĩnh Phúc ', 'created_at' => $now],
                [ 'id' => '18', 'ma_tinhthanh' => '27', 'ten_tinhthanh' => 'Bắc Ninh', 'created_at' => $now],
                [ 'id' => '19', 'ma_tinhthanh' => '30', 'ten_tinhthanh' => 'Hải Dương ', 'created_at' => $now],
                [ 'id' => '20', 'ma_tinhthanh' => '31', 'ten_tinhthanh' => 'Hải Phòng ', 'created_at' => $now],
                [ 'id' => '21', 'ma_tinhthanh' => '33', 'ten_tinhthanh' => 'Hưng Yên ', 'created_at' => $now],
                [ 'id' => '22', 'ma_tinhthanh' => '34', 'ten_tinhthanh' => 'Thái Bình', 'created_at' => $now],
                [ 'id' => '23', 'ma_tinhthanh' => '35', 'ten_tinhthanh' => 'Hà Nam', 'created_at' => $now],
                [ 'id' => '24', 'ma_tinhthanh' => '36', 'ten_tinhthanh' => 'Nam Định ', 'created_at' => $now],
                [ 'id' => '25', 'ma_tinhthanh' => '37', 'ten_tinhthanh' => 'Ninh Bình', 'created_at' => $now],
                [ 'id' => '26', 'ma_tinhthanh' => '38', 'ten_tinhthanh' => 'Thanh Hóa ', 'created_at' => $now],
                [ 'id' => '27', 'ma_tinhthanh' => '40', 'ten_tinhthanh' => 'Nghệ An ', 'created_at' => $now],
                [ 'id' => '28', 'ma_tinhthanh' => '42', 'ten_tinhthanh' => 'Hà Tĩnh ', 'created_at' => $now],
                [ 'id' => '29', 'ma_tinhthanh' => '44', 'ten_tinhthanh' => 'Quảng Bình ', 'created_at' => $now],
                [ 'id' => '30', 'ma_tinhthanh' => '45', 'ten_tinhthanh' => 'Quảng Trị ', 'created_at' => $now],
                [ 'id' => '31', 'ma_tinhthanh' => '46', 'ten_tinhthanh' => 'Thừa Thiên Huế ', 'created_at' => $now],
                [ 'id' => '32', 'ma_tinhthanh' => '48', 'ten_tinhthanh' => 'Đà Nẵng ', 'created_at' => $now],
                [ 'id' => '33', 'ma_tinhthanh' => '49', 'ten_tinhthanh' => 'Quảng Nam', 'created_at' => $now],
                [ 'id' => '34', 'ma_tinhthanh' => '51', 'ten_tinhthanh' => 'Quãng Ngãi', 'created_at' => $now],
                [ 'id' => '35', 'ma_tinhthanh' => '52', 'ten_tinhthanh' => 'Bình Định', 'created_at' => $now],
                [ 'id' => '36', 'ma_tinhthanh' => '54', 'ten_tinhthanh' => 'Phú Yên', 'created_at' => $now],
                [ 'id' => '37', 'ma_tinhthanh' => '56', 'ten_tinhthanh' => 'Khánh Hòa', 'created_at' => $now],
                [ 'id' => '38', 'ma_tinhthanh' => '58', 'ten_tinhthanh' => 'Ninh Thuận ', 'created_at' => $now],
                [ 'id' => '39', 'ma_tinhthanh' => '60', 'ten_tinhthanh' => 'Bình Thuận ', 'created_at' => $now],
                [ 'id' => '40', 'ma_tinhthanh' => '62', 'ten_tinhthanh' => 'Kom Tum ', 'created_at' => $now],
                [ 'id' => '41', 'ma_tinhthanh' => '64', 'ten_tinhthanh' => 'Gia Lai ', 'created_at' => $now],
                [ 'id' => '42', 'ma_tinhthanh' => '66', 'ten_tinhthanh' => 'Đắc Lắk ', 'created_at' => $now],
                [ 'id' => '43', 'ma_tinhthanh' => '67', 'ten_tinhthanh' => 'Đắk Nông ', 'created_at' => $now],
                [ 'id' => '44', 'ma_tinhthanh' => '68', 'ten_tinhthanh' => 'Lâm Đồng ', 'created_at' => $now],
                [ 'id' => '45', 'ma_tinhthanh' => '70', 'ten_tinhthanh' => 'Bình Phước', 'created_at' => $now],
                [ 'id' => '46', 'ma_tinhthanh' => '72', 'ten_tinhthanh' => 'Tây Ninh ', 'created_at' => $now],
                [ 'id' => '47', 'ma_tinhthanh' => '74', 'ten_tinhthanh' => 'Bình Dương', 'created_at' => $now],
                [ 'id' => '48', 'ma_tinhthanh' => '75', 'ten_tinhthanh' => 'Đồng Nai ', 'created_at' => $now],
                [ 'id' => '49', 'ma_tinhthanh' => '77', 'ten_tinhthanh' => 'Bà Rịa - Vũng Tàu', 'created_at' => $now],
                [ 'id' => '50', 'ma_tinhthanh' => '79', 'ten_tinhthanh' => 'Tp. Hồ Chí Minh ', 'created_at' => $now],
                [ 'id' => '51', 'ma_tinhthanh' => '80', 'ten_tinhthanh' => 'Long An ', 'created_at' => $now],
                [ 'id' => '52', 'ma_tinhthanh' => '82', 'ten_tinhthanh' => 'Tiền Giang ', 'created_at' => $now],
                [ 'id' => '53', 'ma_tinhthanh' => '83', 'ten_tinhthanh' => 'Bến Tre ', 'created_at' => $now],
                [ 'id' => '54', 'ma_tinhthanh' => '84', 'ten_tinhthanh' => 'Trà Vinh   ', 'created_at' => $now],
                [ 'id' => '55', 'ma_tinhthanh' => '86', 'ten_tinhthanh' => 'Vĩnh Long ', 'created_at' => $now],
                [ 'id' => '56', 'ma_tinhthanh' => '87', 'ten_tinhthanh' => 'Đồng Tháp ', 'created_at' => $now],
                [ 'id' => '57', 'ma_tinhthanh' => '89', 'ten_tinhthanh' => 'An Giang', 'created_at' => $now],
                [ 'id' => '58', 'ma_tinhthanh' => '91', 'ten_tinhthanh' => 'Kiên Giang ', 'created_at' => $now],
                [ 'id' => '59', 'ma_tinhthanh' => '92', 'ten_tinhthanh' => 'Cần Thơ ', 'created_at' => $now],
                [ 'id' => '60', 'ma_tinhthanh' => '93', 'ten_tinhthanh' => 'Hậu Giang', 'created_at' => $now],
                [ 'id' => '61', 'ma_tinhthanh' => '94', 'ten_tinhthanh' => 'Sóc Trăng ', 'created_at' => $now],
                [ 'id' => '62', 'ma_tinhthanh' => '95', 'ten_tinhthanh' => 'Bạc Liêu ', 'created_at' => $now],
                [ 'id' => '63', 'ma_tinhthanh' => '96', 'ten_tinhthanh' => 'Cà Mau', 'created_at' => $now],
                [ 'id' => '64', 'ma_tinhthanh' => '97', 'ten_tinhthanh' => 'Quảng Đông', 'created_at' => $now],
            ]
        );

        DB::statement('ALTER TABLE `hrm_tinhthanh` AUTO_INCREMENT=1;');
    }
}
