<?php

namespace App\Admin\Controllers;

use App\Models\StoreSanpham;
use App\Models\StoreSystemConfig;
use App\Models\StoreDonvitinh;
use App\Models\HrmQuocgia;
use App\Admin\Extensions\Exporters\StoreSanPhamExcelExporter;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class StoreSanphamController extends Controller
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

            $content->header('Sản phẩm');
            $content->description('Danh sách');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Sản phẩm');
            $content->description('Hiệu chỉnh');

            $content->body($this->formEdit()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('Sản phẩm');
            $content->description('Thêm mới');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(StoreSanpham::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->column('anh')->image();
            $grid->column('ma_sanpham', __('models.store_sanpham.ma_sanpham'));
            $grid->column('ten_sanpham', __('models.store_sanpham.ten_sanpham'));
            $grid->column('ten_hoatchat', __('models.store_sanpham.ten_hoatchat'));
            $grid->column('nongdo_hamluong', __('models.store_sanpham.nongdo_hamluong'));
            $grid->column('sokiemsoat', __('models.store_sanpham.sokiemsoat'));
            $grid->column('nha_sanxuat_id', __('models.store_sanpham.nha_sanxuat_id'));
            $grid->column('nuoc_sanxuat_id', __('models.store_sanpham.nuoc_sanxuat_id'));

            $grid->created_at(__('models.common.created_at'));
            $grid->updated_at(__('models.common.updated_at'));

            $grid->exporter(new StoreSanPhamExcelExporter());
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(StoreSanpham::class, function (Form $form) {                   

            // $form->display('id', 'ID');

            $ma_sanpham = $form->text('ma_sanpham', __('models.store_sanpham.ma_sanpham'))
                ->readOnly()
                //->renderStyle(CommonModel::RENDER_STYLE_ONLY_CONTROL)
                //->useTableDiv()
                ->attribute('tabindex', 1);
                //->setViewWidth(3);
            // $ma_sanpham->append("<i class=\"fa fa-code clickable {$ma_sanpham->getElementClassString()}-btn-generateMaSanPham\" aria-hidden=\"true\"></i>")
            //     ->addAjaxCssLoader();

            $ten_sanpham = $form->text('ten_sanpham', __('models.store_sanpham.ten_sanpham'))->attribute(['tabindex' => 2, 'autofocus' => 'autofocus']);

            $ajaxGenerateMaSanPhamUrl = route('store.ajax.generateMaSanPham');
            $callbackSinhMaSanPham = <<<EOT
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});

$.ajax({
    type: 'post',
    url: '$ajaxGenerateMaSanPhamUrl',
    dataType: 'json',
    data: {
        tenSanPham: $("{$ten_sanpham->getElementClassSelector()}").val()
    },
    beforeSend: function(){
        $('<div />').attr('class', 'loading').appendTo('body');
    },
    success: function(data) {
        console.log(data);
        $("{$ma_sanpham->getElementClassSelector()}").val(data.msg);
        $('.loading').remove();
    },
    error: function(data) {
        console.log(data);
    }
}).done(function(data) {
    $("#{$ma_sanpham->getIdString()}-cssloader").fadeOut(100);
});
EOT;

            $ten_sanpham->on('blur', $callbackSinhMaSanPham);


/*
$.ajax({
    url: "info.php?info_id="+id,
    type: 'get',
    beforeSend: function(){
       $("#loading").fadeIn(100);
    },
}).done(function(data) {
   $("#loading").fadeOut(100);
   $(".sidebar").fadeIn().find(".sidebar-content").animate({"right":0}, 200).html(data);
   imgResize(jQuery,'smartresize');   
});
*/

            $form->text('ten_hoatchat', __('models.store_sanpham.ten_hoatchat'))->attribute('tabindex', 3);
            $form->text('nongdo_hamluong', __('models.store_sanpham.nongdo_hamluong'))->attribute('tabindex', 4);
            $form->text('sokiemsoat', __('models.store_sanpham.sokiemsoat'))->attribute('tabindex', 5);
            $form->select('donvitinh_id', __('models.store_sanpham.donvitinh_id'))
                    ->options(StoreDonvitinh::selectboxData());
            $form->text('quycachdonggoi', __('models.store_sanpham.quycachdonggoi'))->attribute('tabindex', 6);
            
            $form->select('nuoc_sanxuat_id', __('models.store_sanpham.nuoc_sanxuat_id'))->options(
                HrmQuocgia::NoneDelete()->pluck('ten_quocgia', 'id')
                )->rules('required')->attribute('tabindex', 6);
                
            $form->image('anh', __('models.store_sanpham.anh'));
            $form->display('created_at', __('models.common.created_at'));
            $form->display('updated_at', __('models.common.updated_at'));

            $form->savingInTransaction(function (Form $form) {
                
                $systemConfigMaSanPham = StoreSystemConfig::where('name', '=', 'store.masanpham')->first();
                $arrSystemConfigMaSanPham = json_decode($systemConfigMaSanPham->value, true);
                //dd($jsonSystemConfigMaSanPham);

                // dd($form->model()->ma_sanpham);
                $prefix = substr($form->model()->ma_sanpham, 0, 3);
                $num = substr($form->model()->ma_sanpham, 3);
                $arrSystemConfigMaSanPham[$prefix] = $num;

                $newValueSystemConfigMaSanPham = json_encode($arrSystemConfigMaSanPham);
                //dd($newValueSystemConfigMaSanPham);

                $systemConfigMaSanPham->value = $newValueSystemConfigMaSanPham;
                $systemConfigMaSanPham->save();
            });
        });
    }
    
    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function formEdit()
    {
        return Admin::form(StoreSanpham::class, function (Form $form) {                   

            $form->display('id', 'ID');

            $ma_sanpham = $form->text('ma_sanpham', __('models.store_sanpham.ma_sanpham'))
                ->readOnly()
                //->renderStyle(CommonModel::RENDER_STYLE_ONLY_CONTROL)
                //->useTableDiv()
                ->attribute('tabindex', 1);
                //->setViewWidth(3);
            // $ma_sanpham->append("<i class=\"fa fa-code clickable {$ma_sanpham->getElementClassString()}-btn-generateMaSanPham\" aria-hidden=\"true\"></i>")
            //     ->addAjaxCssLoader();

            $ten_sanpham = $form->text('ten_sanpham', __('models.store_sanpham.ten_sanpham'))->attribute(['tabindex' => 2, 'autofocus' => 'autofocus']);

            $form->text('ten_hoatchat', __('models.store_sanpham.ten_hoatchat'))->attribute('tabindex', 3);
            $form->text('nongdo_hamluong', __('models.store_sanpham.nongdo_hamluong'))->attribute('tabindex', 4);
            $form->text('sokiemsoat', __('models.store_sanpham.sokiemsoat'))->attribute('tabindex', 5);
            $form->select('donvitinh_id', __('models.store_sanpham.donvitinh_id'))
                ->options(StoreDonvitinh::selectboxData());
            $form->text('quycachdonggoi', __('models.store_sanpham.quycachdonggoi'))->attribute('tabindex', 6);
            
            $form->select('nuoc_sanxuat_id', __('models.store_sanpham.nuoc_sanxuat_id'))->options(
                HrmQuocgia::NoneDelete()->pluck('ten_quocgia', 'id')
                )->rules('required')->attribute('tabindex', 6);
                
            $form->image('anh', __('models.store_sanpham.anh'));
            
            $form->display('created_at', __('models.common.created_at'));
            $form->display('updated_at', __('models.common.updated_at'));
        });
    }

    public function storeInModal(Request $request)
    {
        // $validator = Validator::make(Input::all(), $this->rules);
        // if ($validator->fails()) {
        //     return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        // } else {
            $sp = new StoreSanpham();
            $sp->ma_sanpham = $request->ma_sanpham;
            $sp->ten_sanpham = $request->ten_sanpham;
            $sp->donvitinh_id = $request->donvitinh_id;
            $sp->ten_hoatchat = $request->ten_hoatchat;
            $sp->nongdo_hamluong = $request->nongdo_hamluong;
            $sp->quycachdonggoi = $request->quycachdonggoi;
            $sp->save();
            return response()->json($sp);
        // }
    }
}
