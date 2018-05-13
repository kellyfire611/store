<?php

namespace App\Admin\Controllers;

use App\Models\StoreSanphamNhom;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;

class StoreSanphamNhomController extends Controller
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

            $content->header('Nhóm sản phẩm');
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

            $content->header('Nhóm sản phẩm');
            $content->description('Hiệu chỉnh');

            $content->body($this->form()->edit($id));
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

            $content->header('Nhóm sản phẩm');
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
        return Admin::grid(StoreSanphamNhom::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->column('ma_nhom_sanpham', __('models.store_sanpham_nhom.ma_nhom_sanpham'));
            $grid->column('ten_nhom_sanpham', __('models.store_sanpham_nhom.ten_nhom_sanpham'));

            $grid->created_at(__('models.common.created_at'));
            $grid->updated_at(__('models.common.updated_at'));
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(StoreSanphamNhom::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('ma_nhom_sanpham', __('models.store_sanpham_nhom.ma_nhom_sanpham'));
            $form->text('ten_nhom_sanpham', __('models.store_sanpham_nhom.ten_nhom_sanpham'));

            $form->display('created_at', __('models.common.created_at'));
            $form->display('updated_at', __('models.common.updated_at'));
        });
    }
}
