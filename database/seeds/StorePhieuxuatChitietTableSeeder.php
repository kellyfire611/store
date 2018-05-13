<?php

use Illuminate\Database\Seeder;

class StorePhieuxuatChitietTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon\Carbon::now();

        // Get chi tiết nhập
        $chitietPhieunhap = DB::table('store_phieunhap_chitiet')->where('id', '=', 1)->get()->first();

        // Xuất Nội bộ
        DB::table('store_phieuxuat_chitiet')->insert(
            [
                [ 'id' => '1', 'ngay_sudungdautien' => $now, 'dongiaxuat' => $chitietPhieunhap->dongianhap, 'soluongxuat' => 15, 'thue' => 0, 'hansudung' => $chitietPhieunhap->hansudung, 'so_lo' => $chitietPhieunhap->so_lo, 'so_chungtu' => $chitietPhieunhap->so_chungtu, 'cotinhphi' => 1, 'nhapxuat_id' => 9, 'phieuxuat_id' => 1, 'soketoan_id' => 1, 'xuat_tu_kho_id' => 1, 'sanpham_id' => 1, 'donvitinh_id' => 27, 'phieunhap_chitiet_id' => $chitietPhieunhap->id, 'created_at' => $now],
            ]
        );

        // Tạo phiếu nhập Nội bộ tương ứng
        DB::table('store_phieunhap_chitiet')->insert(
            [
                [ 'id' => '2', 'ngay_sudungdautien' => $now, 'dongianhap' => $chitietPhieunhap->dongianhap, 'soluongnhap' => 15, 'soluong_conlai' => 15, 'thue' => 0, 'hansudung' => $chitietPhieunhap->hansudung, 'so_lo' => $chitietPhieunhap->so_lo, 'so_chungtu' => $chitietPhieunhap->so_chungtu, 'nhapxuat_id' => 29, 'phieunhap_id' => 2, 'soketoan_id' => 1, 'nhap_vao_kho_id' => 2, 'sanpham_id' => 1, 'donvitinh_id' => 27, 'created_at' => $now],
            ]
        );

        // Giảm số lượng còn lại
        DB::table('store_phieunhap_chitiet')
            ->where('id', 1)
            ->decrement('soluong_conlai', 15);

        DB::statement('ALTER TABLE `store_phieuxuat` AUTO_INCREMENT=1;');
    }
}
