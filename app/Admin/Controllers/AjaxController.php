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
use App\Models\StoreSystemConfig;

class AjaxController extends Controller
{
    use ApiDataController;

    public function generateMaSanPham(Request $request)
    {
        // if(empty($tenSanPham))
        // {
        //     return null;
        // }

        $systemConfigMaSanPham = StoreSystemConfig::where('name', '=', 'store.masanpham')->first();
        $arrSystemConfigMaSanPham = json_decode($systemConfigMaSanPham->value, true);
        //dd($jsonSystemConfigMaSanPham);

        $inputs = $request->all();
        $prefix = substr($inputs['tenSanPham'], 0, 3);
        
        $num = 1;
        if(array_key_exists($prefix, $arrSystemConfigMaSanPham)) {
            $arrSystemConfigMaSanPham[$prefix] += 1;
            $num = $arrSystemConfigMaSanPham[$prefix];
        } else {
            $arrSystemConfigMaSanPham[$prefix] = $num;
        }

        $newValueSystemConfigMaSanPham = json_encode($arrSystemConfigMaSanPham);
        //dd($newValueSystemConfigMaSanPham);

        $maSanPhamGenerated = $prefix . $num;
        return response()->json(array('msg'=> $maSanPhamGenerated), 200);
    }

    public function generateSoPhieuNhap(Request $request)
    {
        $systemConfigSoPhieuNhap = StoreSystemConfig::where('name', '=', 'store.sophieunhap')->first();
        $arrSystemConfigSoPhieuNhap = json_decode($systemConfigSoPhieuNhap->value, true);

        $inputs = $request->all();
        $prefix = $inputs['nhapxuat'];
        
        $num = 1;
        if(array_key_exists($prefix, $arrSystemConfigSoPhieuNhap)) {
            $arrSystemConfigSoPhieuNhap[$prefix] += 1;
            $num = $arrSystemConfigSoPhieuNhap[$prefix];
        } else {
            $arrSystemConfigSoPhieuNhap[$prefix] = $num;
        }

        $newValueSystemConfigSoPhieuNhap = json_encode($arrSystemConfigSoPhieuNhap);

        $msoPhieuNhapGenerated = $prefix . $num;
        return response()->json(array('msg'=> $msoPhieuNhapGenerated), 200);
    }

    public function generateSoPhieuXuat(Request $request)
    {
        $systemConfigSoPhieuXuat = StoreSystemConfig::where('name', '=', 'store.sophieuxuat')->first();
        $arrSystemConfigSoPhieuXuat = json_decode($systemConfigSoPhieuXuat->value, true);

        $inputs = $request->all();
        $prefix = $inputs['nhapxuat'];
        
        $num = 1;
        if(array_key_exists($prefix, $arrSystemConfigSoPhieuXuat)) {
            $arrSystemConfigSoPhieuXuat[$prefix] += 1;
            $num = $arrSystemConfigSoPhieuXuat[$prefix];
        } else {
            $arrSystemConfigSoPhieuXuat[$prefix] = $num;
        }

        $newValueSystemConfigSoPhieuXuat = json_encode($arrSystemConfigSoPhieuXuat);

        $msoPhieuXuatGenerated = $prefix . $num;
        return response()->json(array('msg'=> $msoPhieuXuatGenerated), 200);
    }

    public function generateSoPhieuBienBanKiemNhap(Request $request)
    {
        $systemConfig = StoreSystemConfig::where('name', '=', 'store.sobienbankiemnhap')->first();
        $arrSystemConfig = json_decode($systemConfig->value, true);

        $inputs = $request->all();
        $prefix = $inputs['prefix'];
        
        $num = 1;
        if(array_key_exists($prefix, $arrSystemConfig)) {
            $arrSystemConfig[$prefix] += 1;
            $num = $arrSystemConfig[$prefix];
        } else {
            $arrSystemConfig[$prefix] = $num;
        }

        $newValueSystemConfig = json_encode($arrSystemConfig);

        $maGenerated = $prefix . $num;
        return response()->json(array('msg'=> $maGenerated), 200);
    }

    public function reportBangKeNhapKhoTheoNguonVon(Request $request)
    {
        $inputs = $request->all();
        //dd($inputs);
        return response()->json(array('msg'=> $inputs), 200);
    }
}
