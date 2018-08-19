<?php

namespace App\Admin\Controllers\Reports;

use App\Models\StoreSoketoan;
use App\Models\StoreNguoncungcap;
use App\Models\StoreSanpham;
use App\Models\StoreSanphamNhom;
use App\Models\StoreSanphamLoai;
use App\Models\StoreNhacungcap;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
use DB;

class StoreReportBangKeNhapKhoTongHopController extends Controller
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

            $content->header('Báo cáo Bảng kê Nhập kho Tổng hợp');
            $content->description('description');

            // $parameter = [
            //     '2018-04-04',
            //     '2020-04-01',
            //     1
            // ];
            // $bag = DB::select('call usp_store_baocao_nhapxuatton_chitiet(?,?,?)', $parameter);
            // dd($bag);

            $nguonCungCap = StoreNguoncungcap::selectboxData();
            $sanPham = StoreSanpham::selectboxData();
            $nhomSanPham = StoreSanphamNhom::selectboxData(); 
            $loaiSanPham = StoreSanphamLoai::selectboxData(); 
            $nhaCungCap = StoreNhacungcap::selectboxData();
            $content->body(view('admin.reports.bangkenhapkho_tonghop.index')
                ->with(Array('nguonCungCap'=> $nguonCungCap
                            ,'sanPham' => $sanPham
                            ,'nhomSanPham' => $nhomSanPham
                            ,'loaiSanPham' => $loaiSanPham
                            ,'nhaCungCap' => $nhaCungCap
            )));
        });
    }
}
