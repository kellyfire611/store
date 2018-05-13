<?php

namespace App\Admin\Controllers;

use App\Models\StoreNhapxuatLoai;
use App\Models\CommonModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;

class StoreNhapxuatLoaiController extends Controller
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

            $content->header('Loại nhập xuất');
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

            $content->header('Loại nhập xuất');
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

            $content->header('Loại nhập xuất');
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
        return Admin::grid(StoreNhapxuatLoai::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->column('ma_loai_nhapxuat', __('models.store_nhapxuat_loai.ma_loai_nhapxuat'));
            $grid->column('ten_loai_nhapxuat', __('models.store_nhapxuat_loai.ten_loai_nhapxuat'));
            $grid->column('la_nhap', __('models.store_nhapxuat_loai.la_nhap'));
            $grid->column('la_noibo', __('models.store_nhapxuat_loai.la_noibo'));
            $grid->column('la_hoantra', __('models.store_nhapxuat_loai.la_hoantra'));

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
        return Admin::form(StoreNhapxuatLoai::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('ma_loai_nhapxuat', __('models.store_nhapxuat_loai.ma_loai_nhapxuat'));
            $form->text('ten_loai_nhapxuat', __('models.store_nhapxuat_loai.ten_loai_nhapxuat'));
            $form->switch('la_nhap', __('models.store_nhapxuat_loai.la_nhap'))->states(CommonModel::getStates());
            $form->switch('la_noibo', __('models.store_nhapxuat_loai.la_noibo'))->states(CommonModel::getStates());
            $form->switch('la_hoantra', __('models.store_nhapxuat_loai.la_hoantra'))->states(CommonModel::getStates());
            
            $form->display('created_at', __('models.common.created_at'));
            $form->display('updated_at', __('models.common.updated_at'));
        });
    }
}
