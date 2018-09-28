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
                'title' => 'Báo cáo xuất nhập tồn chi tiết',
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
        $ten_thong_so_ncc = '';
        $ten_thong_so_sanpham = '';
        $ten_thong_so_nhom = '';
        $ten_thong_so_loai = '';
        $order = ' ma_nguoncungcap,ten_nhom_sanpham,ten_loai_sanpham,ten_sanpham';
        if($p_loai_bao_cao == 'tong_hop'){
            $str_loai_bao_cao = 'Bảng kê nhập kho tổng hợp';
        } elseif ($p_loai_bao_cao == 'nguon_von') {
           $str_loai_bao_cao = 'Bảng kê nhập kho theo nguồn vốn';
//           $order = ' ten_nguoncungcap ';
        } elseif ($p_loai_bao_cao == 'san_pham') {
           $str_loai_bao_cao = 'Bảng kê nhập kho theo sản phẩm';
//           $order = ' ten_sanpham ';
        } elseif ($p_loai_bao_cao == 'nhom_loai') {
           $str_loai_bao_cao = 'Bảng kê nhập kho theo nhóm & loại sản phẩm';
//           $order = ' ten_sanpham  ';
        }  
        
                 
        
        $fields = "ncc.ma_nguoncungcap, ncc.ten_nguoncungcap
            , sp.ma_sanpham, sp.ten_sanpham, ten_nhom_sanpham, ten_loai_sanpham, 
            sp.ten_hoatchat, sp.nongdo_hamluong
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
            LEFT JOIN store_sanpham_nhom_loai_rel nlrel ON pnct.sanpham_id = nlrel.sanpham_id
            LEFT JOIN store_sanpham_nhom nhom ON nlrel.sanpham_nhom_id = nhom.id
            LEFT JOIN store_sanpham_loai loai ON nlrel.sanpham_loai_id = loai.id";
        $wheres = "pn.ngay_nhapkho BETWEEN '$p_ngay_batdau' AND '$p_ngay_ketthuc'";

        if(isset($p_nguoncungcap_id) && $p_nguoncungcap_id !='' ){
            $str_Optional .= ' AND pnct.nguoncungcap_id IN ( '.implode(',', $p_nguoncungcap_id) . ')' ;
            $id_ncc = ($p_nguoncungcap_id != 0) ? implode(',', $p_nguoncungcap_id) : 0 ;
            $data_thong_so_ncc = (DB::select("SELECT  GROUP_CONCAT(ten_nguoncungcap) ten_nguoncungcap FROM store_nguoncungcap WHERE id IN ($id_ncc)")); 
            $ten_thong_so_ncc = 'Nguồn vốn: ';
            foreach ($data_thong_so_ncc[0] as $key => $value) {
                $ten_thong_so_ncc .= $value;
            }
        }   
        if(isset($p_sanpham_id) && $p_sanpham_id !='' ){
            $str_Optional .= ' AND pnct.sanpham_id IN ( '.implode(',', $p_sanpham_id) . ')' ;
            $id_sanpham =   ($p_sanpham_id != 0) ? implode(',', $p_sanpham_id) : 0 ;  
            $ten_thong_so_sanpham = 'Sản phẩm: ';
            $data_thong_so_sanpham = (DB::select("SELECT  GROUP_CONCAT(CASE WHEN nongdo_hamluong = '' THEN ten_sanpham ELSE CONCAT(ten_sanpham,'-',nongdo_hamluong ) END) ten_sanpham "
                       . "FROM store_sanpham WHERE id IN ($id_sanpham)"));        
            foreach ($data_thong_so_sanpham[0] as $key => $value) {
                $ten_thong_so_sanpham .= $value;
            }
        }
        if(isset($p_sanpham_nhom_id) && $p_sanpham_nhom_id !=''){
            $str_Optional .= ' AND nlrel.sanpham_nhom_id IN ( '.implode(',', $p_sanpham_nhom_id) . ')' ;
            $id_nhom = ($p_sanpham_nhom_id != 0) ? implode(',', $p_sanpham_nhom_id) : 0 ;
            $ten_thong_so_nhom = 'Nhóm sản phẩm: ';
            $data_thong_so_nhom = (DB::select("SELECT  GROUP_CONCAT(ten_nhom_sanpham) ten_nhom_sanpham FROM store_sanpham_nhom WHERE id IN ($id_nhom)"));
            foreach ($data_thong_so_nhom[0] as $key => $value) {
                $ten_thong_so_nhom .= $value;
            }
        }
        if(isset($p_sanpham_loai_id) && $p_sanpham_loai_id !=''){
            $str_Optional .= ' OR nlrel.sanpham_loai_id IN ( '.implode(',', $p_sanpham_loai_id) . ')' ;
            $id_loai = ($p_sanpham_loai_id != 0) ? implode(',', $p_sanpham_loai_id) : 0 ;  
            $ten_thong_so_loai = 'Loại sản phẩm: ';
            $data_thong_so_loai = (DB::select("SELECT  GROUP_CONCAT(ten_loai_sanpham) ten_loai_sanpham FROM store_sanpham_loai WHERE id IN ($id_loai)"));  
            foreach ($data_thong_so_loai[0] as $key => $value) {
                $ten_thong_so_loai .= $value;
            }
        }
            
        $data =  DB::select("SELECT $fields
                                FROM $tables
                                WHERE $wheres $str_Optional ORDER BY $order  ") ;
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
                'ten_thong_so_ncc' => $ten_thong_so_ncc,
                'ten_thong_so_sanpham' => $ten_thong_so_sanpham,
                'ten_thong_so_loai' => $ten_thong_so_loai,
                'ten_thong_so_nhom' => $ten_thong_so_nhom,

            ],
            'data' => json_decode($result)
        ];        

