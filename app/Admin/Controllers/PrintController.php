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

}
