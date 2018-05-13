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
use Encore\Admin\Grid\Exporters\AbstractExporter;
use Maatwebsite\Excel\Classes\LaravelExcelWorksheet;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    protected $bag;

    public function exportExcelPhieuNhap()
    {
        Excel::create('SanPham', function($excel) {

            $excel->sheet('Sản phẩm', function(LaravelExcelWorksheet $sheet) {
                //$sheet->loadView('');
                $sheet->rows(['id' => 1, 'ma_sanpham' => 2]);

                // $this->chunk(function ($records) use ($sheet) {

                //     $rows = $records->map(function ($item) {
                //         return array_only($item->toArray(), 
                //             [
                //                 'id', 
                //                 'ma_sanpham', 
                //                 'ten_sanpham', 
                //                 'ten_hoatchat', 
                //                 'nongdo_hamluong', 
                //                 'sokiemsoat'
                //             ]);
                //     });

                //     $sheet->rows($rows);

                // });

            });

        })->export('xlsx');
    }
}
