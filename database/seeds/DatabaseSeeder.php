<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        // Xóa data
        DB::delete('delete from admin_menu');

        DB::delete('delete from hrm_quocgia');
        DB::delete('delete from hrm_tinhthanh');
        DB::delete('delete from hrm_quanhuyen');
        DB::delete('delete from hrm_xaphuong');

        DB::delete('delete from store_phieuxuat_chitiet');
        DB::delete('delete from store_phieuxuat');
        DB::delete('delete from store_phieunhap_chitiet');
        DB::delete('delete from store_phieunhap');
        DB::delete('delete from store_kho_nhapxuat_rel');
        DB::delete('delete from store_kho_loai_rel');
        DB::delete('delete from store_kho_loai');
        DB::delete('delete from store_kho');
        DB::delete('delete from store_nhapxuat_loai_rel');
        DB::delete('delete from store_nhapxuat_loai');
        DB::delete('delete from store_nhapxuat');
        DB::delete('delete from store_sanpham_nhom_loai_rel');
        DB::delete('delete from store_sanpham_loai');
        DB::delete('delete from store_sanpham_nhom');
        DB::delete('delete from store_sanpham');
        DB::delete('delete from store_donvitinh');
        DB::delete('delete from store_soketoan');
        DB::delete('delete from store_nguoncungcap');
        DB::delete('delete from store_nhacungcap');

        DB::delete('delete from users');

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->call(UsersTableSeeder::class);
        $this->call(\Encore\Admin\Auth\Database\AdminTablesSeeder::class);
        $this->call(AdminMenuTableSeeder::class);

        /* --- HRM --- */
        // Quốc gia
        $this->call(HrmQuocgiaTableSeeder::class);
        $this->call(HrmTinhthanhTableSeeder::class);
        $this->call(HrmQuanhuyenTableSeeder::class);
        $this->call(HrmXaphuongTableSeeder::class);
        /* ./. --- HRM --- */

        /* --- Store --- */
        // Sổ kế toán
        $this->call(StoreSoketoanTableSeeder::class);

        // Nguồn cung cấp
        $this->call(StoreNguoncungcapTableSeeder::class);
        $this->call(StoreNhacungcapTableSeeder::class);

        // Loại kho
        $this->call(StoreKhoLoaiTableSeeder::class);
        $this->call(StoreKhoTableSeeder::class);
        $this->call(StoreKhoLoaiRelTableSeeder::class);

        // Loại Nhập xuất
        $this->call(StoreNhapxuatTableSeeder::class);
        $this->call(StoreNhapxuatLoaiTableSeeder::class);
        $this->call(StoreNhapxuatLoaiRelTableSeeder::class);

        // Cấu hình kho


        // Sản phẩm
        $this->call(StoreSanphamLoaiTableSeeder::class);
        $this->call(StoreSanphamNhomTableSeeder::class);
        $this->call(StoreSanphamTableSeeder::class);
        $this->call(StoreSanphamNhomLoaiRelTableSeeder::class);

        // Đơn vị tính
        $this->call(StoreDonvitinhTableSeeder::class);

        // Phiếu nhập, xuất
        $this->call(StorePhieunhapTableSeeder::class);
        $this->call(StorePhieunhapChitietTableSeeder::class);
        $this->call(StorePhieuxuatTableSeeder::class);
        $this->call(StorePhieuxuatChitietTableSeeder::class);
        /* ./. --- Store --- */
    }
}
