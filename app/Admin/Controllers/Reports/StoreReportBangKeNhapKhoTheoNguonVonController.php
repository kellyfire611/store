<?php

namespace App\Admin\Controllers\Reports;

use App\Models\StoreSoketoan;
use App\Models\StoreNguoncungcap;
use App\Models\StoreSanphamNhom;
use App\Models\StoreSanphamLoai;
use App\Models\StoreNhaCungCap;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
use DB;

class StoreReportBangKeNhapKhoTheoNguonVonController extends Controller
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

            $content->header('Báo cáo Bảng kê Nhập kho theo nguồn vốn');
            $content->description('description');

            // $parameter = [
            //     '2018-04-04',
            //     '2020-04-01',
            //     1
            // ];
            // $bag = DB::select('call usp_store_baocao_nhapxuatton_chitiet(?,?,?)', $parameter);
            // dd($bag);

            $nguonCungCap = StoreNguoncungcap::selectboxData();
            $nhomSanPham = StoreSanphamNhom::selectboxData(); 
            $loaiSanPham = StoreSanphamLoai::selectboxData(); 
            $nhaCungCap = StoreNhaCungCap::selectboxData(); 
            $content->body(view('admin.reports.bangkenhapkho_theonguonvon.index')
                ->with(Array('nguonCungCap'=> $nguonCungCap
                            ,'nhomSanPham' => $nhomSanPham
                            ,'loaiSanPham' => $loaiSanPham
                            ,'nhaCungCap' => $nhaCungCap
            )));
        });
    }
}
