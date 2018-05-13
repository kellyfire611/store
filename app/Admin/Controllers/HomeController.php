<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Auth\Database\Administrator;
use App\Models\StorePhieunhap;
use App\Models\StorePhieuxuat;
use App\Models\StoreSanpham;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Bảng điều khiển');
            $content->description('Tóm tắt tình hình Kho dược trong Hệ thống...');

            $content->row(function ($row) {
                $row->column(3, new InfoBox('Tổng số người dùng', 'playlist_add_check', 'blue', '/admin/auth/users', Administrator::count()));
                $row->column(3, new InfoBox('Tổng số Phiếu Nhập', 'playlist_add_check', 'green', '/admin/store/phieunhap_tondauky', StorePhieunhap::count()));
                $row->column(3, new InfoBox('Tổng số Phiếu Xuất', 'playlist_add_check', 'yellow', '/admin/store/phieunhap_tondauky', StorePhieuxuat::count()));
                $row->column(3, new InfoBox('Tổng số Sản phẩm', 'playlist_add_check', 'red', '/admin/store/sanpham', StoreSanpham::count()));
            });

            $content->body(view('admin.dashboard'));
        });
    }
}