//        dd($bag);   
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
//        $field_thongso = '';
//        $table_thongso = '';
//        $id_thong_so = '';
//        $ten_thong_so1 ='';
//        $ten_thong_so2 ='';
        $ten_thong_so_donvi = '';
        $ten_thong_so_sanpham = '';
        $ten_thong_so_nhom = '';
        $ten_thong_so_loai = '';
        $order = 'ten_donvi,ten_nhom_sanpham,ten_loai_sanpham,ten_sanpham';
        if($p_loai_bao_cao == 'tong_hop'){
            $str_loai_bao_cao = 'Bảng kê xuất kho tổng hợp';
        } elseif ($p_loai_bao_cao == 'don_vi') {
           $str_loai_bao_cao = 'Bảng kê nhập kho theo đơn vị';
           
           $order = ' ten_donvi ';
        } elseif ($p_loai_bao_cao == 'san_pham') {
           $str_loai_bao_cao = 'Bảng kê xuất kho theo sản phẩm';
           $id_thong_so =   ($p_sanpham_id != 0) ? implode(',', $p_sanpham_id) : 0 ;  
           $order = ' ten_sanpham ';
        } elseif ($p_loai_bao_cao == 'nhom_loai') {
           $str_loai_bao_cao = 'Bảng kê xuất kho theo nhóm & loại sản phẩm';    
        }        
        
        
        $fields = "dv.ma_donvi,
	dv.ten_donvi,
	sp.ma_sanpham,ten_nhom_sanpham, ten_loai_sanpham, 
	sp.ten_sanpham,
	sp.ten_hoatchat,
	sp.nongdo_hamluong,
	dvt.ten_donvitinh,
	date( px.ngay_xacnhan ) ngay_xacnhan,
	k.ma_kho,
        k.ten_kho,
	px.so_phieuxuat,
	date( px.ngay_xuatkho ) AS ngay_xuatkho,
	pxct.so_chungtu,
	pxct.so_lo,
	pxct.hansudung,
	pxct.dongiaxuat,
	pxct.soluongxuat";
        $tables = "store_phieuxuat_chitiet pxct
	LEFT JOIN store_phieuxuat px ON pxct.phieuxuat_id = px.id
	LEFT JOIN store_donvi dv ON pxct.xuat_den_donvi_id = dv.id
	LEFT JOIN store_sanpham sp ON pxct.sanpham_id = sp.id
	LEFT JOIN store_donvitinh dvt ON sp.donvitinh_id = dvt.id
	LEFT JOIN store_kho k ON pxct.xuat_tu_kho_id = k.id
	LEFT JOIN store_sanpham_nhom_loai_rel nlrel ON pxct.sanpham_id = nlrel.sanpham_id
        LEFT JOIN store_sanpham_nhom nhom ON nlrel.sanpham_nhom_id = nhom.id
	LEFT JOIN store_sanpham_loai loai ON nlrel.sanpham_loai_id = loai.id";
        $wheres = "px.ngay_xuatkho BETWEEN '$p_ngay_batdau' AND '$p_ngay_ketthuc'";

        if(isset($p_donvi_id) && $p_donvi_id !=0 ){            
            $id_donvi =   ($p_donvi_id != 0) ? implode(',', $p_donvi_id) : 0 ; 
            $str_Optional .= ' AND pxct.xuat_den_donvi_id IN ( '. $id_donvi . ')' ;
            $ten_thong_so_donvi = 'Đơn vị nhận: ';
            $data_thong_so_donvi = (DB::select("SELECT  GROUP_CONCAT(ten_donvi) ten_donvi "
                       . "FROM store_donvi WHERE id IN ($id_donvi)"));        
            foreach ($data_thong_so_donvi[0] as $key => $value) {
                $ten_thong_so_donvi .= $value;
            }
        }
        if(isset($p_sanpham_id) && $p_sanpham_id !=0 ){
            $str_Optional .= ' AND pxct.sanpham_id IN ( '.implode(',', $p_sanpham_id) . ')' ;
            $id_sanpham =   ($p_sanpham_id != 0) ? implode(',', $p_sanpham_id) : 0 ;  
            $ten_thong_so_sanpham = 'Sản phẩm: ';
            $data_thong_so_sanpham = (DB::select("SELECT  GROUP_CONCAT(CASE WHEN nongdo_hamluong = '' THEN ten_sanpham ELSE CONCAT(ten_sanpham,'-',nongdo_hamluong ) END) ten_sanpham "
                       . "FROM store_sanpham WHERE id IN ($id_sanpham)"));        
            foreach ($data_thong_so_sanpham[0] as $key => $value) {
                $ten_thong_so_sanpham .= $value;
            }
        }
        if(isset($p_sanpham_nhom_id) && $p_sanpham_nhom_id !=0){
            $str_Optional .= ' AND nlrel.sanpham_nhom_id IN ( '.implode(',', $p_sanpham_nhom_id) . ')' ;
            $id_nhom = ($p_sanpham_nhom_id != 0) ? implode(',', $p_sanpham_nhom_id) : 0 ;
            $ten_thong_so_nhom = 'Nhóm sản phẩm: ';
            $data_thong_so_nhom = (DB::select("SELECT  GROUP_CONCAT(ten_nhom_sanpham) ten_nhom_sanpham FROM store_sanpham_nhom WHERE id IN ($id_nhom)"));
            foreach ($data_thong_so_nhom[0] as $key => $value) {
                $ten_thong_so_nhom .= $value;
            }
        }
        if(isset($p_sanpham_loai_id) && $p_sanpham_loai_id !=0){
            $str_Optional .= ' OR nlrel.sanpham_loai_id IN ( '.implode(',', $p_sanpham_loai_id) . ')' ;
            $id_loai = ($p_sanpham_loai_id != 0) ? implode(',', $p_sanpham_loai_id) : 0 ;  
            $ten_thong_so_loai = 'Loại sản phẩm: ';
            $data_thong_so_loai = (DB::select("SELECT  GROUP_CONCAT(ten_loai_sanpham) ten_loai_sanpham FROM store_sanpham_loai WHERE id IN ($id_loai)"));  
            foreach ($data_thong_so_loai[0] as $key => $value) {
                $ten_thong_so_loai .= $value;
            }
        }
            
        $data =  DB::select("SELECT $fields
                                FROM $tables
                                WHERE $wheres $str_Optional ORDER BY $order ") ;
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
                'ten_thong_so_donvi' => $ten_thong_so_donvi,
                'ten_thong_so_sanpham' => $ten_thong_so_sanpham,
                'ten_thong_so_loai' => $ten_thong_so_loai,
                'ten_thong_so_nhom' => $ten_thong_so_nhom,

            ],
            'data' => json_decode($result)
        ];        

//         dd($bag);   
        return $bag;
    }
}
