<?php

use Illuminate\Database\Seeder;

class HrmQuocgiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon\Carbon::now();
        DB::table('hrm_quocgia')->insert(
            [
                [ 'id' => '1', 'ma_quocgia' => 'US', 'ten_quocgia' => 'Hoa Kỳ', 'created_at' => $now],
                [ 'id' => '2', 'ma_quocgia' => 'UK', 'ten_quocgia' => 'Anh', 'created_at' => $now],
                [ 'id' => '3', 'ma_quocgia' => '84', 'ten_quocgia' => 'Việt Nam', 'created_at' => $now],
                [ 'id' => '4', 'ma_quocgia' => '95', 'ten_quocgia' => 'Myanmar', 'created_at' => $now],
                [ 'id' => '5', 'ma_quocgia' => '60', 'ten_quocgia' => 'Malaysia', 'created_at' => $now],
                [ 'id' => '6', 'ma_quocgia' => '33', 'ten_quocgia' => 'Pháp', 'created_at' => $now],
                [ 'id' => '7', 'ma_quocgia' => '1', 'ten_quocgia' => 'USA', 'created_at' => $now],
                [ 'id' => '8', 'ma_quocgia' => '86', 'ten_quocgia' => 'Trung Quốc', 'created_at' => $now],
                [ 'id' => '9', 'ma_quocgia' => '637', 'ten_quocgia' => 'Brunei', 'created_at' => $now],
                [ 'id' => '10', 'ma_quocgia' => '44', 'ten_quocgia' => 'Anh', 'created_at' => $now],
                [ 'id' => '11', 'ma_quocgia' => '855', 'ten_quocgia' => 'Campuchia', 'created_at' => $now],
                [ 'id' => '12', 'ma_quocgia' => '01', 'ten_quocgia' => 'Canada', 'created_at' => $now],
                [ 'id' => '13', 'ma_quocgia' => '53', 'ten_quocgia' => 'Cuba', 'created_at' => $now],
                [ 'id' => '14', 'ma_quocgia' => '886', 'ten_quocgia' => 'Đài Loan', 'created_at' => $now],
                [ 'id' => '15', 'ma_quocgia' => '49', 'ten_quocgia' => 'Đức', 'created_at' => $now],
                [ 'id' => '16', 'ma_quocgia' => '0', 'ten_quocgia' => 'Hà Lan', 'created_at' => $now],
                [ 'id' => '17', 'ma_quocgia' => '82', 'ten_quocgia' => 'Hàn Quốc', 'created_at' => $now],
                [ 'id' => '18', 'ma_quocgia' => '999', 'ten_quocgia' => 'Khác', 'created_at' => $now],
                [ 'id' => '19', 'ma_quocgia' => '62', 'ten_quocgia' => 'Indonesia', 'created_at' => $now],
                [ 'id' => '20', 'ma_quocgia' => '856', 'ten_quocgia' => 'Lào', 'created_at' => $now],
                [ 'id' => '21', 'ma_quocgia' => '7', 'ten_quocgia' => 'Nga', 'created_at' => $now],
                [ 'id' => '22', 'ma_quocgia' => '81', 'ten_quocgia' => 'Nhật', 'created_at' => $now],
                [ 'id' => '23', 'ma_quocgia' => '63', 'ten_quocgia' => 'Philippines', 'created_at' => $now],
                [ 'id' => '24', 'ma_quocgia' => '65', 'ten_quocgia' => 'Singapore', 'created_at' => $now],
                [ 'id' => '25', 'ma_quocgia' => '66', 'ten_quocgia' => 'Thái Lan', 'created_at' => $now],
                [ 'id' => '26', 'ma_quocgia' => '91', 'ten_quocgia' => 'Ấn Độ', 'created_at' => $now],
                [ 'id' => '27', 'ma_quocgia' => '36', 'ten_quocgia' => 'Hungary', 'created_at' => $now],
                [ 'id' => '28', 'ma_quocgia' => 'BI', 'ten_quocgia' => 'Bỉ', 'created_at' => $now],
                [ 'id' => '29', 'ma_quocgia' => '39', 'ten_quocgia' => 'Ý', 'created_at' => $now],
                [ 'id' => '30', 'ma_quocgia' => '381', 'ten_quocgia' => 'Sec Bi', 'created_at' => $now],
                [ 'id' => '31', 'ma_quocgia' => 'UC', 'ten_quocgia' => 'Úc', 'created_at' => $now],
                [ 'id' => '32', 'ma_quocgia' => 'PK', 'ten_quocgia' => 'Argentina', 'created_at' => $now],
                [ 'id' => '33', 'ma_quocgia' => 'A', 'ten_quocgia' => 'Áo', 'created_at' => $now],
                [ 'id' => '34', 'ma_quocgia' => 'BL', 'ten_quocgia' => 'Ba Lan', 'created_at' => $now],
                [ 'id' => '35', 'ma_quocgia' => 'BLD', 'ten_quocgia' => 'Bangladesh', 'created_at' => $now],
                [ 'id' => '36', 'ma_quocgia' => 'CR', 'ten_quocgia' => 'Cyprus', 'created_at' => $now],
                [ 'id' => '37', 'ma_quocgia' => 'DM', 'ten_quocgia' => 'Đan Mạch', 'created_at' => $now],
                [ 'id' => '38', 'ma_quocgia' => 'M', 'ten_quocgia' => 'Monaco', 'created_at' => $now],
                [ 'id' => '39', 'ma_quocgia' => 'MY', 'ten_quocgia' => 'Mỹ', 'created_at' => $now],
                [ 'id' => '40', 'ma_quocgia' => 'NA', 'ten_quocgia' => 'Na Uy', 'created_at' => $now],
                [ 'id' => '41', 'ma_quocgia' => 'PA', 'ten_quocgia' => 'Pakistan', 'created_at' => $now],
                [ 'id' => '42', 'ma_quocgia' => 'PL', 'ten_quocgia' => 'Phần Lan', 'created_at' => $now],
                [ 'id' => '43', 'ma_quocgia' => 'SC', 'ten_quocgia' => 'Scotland', 'created_at' => $now],
                [ 'id' => '44', 'ma_quocgia' => 'TBN', 'ten_quocgia' => 'Tây Ban Nha', 'created_at' => $now],
                [ 'id' => '45', 'ma_quocgia' => 'TD', 'ten_quocgia' => 'Thụy Điển', 'created_at' => $now],
                [ 'id' => '46', 'ma_quocgia' => 'TS', 'ten_quocgia' => 'Thụy Sĩ', 'created_at' => $now],
                [ 'id' => '47', 'ma_quocgia' => 'UR', 'ten_quocgia' => 'Ukraina', 'created_at' => $now],
            ]
        );

        DB::statement('ALTER TABLE `hrm_quocgia` AUTO_INCREMENT=1;');
    }
}
