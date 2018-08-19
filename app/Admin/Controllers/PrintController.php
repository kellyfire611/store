<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
use App\Admin\Controllers\V1\ApiDataController;
use DB;

class PrintController extends Controller
{
    use ApiDataController;

    public function printWithView(Request $request, $view)
    {
        $q = $request->all();
        unset($q['_token']);
        //dd($q);

        $bag = $this->getData($view, $q);
        // dd($bag);
        return view('admin.print.' . $view)->with('bag', $bag);
    }

    protected function getData($view, $query)
    {
        $method = 'getData'.ucfirst($view);
        if (!method_exists($this, $method)) {
            return [];
        }
        return call_user_func([$this, $method], $query);
    }

    protected function getDataBieumau_phieunhap($query)
    {
        $meta = [
            'title' => 'Phiếu nhập',
        ];
        $result = $this->phieunhapById($query['phieunhap_id']);

        $bag = [
            'meta' => $meta,
            'data' => json_decode($result)
        ];

        //dd($bag);
        return $bag;
    }

    protected function getDataBieumau_phieuxuat($query)
    {
        $result = $this->phieuxuatById($query['phieuxuat_id']);

        // dd($result);
        $bag = [
            'meta' => [
                'title' => 'Phiếu xuất',
            ],
            'data' => json_decode($result)
        ];

        return $bag;
    }

