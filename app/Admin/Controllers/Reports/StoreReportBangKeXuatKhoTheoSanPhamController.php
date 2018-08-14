<?php

namespace App\Admin\Controllers\Reports;

use App\Models\StoreSoketoan;
use App\Models\StoreNguoncungcap;
use App\Models\StoreSanpham;
use App\Models\StoreDonvi;
use App\Models\StoreSanphamNhom;
use App\Models\StoreSanphamLoai;

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

            $content->header('Báo cáo Bảng kê Xuất kho tổng hợp');
            $content->description('');

            // $parameter = [
            //     '2018-04-04',
            //     '2020-04-01',
            //     1
            // ];
            // $bag = DB::select('call usp_store_baocao_nhapxuatton_chitiet(?,?,?)', $parameter);
            // dd($bag);
            $donVi = StoreDonvi::selectboxData(); 
            $nhomSanPham = StoreSanphamNhom::selectboxData(); 
            $loaiSanPham = StoreSanphamLoai::selectboxData(); 
            $sanPham = StoreSanpham::selectboxData();
            $content->body(view('admin.reports.bangkexuatkho_theosanpham.index')
                ->with(Array('donVi'=> $donVi
                            ,'sanPham' => $sanPham
                            ,'nhomSanPham' => $nhomSanPham
                            ,'loaiSanPham' => $loaiSanPham  
                            
            )));
        });
    }
}
