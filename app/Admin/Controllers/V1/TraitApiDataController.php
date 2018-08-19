<?php

namespace App\Admin\Controllers\V1;
use App\Models\StorePhieunhap;
use App\Models\StorePhieuxuat;
use DB;
use Carbon\Carbon;

trait ApiDataController {

    public function phieunhapById($id)
    {
        $totalResult = 1;
        $totalPages = 1;
        $currentPage = 1;
        //$data = StorePhieunhap::all();
        $data = DB::select("select pn.*, k.ten_kho, ncc.ten_nhacungcap
                    from store_phieunhap pn
                        left join store_nhacungcap ncc on pn.nhacungcap_id = ncc.id
                        join store_kho k on pn.nhap_vao_kho_id = k.id
                    where pn.id = $id");
        $chitiet = DB::select("select *
                            from store_phieunhap_chitiet pnct
                                join store_sanpham sp on pnct.sanpham_id = sp.id
                                join store_donvitinh dvt on pnct.donvitinh_id = dvt.id
                                left join store_sanpham_nhom_loai_rel spnlr on pnct.sanpham_id = spnlr.sanpham_id
                                left join store_sanpham_nhom spn on spnlr.sanpham_nhom_id = spn.id
                                left join store_nguoncungcap ncc on pnct.nguoncungcap_id = ncc.id
                            where pnct.phieunhap_id = $id");

        // return response()->json(
        //     array('totalResult' => $totalResult, 
        //         'totalPages' => $totalPages, 
        //         'currentPage' => $currentPage, 
        //         'result' => $data)
        //     , 200);

        return json_encode(
            array('totalResult' => $totalResult, 
                'totalPages' => $totalPages, 
                'currentPage' => $currentPage, 
                'result' => $data,
                'detail' => $chitiet));
    }
    
    public function phieuxuatById($id)
    {
        $totalResult = 1;
        $totalPages = 1;
        $currentPage = 1;
        $data = DB::select("select px.*, dv.*
                            from store_phieuxuat px
                                left join store_kho kxt on px.xuat_tu_kho_id = kxt.id
                                left join store_kho kxd on px.xuat_den_kho_id = kxd.id
                                left join store_donvi dv on px.donvi_id = dv.id
                            where px.id = $id");
        $chitiet = DB::select("select *, pnct.hansudung HanSD, pnct.so_lo SOLO, spn.ten_nhom_sanpham, spn.ma_nhom_sanpham,
                                pnct.nongdohamluong
                                , ncc.ma_nguoncungcap
                            from store_phieuxuat_chitiet pxct
                                left join store_sanpham sp on pxct.sanpham_id = sp.id
                                
                                left join store_phieunhap_chitiet pnct on pxct.phieunhap_chitiet_id = pnct.id
                                left join store_nguoncungcap ncc on pnct.nguoncungcap_id = ncc.id
                                left join store_donvitinh dvt on pnct.donvitinh_id = dvt.id
                                left join store_sanpham_nhom_loai_rel spnlr on pnct.sanpham_id = spnlr.sanpham_id
                                left join store_sanpham_nhom spn on spnlr.sanpham_nhom_id = spn.id
                            where pxct.phieuxuat_id = $id");

        // return response()->json(
        //     array('totalResult' => $totalResult, 
        //         'totalPages' => $totalPages, 
        //         'currentPage' => $currentPage, 
        //         'result' => $data)
        //     , 200);

        // dd($data);
        // dd($chitiet);

        return json_encode(
            array('totalResult' => $totalResult, 
                'totalPages' => $totalPages, 
                'currentPage' => $currentPage, 
                'result' => $data,
                'detail' => $chitiet));
    }

    public function getDanhSachSanPhamConSoLuong($kho_id, $ngay_xuat_kho)
    {
        $parameter = [
            $kho_id,
            $ngay_xuat_kho
        ];
        $result = DB::select('call usp_store_danhsach_sanpham_consoluong(?,?)', $parameter);
        $data = [
            'results' => []
        ];

        foreach($result as $key => $value) {
            //dd($value->ma_sanpham);
            //$data[$value->ma_sanpham]['id'] = $value->ma_sanpham;
            //$data[]['text'] = '['.$value->ma_sanpham.'] '.$value->ten_sanpham.' ('.$value->ten_hoatchat.') '.$value->nongdohamluong.' '.$value->ten_donvitinh.' '.number_format($value->dongianhap,2).' ('.number_format($value->soluong_conlai, 0).')';
            //$data[]['html'] = '['.$value->ma_sanpham.'] '.$value->ten_sanpham.' ('.$value->ten_hoatchat.') '.$value->nongdohamluong.' '.$value->ten_donvitinh.' '.number_format($value->dongianhap,2).' ('.number_format($value->soluong_conlai, 0).')';
            // $data['results'][] = [
            //     'id' => $value->id,
            //     'text' => $value->ma_sanpham
            // ];

            //$data[$value->id] = '['.$value->ma_sanpham.'] '.$value->ten_sanpham.' ('.$value->ten_hoatchat.') '.$value->nongdohamluong.' '.$value->ten_donvitinh.' '.number_format($value->dongianhap,2).' ('.number_format($value->soluong_conlai, 0).')';
            $data[$value->id] = $value->ma_sanpham . '|' . $value->ten_sanpham . '|' . $value->ten_hoatchat . '|' . $value->nongdohamluong . '|' . $value->ten_donvitinh . '|' . number_format($value->dongianhap,2) . '|' . number_format($value->soluong_conlai, 0)
                . '|' . $value->so_lo . '|' . Carbon::parse($value->hansudung)->format('d-m-Y')
                . '|' . $value->nguoncungcap;

        }

        //dd($data);
        //dd(json_encode($data));
        //dd($result);//->pluck('ten_sanpham', 'id'));
        // return json_encode($data);
        return $data;
    }
}