    protected function getDataBieumau_report_bangkenhapkho_theonguonvon($query)
    {   
        $totalResult = 1;
        $totalPages = 1;
        $currentPage = 1;
        $chitiet = null;
        $str_Optional = '';
         //dd($query);
        $p_ngay_batdau = $query['p_ngay_batdau'];
        $p_ngay_ketthuc = $query['p_ngay_ketthuc'];
        $p_nguoncungcap_id = $query['p_nguoncungcap_id'] ?? 0;
        $p_sanpham_id = $query['p_sanpham_id'] ?? 0;
        $p_sanpham_nhom_id = $query['p_sanpham_nhom_id'] ?? 0;
        $p_sanpham_loai_id = $query['p_sanpham_loai_id'] ?? 0;        
        $parameter = [
            $p_ngay_batdau,
            $p_ngay_ketthuc,
            $p_nguoncungcap_id,
            $p_sanpham_id,
            $p_sanpham_nhom_id,
            $p_sanpham_loai_id
        ];
        // dd($parameter);
        //$data = DB::select('call usp_store_baocao_bangkenhapkho_tonghop(?,?,?,?,?,?)', $parameter);
        //$data = DB::select();
        $fields = "ncc.ma_nguoncungcap, ncc.ten_nguoncungcap
            , sp.ma_sanpham, sp.ten_sanpham, sp.ten_hoatchat, sp.nongdo_hamluong
            , dvt.ten_donvitinh
            , pn.ngay_laphoadon
            , k.ten_kho
            , pnct.so_chungtu, pnct.so_lo, pnct.hansudung, pnct.dongianhap, pnct.soluongnhap";
        $tables = "store_phieunhap_chitiet pnct
            LEFT JOIN store_phieunhap pn ON pnct.phieunhap_id = pn.id
            LEFT JOIN store_nguoncungcap ncc ON pnct.nguoncungcap_id = ncc.id
            LEFT JOIN store_sanpham sp ON pnct.sanpham_id = sp.id
            LEFT JOIN store_donvitinh dvt ON sp.donvitinh_id = dvt.id
            LEFT JOIN store_kho k ON pnct.nhap_vao_kho_id = k.id
            LEFT JOIN store_sanpham_nhom_loai_rel nlrel ON pnct.sanpham_id = nlrel.sanpham_id";
        $wheres = "pn.ngay_nhapkho BETWEEN '$p_ngay_batdau' AND '$p_ngay_ketthuc'";

        if(isset($p_nguoncungcap_id) && $p_nguoncungcap_id !='' ){
            $str_Optional .= ' AND pnct.nguoncungcap_id IN ( '.implode(',', $p_nguoncungcap_id) . ')' ;
        }   
        if(isset($p_sanpham_id) && $p_sanpham_id !='' ){
            $str_Optional .= ' AND pnct.sanpham_id IN ( '.implode(',', $p_sanpham_id) . ')' ;
        }
        if(isset($p_sanpham_nhom_id) && $p_sanpham_nhom_id !=''){
            $str_Optional .= ' AND nlrel.sanpham_nhom_id IN ( '.implode(',', $p_sanpham_nhom_id) . ')' ;
        }
        if(isset($p_sanpham_loai_id) && $p_sanpham_loai_id !=''){
            $str_Optional .= ' AND nlrel.sanpham_loai_id IN ( '.implode(',', $p_sanpham_loai_id) . ')' ;
        }
            
        $data =  DB::select("SELECT $fields
                                FROM $tables
                                WHERE $wheres $str_Optional  ") ;
        $chitiet = $data;

        $result = json_encode(
            array('totalResult' => $totalResult, 
                'totalPages' => $totalPages, 
                'currentPage' => $currentPage, 
                'result' => $data,
                'detail' => $chitiet));

        $bag = [
            'meta' => [
                'title' => 'Bảng kê nhập kho tổng hợp',
                'p_ngay_batdau' => $p_ngay_batdau,
                'p_ngay_ketthuc' => $p_ngay_ketthuc,
                'p_nguoncungcap_id' => $p_nguoncungcap_id,
                'p_sanpham_id' => $p_sanpham_id,
            ],
            'data' => json_decode($result)
        ];

        // dd($bag);   
        return $bag;
    }

    protected function getDataBieumau_report_bangkexuatkho_theosanpham($query)
    {
        $totalResult = 1;
        $totalPages = 1;
        $currentPage = 1;
        $chitiet = null;
        // dd($query);
        $p_ngay_batdau = $query['p_ngay_batdau'];
        $p_ngay_ketthuc = $query['p_ngay_ketthuc'];
        $p_sanpham_id = $query['p_sanpham_id'];

        $parameter = [
            $p_ngay_batdau,
            $p_ngay_ketthuc,
            $p_sanpham_id
        ];
        $data = DB::select('call usp_store_baocao_bangkexuatkho_theosanpham(?,?,?)', $parameter);
        $chitiet = $data;

        $result = json_encode(
            array('totalResult' => $totalResult, 
                'totalPages' => $totalPages, 
                'currentPage' => $currentPage, 
                'result' => $data,
                'detail' => $chitiet));

        $bag = [
            'meta' => [
                'title' => 'Bảng kê xuất kho theo sản phẩm',
                'p_ngay_batdau' => $p_ngay_batdau,
                'p_ngay_ketthuc' => $p_ngay_ketthuc,
                'p_sanpham_id' => $p_sanpham_id
            ],
            'data' => json_decode($result)
        ];

        // dd($bag);   
        return $bag;
    }

    protected function getDataBieumau_report_nhapxuatton_chitiet($query)
    {
        $totalResult = 1;
        $totalPages = 1;
        $currentPage = 1;
        $chitiet = null;
        // dd($query);
        $p_ngay_batdau = $query['p_ngay_batdau'];
        $p_ngay_ketthuc = $query['p_ngay_ketthuc'];
        $p_kho_id = $query['p_kho_id'];

        $parameter = [
            $p_ngay_batdau,
            $p_ngay_ketthuc,
            $p_kho_id
        ];
        $data = DB::select('call usp_store_baocao_nhapxuatton_chitiet(?,?,?)', $parameter);
        $chitiet = $data;

        $result = json_encode(
            array('totalResult' => $totalResult, 
                'totalPages' => $totalPages, 
                'currentPage' => $currentPage, 
                'result' => $data,
                'detail' => $chitiet));

        $bag = [
            'meta' => [
                'title' => 'Nhập xuất tồn chi tiết',
                'p_ngay_batdau' => $p_ngay_batdau,
                'p_ngay_ketthuc' => $p_ngay_ketthuc,
                'p_kho_id' => $p_kho_id
            ],
            'data' => json_decode($result)
        ];

        // dd($bag);   
        return $bag;
    }

    protected function getDataBieumau_report_bangkenhapkho_tonghop($query)
    {   
        $totalResult = 1;
        $totalPages = 1;
        $currentPage = 1;
        $chitiet = null;
        $str_Optional = '';
         //dd($query);
        $p_ngay_batdau = $query['p_ngay_batdau'];
        $p_ngay_ketthuc = $query['p_ngay_ketthuc'];
        $p_nguoncungcap_id = $query['p_nguoncungcap_id'] ?? 0;
        $p_sanpham_id = $query['p_sanpham_id'] ?? 0;
        $p_sanpham_nhom_id = $query['p_nhomsanpham_id'] ?? 0;
        $p_sanpham_loai_id = $query['p_loaisanpham_id'] ?? 0;
        $p_loai_bao_cao = $query['loai_bao_cao_ten'] ?? '';
        $str_loai_bao_cao = '';
        $str_bien = '';
        $field_thongso = '';
        $table_thongso = '';
        $id_thong_so = '';
        $ten_thong_so1 ='';
        $ten_thong_so2 ='';
        if($p_loai_bao_cao == 'tong_hop'){
            $str_loai_bao_cao = 'Bảng kê nhập kho tổng hợp';
        } elseif ($p_loai_bao_cao == 'nguon_von') {
           $str_loai_bao_cao = 'Bảng kê nhập kho theo nguồn vốn';
           $id_thong_so = implode(',', $p_nguoncungcap_id);  
           $field_thongso = 'ten_nguoncungcap';
           $table_thongso = 'store_nguoncungcap';
           $ten_thong_so1 = 'Nguồn vốn: ';
        } elseif ($p_loai_bao_cao == 'san_pham') {
           $str_loai_bao_cao = 'Bảng kê nhập kho theo sản phẩm';
           $id_thong_so = implode(',', $p_sanpham_id);  
           $field_thongso = 'CASE WHEN nongdo_hamluong = "" THEN ten_sanpham ELSE CONCAT(ten_sanpham,"-",nongdo_hamluong ) END';
           $table_thongso = 'store_sanpham';
           $ten_thong_so1 = 'Sản phẩm: ';
        } elseif ($p_loai_bao_cao == 'nhom_loai') {
           $str_loai_bao_cao = 'Bảng kê nhập kho theo nhóm & loại sản phẩm';
           $id_thong_so = implode(',', $p_sanpham_loai_id);
           $id_thong_so2 = implode(',', $p_sanpham_nhom_id);
           $field_thongso = 'ten_nhom_sanpham';
           $table_thongso = 'store_sanpham_nhom';
           $ten_thong_so1 = 'Nhóm sản phẩm: ';
           
           $ten_thong_so2 = 'Loại sản phẩm: ';
           $data_thong_so2 = (DB::select("SELECT GROUP_CONCAT(ten_loai_sanpham) thong_so2 FROM store_sanpham_loai WHERE id IN ($id_thong_so2)")) ;
           foreach ($data_thong_so2[0] as $key => $value) {
                $ten_thong_so2 .= $value;
           } 
        }
        
        if ($p_loai_bao_cao != 'tong_hop') {
            $data_thong_so1 = (DB::select("SELECT GROUP_CONCAT($field_thongso) thong_so FROM $table_thongso WHERE id IN ($id_thong_so)"));
            foreach ($data_thong_so1[0] as $key => $value) {
                $ten_thong_so1 .= $value;
            }      
        }
        
        $fields = "ncc.ma_nguoncungcap, ncc.ten_nguoncungcap
            , sp.ma_sanpham, sp.ten_sanpham, sp.ten_hoatchat, sp.nongdo_hamluong
            , dvt.ten_donvitinh
            , date(pn.ngay_laphoadon) ngay_laphoadon
            , k.ma_kho
            , pn.so_phieunhap, date(pn.ngay_nhapkho) as ngay_nhapkho
            , pnct.so_chungtu, pnct.so_lo, pnct.hansudung, pnct.dongianhap, pnct.soluongnhap";
        $tables = "store_phieunhap_chitiet pnct
            LEFT JOIN store_phieunhap pn ON pnct.phieunhap_id = pn.id
            LEFT JOIN store_nguoncungcap ncc ON pnct.nguoncungcap_id = ncc.id
            LEFT JOIN store_sanpham sp ON pnct.sanpham_id = sp.id
            LEFT JOIN store_donvitinh dvt ON sp.donvitinh_id = dvt.id
            LEFT JOIN store_kho k ON pnct.nhap_vao_kho_id = k.id
            LEFT JOIN store_sanpham_nhom_loai_rel nlrel ON pnct.sanpham_id = nlrel.sanpham_id";
        $wheres = "pn.ngay_nhapkho BETWEEN '$p_ngay_batdau' AND '$p_ngay_ketthuc'";

        if(isset($p_nguoncungcap_id) && $p_nguoncungcap_id !='' ){
            $str_Optional .= ' AND pnct.nguoncungcap_id IN ( '.implode(',', $p_nguoncungcap_id) . ')' ;
        }   
        if(isset($p_sanpham_id) && $p_sanpham_id !='' ){
            $str_Optional .= ' AND pnct.sanpham_id IN ( '.implode(',', $p_sanpham_id) . ')' ;
        }
        if(isset($p_sanpham_nhom_id) && $p_sanpham_nhom_id !=''){
            $str_Optional .= ' AND nlrel.sanpham_nhom_id IN ( '.implode(',', $p_sanpham_nhom_id) . ')' ;
        }
        if(isset($p_sanpham_loai_id) && $p_sanpham_loai_id !=''){
            $str_Optional .= ' OR nlrel.sanpham_loai_id IN ( '.implode(',', $p_sanpham_loai_id) . ')' ;
        }
            
        $data =  DB::select("SELECT $fields
                                FROM $tables
                                WHERE $wheres $str_Optional  ") ;
        $chitiet = $data;

        $result = json_encode(
            array('totalResult' => $totalResult, 
                'totalPages' => $totalPages, 
                'currentPage' => $currentPage, 
                'result' => $data,
                'detail' => $chitiet));        
        $bag = [
            'meta' => [
                'title' => $str_loai_bao_cao,
                'p_ngay_batdau' => $p_ngay_batdau,
                'p_ngay_ketthuc' => $p_ngay_ketthuc,
                'ten_thong_so1' => $ten_thong_so1,
                'ten_thong_so2' => $ten_thong_so2,

            ],
            'data' => json_decode($result)
        ];        

        // dd($bag);   
        return $bag;
    }
    
    protected function getDataBieumau_report_bangkexuatkho_tonghop($query)
    {   
        $totalResult = 1;
        $totalPages = 1;
        $currentPage = 1;
        $chitiet = null;
        $str_Optional = '';
         //dd($query);
        $p_ngay_batdau = $query['p_ngay_batdau'];
        $p_ngay_ketthuc = $query['p_ngay_ketthuc'];
        $p_donvi_id = $query['p_donvi_id'] ?? 0;
        $p_sanpham_id = $query['p_sanpham_id'] ?? 0;
        $p_sanpham_nhom_id = $query['p_nhomsanpham_id'] ?? 0;
        $p_sanpham_loai_id = $query['p_loaisanpham_id'] ?? 0;
        $p_loai_bao_cao = $query['loai_bao_cao_ten'] ?? '';
        $str_loai_bao_cao = '';
        $str_bien = '';
        $field_thongso = '';
        $table_thongso = '';
        $id_thong_so = '';
        $ten_thong_so1 ='';
        $ten_thong_so2 ='';
        if($p_loai_bao_cao == 'tong_hop'){
            $str_loai_bao_cao = 'Bảng kê nhập kho tổng hợp';
        } elseif ($p_loai_bao_cao == 'don_vi') {
           $str_loai_bao_cao = 'Bảng kê nhập kho theo đơn vị';
           $id_thong_so = implode(',', $p_donvi_id);  
           $field_thongso = 'ten_donvi';
           $table_thongso = 'store_donvi';
           $ten_thong_so1 = 'Đơn vị: ';
        } elseif ($p_loai_bao_cao == 'san_pham') {
           $str_loai_bao_cao = 'Bảng kê nhập kho theo sản phẩm';
           $id_thong_so = implode(',', $p_sanpham_id);  
           $field_thongso = 'CASE WHEN nongdo_hamluong = "" THEN ten_sanpham ELSE CONCAT(ten_sanpham,"-",nongdo_hamluong ) END';
           $table_thongso = 'store_sanpham';
           $ten_thong_so1 = 'Sản phẩm: ';
        } elseif ($p_loai_bao_cao == 'nhom_loai') {
           $str_loai_bao_cao = 'Bảng kê nhập kho theo nhóm & loại sản phẩm';
           $id_thong_so = implode(',', $p_sanpham_loai_id);
           $id_thong_so2 = implode(',', $p_sanpham_nhom_id);
           $field_thongso = 'ten_nhom_sanpham';
           $table_thongso = 'store_sanpham_nhom';
           $ten_thong_so1 = 'Nhóm sản phẩm: ';
           
           $ten_thong_so2 = 'Loại sản phẩm: ';
           $data_thong_so2 = (DB::select("SELECT GROUP_CONCAT(ten_loai_sanpham) thong_so2 FROM store_sanpham_loai WHERE id IN ($id_thong_so2)")) ;
           foreach ($data_thong_so2[0] as $key => $value) {
                $ten_thong_so2 .= $value;
           } 
        }
        
        if ($p_loai_bao_cao != 'tong_hop') {
            $data_thong_so1 = (DB::select("SELECT GROUP_CONCAT($field_thongso) thong_so FROM $table_thongso WHERE id IN ($id_thong_so)"));
            foreach ($data_thong_so1[0] as $key => $value) {
                $ten_thong_so1 .= $value;
            }      
        }
        
        $fields = "ncc.ma_nguoncungcap, ncc.ten_nguoncungcap
            , sp.ma_sanpham, sp.ten_sanpham, sp.ten_hoatchat, sp.nongdo_hamluong
            , dvt.ten_donvitinh
            , date(pn.ngay_laphoadon) ngay_laphoadon
            , k.ten_kho
            , pnct.so_chungtu, pnct.so_lo, pnct.hansudung, pnct.dongianhap, pnct.soluongnhap";
        $tables = "store_phieuxuat_chitiet pxct
            LEFT JOIN store_phieuxuat px ON pxct.phieuxuat_id = px.id
            LEFT JOIN store_phieunhap_chitiet pnct on pxct.phieunhap_chitiet_id = pnct.id
            LEFT JOIN store_phieunhap pn ON pnct.phieunhap_id = pn.id
            LEFT JOIN store_nguoncungcap ncc ON pnct.nguoncungcap_id = ncc.id
            LEFT JOIN store_sanpham sp ON pnct.sanpham_id = sp.id
            LEFT JOIN store_donvitinh dvt ON sp.donvitinh_id = dvt.id
            join store_kho k ON pxct.xuat_tu_kho_id = k.id
            LEFT JOIN store_sanpham_nhom_loai_rel nlrel ON pnct.sanpham_id = nlrel.sanpham_id";
        $wheres = "pn.ngay_nhapkho BETWEEN '$p_ngay_batdau' AND '$p_ngay_ketthuc'";

        if(isset($p_nguoncungcap_id) && $p_nguoncungcap_id !='' ){
            $str_Optional .= ' AND pnct.nguoncungcap_id IN ( '.implode(',', $p_nguoncungcap_id) . ')' ;
        }   
        if(isset($p_sanpham_id) && $p_sanpham_id !='' ){
            $str_Optional .= ' AND pnct.sanpham_id IN ( '.implode(',', $p_sanpham_id) . ')' ;
        }
        if(isset($p_sanpham_nhom_id) && $p_sanpham_nhom_id !=''){
            $str_Optional .= ' AND nlrel.sanpham_nhom_id IN ( '.implode(',', $p_sanpham_nhom_id) . ')' ;
        }
        if(isset($p_sanpham_loai_id) && $p_sanpham_loai_id !=''){
            $str_Optional .= ' OR nlrel.sanpham_loai_id IN ( '.implode(',', $p_sanpham_loai_id) . ')' ;
        }
            
        $data =  DB::select("SELECT $fields
                                FROM $tables
                                WHERE $wheres $str_Optional  ") ;
        $chitiet = $data;

        $result = json_encode(
            array('totalResult' => $totalResult, 
                'totalPages' => $totalPages, 
                'currentPage' => $currentPage, 
                'result' => $data,
                'detail' => $chitiet));        
        $bag = [
            'meta' => [
                'title' => $str_loai_bao_cao,
                'p_ngay_batdau' => $p_ngay_batdau,
                'p_ngay_ketthuc' => $p_ngay_ketthuc,
                'ten_thong_so1' => $ten_thong_so1,
                'ten_thong_so2' => $ten_thong_so2,

            ],
            'data' => json_decode($result)
        ];        

        // dd($bag);   
        return $bag;
    }
}
