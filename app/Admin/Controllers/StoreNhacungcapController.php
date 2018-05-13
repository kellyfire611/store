<?php

namespace App\Admin\Controllers;

use App\Models\StoreNhacungcap;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;

class StoreNhacungcapController extends Controller
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

            $content->header('Nhà cung cấp');
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

            $content->header('Nhà cung cấp');
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

            $content->header('Nhà cung cấp');
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
        return Admin::grid(StoreNhacungcap::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->column('ma_nhacungcap', __('models.store_nhacungcap.ma_nhacungcap'));
            $grid->column('ten_nhacungcap', __('models.store_nhacungcap.ten_nhacungcap'));
            $grid->column('diachi_nhacungcap', __('models.store_nhacungcap.diachi_nhacungcap'));
            $grid->column('sodienthoai_nhacungcap', __('models.store_nhacungcap.sodienthoai_nhacungcap'));

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
        return Admin::form(StoreNhacungcap::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('ma_nhacungcap', __('models.store_nhacungcap.ma_nhacungcap'));
            $form->text('ten_nhacungcap', __('models.store_nhacungcap.ten_nhacungcap'));
            $form->text('diachi_nhacungcap', __('models.store_nhacungcap.diachi_nhacungcap'));
            $form->text('sodienthoai_nhacungcap', __('models.store_nhacungcap.sodienthoai_nhacungcap'));

            $form->display('created_at', __('models.common.created_at'));
            $form->display('updated_at', __('models.common.updated_at'));
        });
    }
}
