<?php

namespace App\Admin\Controllers;

use App\Models\StoreKhoLoaiRel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Models\StoreKho;
use App\Models\StoreKhoLoai;

class StoreKhoLoaiRelController extends Controller
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

            $content->header('Phân nhóm Kho-Loại kho');
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

            $content->header('Phân nhóm Kho-Loại kho');
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

            $content->header('Phân nhóm Kho-Loại kho');
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
        return Admin::grid(StoreKhoLoaiRel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->kho_loai()->ten_loai_kho(__('models.store_kho_loai.ten_loai_kho'));
            $grid->kho()->ten_kho(__('models.store_kho.ten_kho'));

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
        return Admin::form(StoreKhoLoaiRel::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->select('kho_loai_id')->options(
                StoreKhoLoai::NoneDelete()->pluck('ten_loai_kho', 'id')
            )->rules('required');

            $form->select('kho_id')->options(
                StoreKho::NoneDelete()->pluck('ten_kho', 'id')
            )->rules('required');

            $form->display('created_at', __('models.common.created_at'));
            $form->display('updated_at', __('models.common.updated_at'));
        });
    }
}
