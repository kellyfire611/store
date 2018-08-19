<?php

namespace App\Admin\Controllers;

use App\Models\StorePhieunhap;
use App\Models\StoreNhacungcap;
use App\Models\StoreSoketoan;
use App\Models\StoreKho;
use App\Models\StorePhieunhapChitiet;
use App\Models\StoreSanpham;
use App\Models\StoreDonvitinh;
use App\Models\StoreSystemConfig;
use App\Models\StoreNguoncungcap;
use App\Models\HrmQuocgia;
use App\Models\CommonModel;
use Encore\Admin\Auth\Database\Administrator;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Encore\Admin\Form\Field\Hidden;
use Carbon\Carbon;

class StoreBienbanKiemNhapController extends Controller
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

            $content->header('Biên bản Kiểm nhập');
            $content->description('Danh sách');
            $content->controller(StoreBienbanKiemNhapController::class);

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
            $content->header('Biên bản Kiểm nhập');
            $content->description('Sửa');
            $content->controller('StoreBienbanKiemNhapController');

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

            $content->header('Biên bản Kiểm nhập');
            $content->description('Thêm mới');

            $content->body($this->form());
            $content->body(view('admin.store.phieunhap.modal')->with('donvitinh', StoreDonvitinh::selectboxData()));
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(StorePhieunhap::class, function (Grid $grid) {
            $grid->model()->scopeBienbanKiemNhap();

            $grid->id('ID')->sortable();

            $grid->column('bienban_kiemnhap_sophieu', __('models.store_phieunhap.bienban_kiemnhap_sophieu'));
            $grid->column('bienban_kiemnhap_ngay_lapbienban', __('models.store_phieunhap.bienban_kiemnhap_ngay_lapbienban'));
            $grid->column('bienban_kiemnhap_tokiemnhap', __('models.store_phieunhap.bienban_kiemnhap_tokiemnhap'));
            $grid->column('bienban_kiemnhap_lydo', __('models.store_phieunhap.bienban_kiemnhap_lydo'));
            $grid->column('bienban_kiemnhap_diadiem', __('models.store_phieunhap.bienban_kiemnhap_diadiem'));
            $grid->column('bienban_kiemnhap_ykiendexuat', __('models.store_phieunhap.bienban_kiemnhap_ykiendexuat'));
         
            $grid->actions(function ($actions) {
                $id = $actions->getKey();
                $phieunhap = $actions->row;
                if(!empty($phieunhap->so_phieunhap))
                {
                    $actions->disableDelete();
                    $actions->disableEdit();
                    $actions->append('<span class="label label-success">Đã chuyển thành Phiếu nhập</span>');
                }
                else
                {
                    $token = csrf_token();
                    $route = route('store.chuyenBienBanKiemNhapThanhPhieuNhap');
                    $actions->append('
                        <form method="post" action="'.$route.'">
                            <input type="hidden" name="_token" value="'.$token.'" />
                            <input type="hidden" name="phieunhap_id" value="'.$id.'" />
                            <button class="btn btn-sm btn-warning grid-refresh" type="submit"><i class="fa fa-refresh"></i> Chuyển thành phiếu nhập</button>
                        </form>');
                }
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(StorePhieunhap::class, function (Form $form) {
            //$form->display('id', 'ID');
            // $form->hidden('nhapxuat_id', __('models.store_phieunhap.nhapxuat_id'))
            //     ->default(CommonModel::getNhapXuat()['_NHAP_TON_KHO_DAU_KY_']);
                
            $sophieunhap = $form->text('bienban_kiemnhap_sophieu', __('models.store_phieunhap.bienban_kiemnhap_sophieu'))
                ->attribute('tabindex', 1)
                //->useTableDiv()
                //->labelPosition(CommonModel::LABEL_POSITION_TOP)
                ->readOnly()
                ->setWidth(12, 12, 6);
            
            $ngayLapBienBan = $form->datetime('bienban_kiemnhap_ngay_lapbienban', __('models.store_phieunhap.bienban_kiemnhap_ngay_lapbienban'))
                ->attribute('tabindex', 3)
                //->useTableDiv()
                //->labelPosition(CommonModel::LABEL_POSITION_TOP)
                ->setWidth(12, 12, 6);

                $ajaxGenerateSoPhieuNhapUrl = route('store.ajax.generateSoPhieuBienBanKiemNhap');
                $script = <<<EOT


    $("{$ngayLapBienBan->getElementClassSelector()}").blur(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            
            $.ajax({
                type: 'post',
                url: '$ajaxGenerateSoPhieuNhapUrl',
                dataType: 'json',
                data: {
                    prefix: 'bbkn'
                },
                beforeSend: function(){
                    $('<div />').attr('class', 'loading').appendTo('body');
                },
                success: function(data) {
                    console.log(data);
                    $("{$sophieunhap->getElementClassSelector()}").val(data.msg);
                    $('.loading').remove();
                },
                error: function(data) {
                    console.log(data);
                }
            }).done(function(data) {
                $("#{$sophieunhap->getIdString()}-cssloader").fadeOut(100);
            });
    });
EOT;
         
            

            //dd($ngayLapBienBan);
            //$ngayLapBienBan->on('blur', $callbackSinhSoPhieuNhap);
            $form->script($script);




            $form->textarea('bienban_kiemnhap_tokiemnhap', __('models.store_phieunhap.bienban_kiemnhap_tokiemnhap'))
                ->default(config('company.tokiemnhap'));
                //->useTableDiv()
                //->labelPosition(CommonModel::LABEL_POSITION_TOP)
                //->setWidth(12, 12, 3);

            $form->textarea('bienban_kiemnhap_lydo', __('models.store_phieunhap.bienban_kiemnhap_lydo'));
                // ->useTableDiv()
                // ->labelPosition(CommonModel::LABEL_POSITION_TOP)
                // ->setWidth(12, 12, 3);
            $form->textarea('bienban_kiemnhap_diadiem', __('models.store_phieunhap.bienban_kiemnhap_diadiem'))
                ->default(config('company.diadiemkiemnhap'));
                // ->useTableDiv()
                // ->labelPosition(CommonModel::LABEL_POSITION_TOP)
                // ->setWidth(12, 12, 3);
            $form->textarea('bienban_kiemnhap_ykiendexuat', __('models.store_phieunhap.bienban_kiemnhap_ykiendexuat'));
                // ->useTableDiv()
                // ->labelPosition(CommonModel::LABEL_POSITION_TOP)
                // ->setWidth(12, 12, 3);

                $form->select('nhacungcap_id', __('models.store_phieunhap.nhacungcap_id'))
                ->options(StoreNhacungcap::selectboxData())
                //->rules('required')
                // ->useTableDiv()
                // ->labelPosition(CommonModel::LABEL_POSITION_TOP)
                ->default(1)
                ->setWidth(12, 12, 3);

            $form->select('soketoan_id', __('models.store_phieunhap.soketoan_id'))
                ->options(StoreSoketoan::selectBoxData())
                ->rules('required')
                // ->useTableDiv()
                // ->labelPosition(CommonModel::LABEL_POSITION_TOP)
                ->default(2)
                ->setWidth(12, 12, 3);
            $form->select('nhap_vao_kho_id', __('models.store_phieunhap.nhap_vao_kho_id'))
                ->options(StoreKho::selectboxData())
                ->rules('required')
                // ->useTableDiv()
                // ->labelPosition(CommonModel::LABEL_POSITION_TOP)
                ->default(1)
                ->setWidth(12, 12, 3);

            
            $form->select('nguoi_lapphieu_id', __('models.store_phieunhap.nguoi_lapphieu_id'))
                ->options(CommonModel::administratorSelectboxData())
                ->rules('required')
                //->useTableDiv()
                ->default(Admin::user()->id)
                // ->labelPosition(CommonModel::LABEL_POSITION_TOP)
                ->setWidth(12, 12, 3);

            $form->hasMany('chitiet', 'Chi tiết', function (Form\NestedForm $form) {
                // $form->hidden('nhapxuat_id', __('models.store_phieunhap_chitiet.nhapxuat_id'))
                //     ->default(CommonModel::getNhapXuat()['_NHAP_TON_KHO_DAU_KY_'])
                //     ->displayNone();
                // $form->hidden('soketoan_id',  __('models.store_phieunhap_chitiet.soketoan_id'))
                //     ->default(1)
                //     ->displayNone();
                // $form->hidden('nhap_vao_kho_id', __('models.store_phieunhap_chitiet.nhap_vao_kho_id'))
                //     ->default(1)
                //     ->displayNone();

                $templateResult = <<<EOT

function formatState(state) {
    if (!state.id) {
        return state.text;
    }
    var baseUrl = "/user/pages/images/flags";
    var state = $(
        '<span><img src="' + baseUrl + '/' + state.element.value.toLowerCase() + '.png" class="img-flag" /> ' + state.text + '</span>'
    );
    return state;
    };

EOT;

                $form->select('sanpham_id', __('models.store_sanpham_nhom_loai_rel.sanpham_id'))
                    ->options(StoreSanpham::selectboxData())
                    ->rules('required')
                    //->renderStyle(CommonModel::RENDER_STYLE_ONLY_CONTROL)
                    // ->labelPosition(CommonModel::LABEL_POSITION_TOP)
                    // ->useTableDiv()
                    ->setWidth(12, 12, 4);
                    //->config('templateResult', $templateResult);
                // $form->select('donvitinh_id', __('models.store_phieunhap_chitiet.donvitinh_id'))
                //     ->options(StoreDonvitinh::selectboxData())
                //     // ->renderStyle(CommonModel::RENDER_STYLE_ONLY_CONTROL)
                //     ->labelPosition(CommonModel::LABEL_POSITION_TOP)
                //     ->useTableDiv()
                //     ->setWidth(12, 12, 1);
                // $form->text('so_lo', __('models.store_phieunhap_chitiet.so_lo'))
                //     //->renderStyle(CommonModel::RENDER_STYLE_ONLY_CONTROL)
                //     ->labelPosition(CommonModel::LABEL_POSITION_TOP)
                //     ->useTableDiv()
                //     ->setWidth(12, 12, 1);
                //     // onlyControl, onlyLabel, LabelAndControl
                    // bootstrap_div_group_only_control
                    // bootstrap_div_group_only_label
                    // bootstrap_div_group_only_label_and_control
                // $form->text('so_chungtu', __('models.store_phieunhap_chitiet.so_chungtu'))
                //     // ->renderStyle(CommonModel::RENDER_STYLE_ONLY_CONTROL)
                //     ->labelPosition(CommonModel::LABEL_POSITION_TOP)
                //     ->useTableDiv()
                //     ->setWidth(12, 12, 1);
                $form->select('nguoncungcap_id', __('models.store_phieunhap_chitiet.nguoncungcap_id'))
                    ->options(StoreNguoncungcap::selectboxData())
                    ->rules('required')
                    //->renderStyle(CommonModel::RENDER_STYLE_ONLY_CONTROL)
                    // ->labelPosition(CommonModel::LABEL_POSITION_TOP)
                    // ->useTableDiv()
                    ->setWidth(12, 12, 4);
                $form->select('nuocsanxuat_id', 'Nước sản xuất')->options(
                    HrmQuocgia::NoneDelete()->pluck('ten_quocgia', 'id')
                    )->rules('required')->attribute('tabindex', 6)
                    ->setWidth(12, 12, 4);
                $form->text('nongdohamluong', 'Nồng độ/Hàm lượng')
                    //->renderStyle(CommonModel::RENDER_STYLE_ONLY_CONTROL)
                    // ->labelPosition(CommonModel::LABEL_POSITION_TOP)
                    // ->useTableDiv()
                    ->setWidth(12, 12, 4);
                $form->text('so_lo', __('models.store_phieunhap_chitiet.so_lo'))
                    //->renderStyle(CommonModel::RENDER_STYLE_ONLY_CONTROL)
                    // ->labelPosition(CommonModel::LABEL_POSITION_TOP)
                    // ->useTableDiv()
                    ->setWidth(12, 12, 2);
                    // onlyControl, onlyLabel, LabelAndControl
                    // bootstrap_div_group_only_control
                    // bootstrap_div_group_only_label
                    // bootstrap_div_group_only_label_and_control
                $form->text('so_chungtu', __('models.store_phieunhap_chitiet.so_chungtu'))
                    // ->renderStyle(CommonModel::RENDER_STYLE_ONLY_CONTROL)
                    // ->labelPosition(CommonModel::LABEL_POSITION_TOP)
                    // ->useTableDiv()
                    ->setWidth(12, 12, 2);
                $form->datetime('ngay_chungtu', 'Ngày chứng từ')
                    // ->renderStyle(CommonModel::RENDER_STYLE_ONLY_CONTROL)
                    // ->labelPosition(CommonModel::LABEL_POSITION_TOP)
                    // ->useTableDiv()
                    ->setWidth(12, 12, 2);
                $form->datetime('hansudung', __('models.store_phieunhap_chitiet.hansudung'))
                    // ->renderStyle(CommonModel::RENDER_STYLE_ONLY_CONTROL)
                    // ->labelPosition(CommonModel::LABEL_POSITION_TOP)
                    // ->useTableDiv()
                    ->setWidth(12, 12, 2);
                $form->currency('dongianhap', __('models.store_phieunhap_chitiet.dongianhap'))
                    ->addElementClass(['dongia'])
                    ->rules('required')
                    // ->renderStyle(CommonModel::RENDER_STYLE_ONLY_CONTROL)
                    // ->labelPosition(CommonModel::LABEL_POSITION_TOP)
                    // ->useTableDiv()
                    ->setWidth(12, 12, 2);
                $form->currency('soluong_theohopdong', 'SL theo HĐ')
                    //->addElementClass(['soluong'])
                    ->rules('required')
                    // ->renderStyle(CommonModel::RENDER_STYLE_ONLY_CONTROL)
                    // ->labelPosition(CommonModel::LABEL_POSITION_TOP)
                    // ->useTableDiv()
                    ->setWidth(12, 12, 2);
                $form->currency('soluongnhap', 'Số lượng thực tế')
                    ->addElementClass(['soluong'])
                    ->rules('required')
                    // ->renderStyle(CommonModel::RENDER_STYLE_ONLY_CONTROL)
                    // ->labelPosition(CommonModel::LABEL_POSITION_TOP)
                    // ->useTableDiv()
                    ->setWidth(12, 12, 2);
                // $form->currency('soluong_conlai', __('models.store_phieunhap_chitiet.soluong_conlai'))
                //     ->renderStyle(CommonModel::RENDER_STYLE_ONLY_CONTROL)
                //     ->useTableDiv()
                //     ->setViewWidth(1);
                // $form->currency('thue', __('models.store_phieunhap_chitiet.thue'))
                //     // ->renderStyle(CommonModel::RENDER_STYLE_ONLY_CONTROL)
                //     ->labelPosition(CommonModel::LABEL_POSITION_TOP)
                //     ->useTableDiv()
                //     ->setWidth(12, 12, 1);
                //$form->datetime('ngay_sudungdautien', __('models.store_phieunhap_chitiet.ngay_sudungdautien'));
            });//->useTableDiv();

            $form->display('created_at', __('models.common.created_at'));
            $form->display('updated_at', __('models.common.updated_at'));

            $form->savingInTransaction(function (Form $form) {
                $model = $form->model();
                // $model->soluong_conlai = $model->soluongnhap;
                // dd($model->soluongnhap);

                // Cập nhật SystemConfig Số phiếu nhập
                $systemConfigSoPhieuNhap = StoreSystemConfig::where('name', '=', 'store.sobienbankiemnhap')->first();
                $arrSystemConfigSoPhieuNhap = json_decode($systemConfigSoPhieuNhap->value, true);

                $prefix = substr($model->so_phieunhap, 0, 3);
                $num = substr($model->so_phieunhap, 3);
                
                $arrSystemConfigSoPhieuNhap[$prefix] = $num;

                $newValueSystemConfigSoPhieuNhap = json_encode($arrSystemConfigSoPhieuNhap);

                $systemConfigSoPhieuNhap->value = $newValueSystemConfigSoPhieuNhap;
                $systemConfigSoPhieuNhap->save();
            });

            
            $form->savingInTransactionDetailHasMany(function (Form $form, $instance) {
                //dd($instance);
                $sanpham = StoreSanpham::find($instance->sanpham_id);
                $instance->donvitinh_id = $sanpham->donvitinh_id;
                $instance->soluong_conlai = $instance->soluongnhap;

                $instance->nhapxuat_id = $form->model()->nhapxuat_id;
                $instance->soketoan_id = $form->model()->soketoan_id;
                $instance->nhap_vao_kho_id = $form->model()->nhap_vao_kho_id;
            });
        });
    }

    public function ChuyenBienBanKiemNhapThanhPhieuNhap(Request $request)
    {
        $inputs = $request->all();
        $phieunhap_id = $inputs['phieunhap_id'];
        $phieunhap = StorePhieunhap::find($phieunhap_id);

        // Sinh số tự động
        $systemConfigSoPhieuNhap = StoreSystemConfig::where('name', '=', 'store.sophieunhap')->first();
        $arrSystemConfigSoPhieuNhap = json_decode($systemConfigSoPhieuNhap->value, true);
        $prefix = 'nkl';
        
        $num = 1;
        if(array_key_exists($prefix, $arrSystemConfigSoPhieuNhap)) {
            $arrSystemConfigSoPhieuNhap[$prefix] += 1;
            $num = $arrSystemConfigSoPhieuNhap[$prefix];
        } else {
            $arrSystemConfigSoPhieuNhap[$prefix] = $num;
        }

        $newValueSystemConfigSoPhieuNhap = json_encode($arrSystemConfigSoPhieuNhap);

        $msoPhieuNhapGenerated = $prefix . $num;
        $phieunhap->so_phieunhap = $msoPhieuNhapGenerated;

        $systemConfigSoPhieuNhap->value = $newValueSystemConfigSoPhieuNhap;
        $systemConfigSoPhieuNhap->save();

        $phieunhap->ngay_nhapkho = Carbon::now();
        $phieunhap->lydo_nhap = 'Chuyển dữ liệu từ Biên bản kiểm nhập ' . $phieunhap->bienban_kiemnhap_sophieu;
        $phieunhap->nhapxuat_id = CommonModel::getNhapXuat()['_NHAP_VAO_KHO_LE_'];
        $phieunhap->save();

        return redirect('/admin/store/bienban/kiemnhap');
    }
}
