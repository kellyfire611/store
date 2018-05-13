<?php

namespace App\Admin\Controllers\Reports;

use App\Models\StoreSoketoan;
use App\Models\StoreNguoncungcap;
use App\Models\StoreSanpham;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
use DB;

class StoreReportBangKeXuatKhoTheoSanPhamController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Báo cáo Bảng kê Xuất kho theo sản phẩm');
            $content->description('description');

            // $parameter = [
            //     '2018-04-04',
            //     '2020-04-01',
            //     1
            // ];
            // $bag = DB::select('call usp_store_baocao_nhapxuatton_chitiet(?,?,?)', $parameter);
            // dd($bag);

            $sanpham = StoreSanpham::selectboxData();
            $content->body(view('admin.reports.bangkexuatkho_theosanpham.index')
                ->with('sanpham', $sanpham));
        });
    }
}
