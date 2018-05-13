<?php

namespace App\Admin\Controllers;

use App\Models\StoreChuongtrinh;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;

class StoreChuongtrinhController extends Controller
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

            $content->header('Chương trình');
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

            $content->header('Chương trình');
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

            $content->header('Chương trình');
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
        return Admin::grid(StoreChuongtrinh::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->column('ma_chuongtrinh', __('models.store_chuongtrinh.ma_chuongtrinh'));
            $grid->column('ten_chuongtrinh', __('models.store_chuongtrinh.ten_chuongtrinh'));

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
        return Admin::form(StoreChuongtrinh::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('ma_chuongtrinh', __('models.store_chuongtrinh.ma_chuongtrinh'));
            $form->text('ten_chuongtrinh', __('models.store_chuongtrinh.ten_chuongtrinh'));

            $form->display('created_at', __('models.common.created_at'));
            $form->display('updated_at', __('models.common.updated_at'));
        });
    }
}
