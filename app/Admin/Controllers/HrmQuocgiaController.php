<?php

namespace App\Admin\Controllers;

use App\Models\HrmQuocgia;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class HrmQuocgiaController extends Controller
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

            $content->header('Quốc gia');
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

            $content->header('Quốc gia');
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

            $content->header('Quốc gia');
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
        return Admin::grid(HrmQuocgia::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->column('ma_quocgia', __('models.hrm_quocgia.ma_quocgia'));
            $grid->column('ten_quocgia', __('models.hrm_quocgia.ten_quocgia'));

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
        return Admin::form(HrmQuocgia::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('ma_quocgia', __('models.hrm_quocgia.ma_quocgia'));
            $form->text('ten_quocgia', __('models.hrm_quocgia.ten_quocgia'));

            $form->display('created_at', __('models.common.created_at'));
            $form->display('updated_at', __('models.common.updated_at'));
        });
    }
}
