<?php

use Illuminate\Database\Seeder;

class StoreNhapxuatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon\Carbon::now();
        DB::table('store_nhapxuat')->insert(
            [
                [ 'id' => '2', 'ma_nhapxuat' => 'NHT', 'ten_nhapxuat' => 'Nhập trả vào kho chẵn', 'created_at' => $now],
                [ 'id' => '5', 'ma_nhapxuat' => 'XTNCC', 'ten_nhapxuat' => 'Xuất trả nhà cung cấp', 'created_at' => $now],
                [ 'id' => '7', 'ma_nhapxuat' => 'XPTCBN', 'ten_nhapxuat' => 'Xuất phát thuốc cho bệnh nhân', 'created_at' => $now],
                [ 'id' => '8', 'ma_nhapxuat' => 'XHTT', 'ten_nhapxuat' => 'Xuất hoàn tủ trực', 'created_at' => $now],
                [ 'id' => '9', 'ma_nhapxuat' => 'XKL', 'ten_nhapxuat' => 'Xuât qua kho lẻ', 'created_at' => $now],
                [ 'id' => '13', 'ma_nhapxuat' => 'NMTNCC', 'ten_nhapxuat' => 'Nhập từ nhà cung cấp', 'created_at' => $now],
                [ 'id' => '14', 'ma_nhapxuat' => 'NMTNGCC', 'ten_nhapxuat' => 'Nhập từ nguồn cung cấp', 'created_at' => $now],
                [ 'id' => '16', 'ma_nhapxuat' => 'NMK', 'ten_nhapxuat' => 'Nhập khác từ bên ngoài', 'created_at' => $now],
                [ 'id' => '17', 'ma_nhapxuat' => 'NMTNB', 'ten_nhapxuat' => 'Nhập khác nội bộ', 'created_at' => $now],
                [ 'id' => '22', 'ma_nhapxuat' => 'XNB', 'ten_nhapxuat' => 'Xuất nội bộ giữa các kho', 'created_at' => $now],
                [ 'id' => '26', 'ma_nhapxuat' => 'XVT', 'ten_nhapxuat' => 'Xuất viện trợ', 'created_at' => $now],
                [ 'id' => '27', 'ma_nhapxuat' => 'XHB', 'ten_nhapxuat' => 'Xuất hư bể, hỏng mất, thanh lý', 'created_at' => $now],
                [ 'id' => '28', 'ma_nhapxuat' => 'XNV', 'ten_nhapxuat' => 'Xuất ngoại viện', 'created_at' => $now],
                [ 'id' => '29', 'ma_nhapxuat' => 'NKL', 'ten_nhapxuat' => 'Nhập vào kho lẻ', 'created_at' => $now],
                [ 'id' => '30', 'ma_nhapxuat' => 'NTK', 'ten_nhapxuat' => 'Nhập tồn kho', 'created_at' => $now],
                [ 'id' => '31', 'ma_nhapxuat' => 'XHT', 'ten_nhapxuat' => 'Xuất trả kho chẵn', 'created_at' => $now],
                [ 'id' => '32', 'ma_nhapxuat' => 'XBSTT', 'ten_nhapxuat' => 'Xuất bổ sung tủ trực', 'created_at' => $now],
                [ 'id' => '33', 'ma_nhapxuat' => 'NBSTT', 'ten_nhapxuat' => 'Nhập bổ sung tủ trực', 'created_at' => $now],
                [ 'id' => '34', 'ma_nhapxuat' => 'XKP', 'ten_nhapxuat' => 'Xuất cho khoa phòng', 'created_at' => $now],
                [ 'id' => '35', 'ma_nhapxuat' => 'NHTKP', 'ten_nhapxuat' => 'Nhập hoàn trả từ khoa phòng', 'created_at' => $now],
                [ 'id' => '36', 'ma_nhapxuat' => 'NKP', 'ten_nhapxuat' => 'Nhập vào khoa phòng', 'created_at' => $now],
                [ 'id' => '37', 'ma_nhapxuat' => 'XKDT', 'ten_nhapxuat' => 'Xuất kê đơn thuốc cho bệnh nhân', 'created_at' => $now],
                [ 'id' => '38', 'ma_nhapxuat' => 'NKDT', 'ten_nhapxuat' => 'Nhập từ kê đơn thuốc cho bệnh nhân', 'created_at' => $now],
                [ 'id' => '39', 'ma_nhapxuat' => 'NHTTT', 'ten_nhapxuat' => 'Nhập hoàn tủ trực', 'created_at' => $now],
                [ 'id' => '40', 'ma_nhapxuat' => 'XBN', 'ten_nhapxuat' => 'Xuất cho bệnh nhân', 'created_at' => $now],
                [ 'id' => '41', 'ma_nhapxuat' => 'XGCSTT', 'ten_nhapxuat' => 'Xuất giảm cơ số tủ trực', 'created_at' => $now],
                [ 'id' => '42', 'ma_nhapxuat' => 'NGCSTT', 'ten_nhapxuat' => 'Nhập giảm cơ số tủ trực', 'created_at' => $now],
                [ 'id' => '45', 'ma_nhapxuat' => 'NTKDK', 'ten_nhapxuat' => 'Nhập tồn kho đầu kỳ', 'created_at' => $now],
                [ 'id' => '46', 'ma_nhapxuat' => 'NNV', 'ten_nhapxuat' => 'Nhập ngoại viện', 'created_at' => $now],
                [ 'id' => '48', 'ma_nhapxuat' => 'XTBK', 'ten_nhapxuat' => 'Xuất thuốc theo bảng kê', 'created_at' => $now],
                [ 'id' => '50', 'ma_nhapxuat' => 'NHTBN', 'ten_nhapxuat' => 'Nhập hoàn trả từ bệnh nhân', 'created_at' => $now],
                [ 'id' => '51', 'ma_nhapxuat' => 'XKDTTP', 'ten_nhapxuat' => 'Xuất kê đơn thuốc cho bệnh nhân thu phí', 'created_at' => $now],
                [ 'id' => '52', 'ma_nhapxuat' => 'XTLT', 'ten_nhapxuat' => 'Xuất thuốc làm tròn', 'created_at' => $now],
                [ 'id' => '53', 'ma_nhapxuat' => 'NTLT', 'ten_nhapxuat' => 'Nhập thuốc làm tròn', 'created_at' => $now],
                [ 'id' => '54', 'ma_nhapxuat' => 'XKLGBCL', 'ten_nhapxuat' => 'Xuất kho lẻ giá bán có lời', 'created_at' => $now],
                [ 'id' => '55', 'ma_nhapxuat' => 'NKLGBCL', 'ten_nhapxuat' => 'Nhập kho lẻ giá bán có lời', 'created_at' => $now],
                [ 'id' => '56', 'ma_nhapxuat' => 'NDHM', 'ten_nhapxuat' => 'Nhập đợt hiến máu', 'created_at' => $now],
                [ 'id' => '57', 'ma_nhapxuat' => 'XKM', 'ten_nhapxuat' => 'Xuất kho máu', 'created_at' => $now],
            ]
        );

        DB::statement('ALTER TABLE `store_nhapxuat` AUTO_INCREMENT=1;');
    }
}
