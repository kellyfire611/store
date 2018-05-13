<?php

namespace App\Admin\Controllers\V1;

use Illuminate\Http\Request;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Models\StoreKho;
use App\Models\StoreKhoLoai;
use App\Models\StoreSanpham;
use App\Models\StorePhieunhap;
use DB;

class ApiController extends Controller
{
    use ApiDataController;

    public function kho(Request $request)
    {
        $q = $request->get('q');

        return StoreKho::where('ten_kho', 'like', "%$q%")->paginate(null, [DB::raw('ID as id'),DB::raw('ten_kho as text')]);
    }

    public function loai_kho(Request $request)
    {
        $q = $request->get('q');

        return StoreKhoLoai::where('ten_loai_kho', 'like', "%$q%")->paginate(null, [DB::raw('ID as id'),DB::raw('ten_loai_kho as text')]);
    }

    public function linkageSelectData(Request $request)
    {
        $id = $request->get('q');
        return StoreKho::where('id', $id)->get(['id', DB::raw('name as text')]);
    }
}
