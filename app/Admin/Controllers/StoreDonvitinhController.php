<?php

namespace App\Admin\Controllers;

use App\Models\StoreDonvitinh;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;

class StoreDonvitinhController extends Controller
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

            $content->header('Đơn vị tính');
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

            $content->header('Đơn vị tính');
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

            $content->header('Đơn vị tính');
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
        return Admin::grid(StoreDonvitinh::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->column('ma_donvitinh', __('models.store_donvitinh.ma_donvitinh'));
            $grid->column('ten_donvitinh', __('models.store_donvitinh.ten_donvitinh'));

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
        return Admin::form(StoreDonvitinh::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('ma_donvitinh', __('models.store_donvitinh.ma_donvitinh'));
            $form->text('ten_donvitinh', __('models.store_donvitinh.ten_donvitinh'));

            $form->display('created_at', __('models.common.created_at'));
            $form->display('updated_at', __('models.common.updated_at'));
        });
    }
}
