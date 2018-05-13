<?php

namespace App\Admin\Controllers;

use App\Models\StoreSanpham;
use App\Models\StoreSanphamLoai;
use App\Models\StoreSanphamNhom;
use App\Models\StoreSanphamNhomLoaiRel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;

class StoreSanphamNhomLoaiRelController extends Controller
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

            $content->header('Phân Sản phẩm-Nhóm-Loại');
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

            $content->header('Phân Sản phẩm-Nhóm-Loại');
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

            $content->header('Phân Sản phẩm-Nhóm-Loại');
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
        return Admin::grid(StoreSanphamNhomLoaiRel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->column('sanpham_id', __('models.store_sanpham_nhom_loai_rel.sanpham_id'));
            $grid->column('sanpham_nhom_id', __('models.store_sanpham_nhom_loai_rel.sanpham_nhom_id'));
            $grid->column('sanpham_loai_id', __('models.store_sanpham_nhom_loai_rel.sanpham_loai_id'));

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
        return Admin::form(StoreSanphamNhomLoaiRel::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->select('sanpham_id', __('models.store_sanpham_nhom_loai_rel.sanpham_id'))->options(
                StoreSanpham::NoneDelete()->pluck('ten_sanpham', 'id')
            )->rules('required');
            
            $form->select('sanpham_loai_id', __('models.store_sanpham_nhom_loai_rel.sanpham_loai_id'))->options(
                StoreSanphamLoai::NoneDelete()->pluck('ten_loai_sanpham', 'id')
            )->rules('required');

            $form->select('sanpham_nhom_id', __('models.store_sanpham_nhom_loai_rel.sanpham_nhom_id'))->options(
                StoreSanphamNhom::NoneDelete()->pluck('ten_nhom_sanpham', 'id')
            )->rules('required');

            $form->display('created_at', __('models.common.created_at'));
            $form->display('updated_at', __('models.common.updated_at'));
        });
    }
}
