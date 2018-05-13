<?php

namespace App\Admin\Controllers\Reports;

use App\Models\StoreSoketoan;
use App\Models\StoreKho;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
use DB;

class StoreReportNhapxuattonChitietController extends Controller
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

            $content->header('Báo cáo Nhập xuất tồn chi tiết');
            $content->description('description');

            $kho = StoreKho::selectboxData();
            $content->body(view('admin.reports.nhapxuatton_chitiet.index')
                ->with('kho', $kho));
        });
    }
}
