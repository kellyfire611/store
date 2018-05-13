<?php

namespace App\Admin\Extensions\Exporters;

use Encore\Admin\Grid\Exporters\AbstractExporter;
use Maatwebsite\Excel\Classes\LaravelExcelWorksheet;
use Maatwebsite\Excel\Facades\Excel;

class StoreSanPhamExcelExporter extends AbstractExporter
{
    public function export()
    {
        Excel::create('SanPham', function($excel) {

            $excel->sheet('Sản phẩm', function(LaravelExcelWorksheet $sheet) {

                $this->chunk(function ($records) use ($sheet) {

                    $rows = $records->map(function ($item) {
                        return array_only($item->toArray(), 
                            [
                                'id', 
                                'ma_sanpham', 
                                'ten_sanpham', 
                                'ten_hoatchat', 
                                'nongdo_hamluong', 
                                'sokiemsoat'
                            ]);
                    });

                    $sheet->rows($rows);

                });

            });

        })->export('xlsx');
    }
}