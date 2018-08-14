

<form id="conditionForm" method="post" action="{{ route('store.print', ['view' => 'bieumau_report_bangkexuatkho_tonghop']) }}">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="p_nguoncungcap_id">Loại báo cáo</label>
                <select class="form-control" style="width: 100%;" name="loai_bao_cao_ten"  id="loai_bao_cao_ten">                        
                    <option value="tong_hop" >Báo cáo tổng hợp</option>
                    <option value="don_vi" >Báo cáo theo Đơn vị nhận</option>
                    <option value="san_pham" >Báo cáo Sản phẩm</option>
                    <option value="nhom_loai" >Báo cáo Nhóm sản phẩm và loại sản phẩm</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="p_ngay_batdau">Từ ngày</label>
                <input type="text" class="form-control" id="p_ngay_batdau" name="p_ngay_batdau" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="p_ngay_ketthuc">Đến ngày</label>
                <input type="text" class="form-control" id="p_ngay_ketthuc" name="p_ngay_ketthuc" required>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="p_donvi_id">Đơn vị nhận</label>
                <select class="form-control" style="width: 100%;" name="p_donvi_id[]" id="p_donvi_id">
                    <option value="">--Tất cả--</option>
                    @foreach($donVi as $select => $option)
                    <option value="{{$select}}" >{{$option}}</option>
                    @endforeach
                </select>
            </div>
        </div>        
        <div class="col-sm-12">
                <div class="form-group">
                    <label for="p_sanpham_id">Sản phẩm</label>
                    <select class="form-control" style="width: 100%;" name="p_sanpham_id[]" multiple id="p_sanpham_id">
                        <option value=""></option>
                        @foreach($sanPham as $select => $option)
                        <option value="{{$select}}">{{$option}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="p_nhomsanpham_id">Nhóm sản phẩm</label>
                <select class="form-control" style="width: 100%;" name="p_nhomsanpham_id[]" multiple id="p_nhomsanpham_id">
                    <option value=""></option>
                    @foreach($nhomSanPham as $select => $option)
                    <option value="{{$select}}">{{$option}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="p_loaisanpham_id">Loại sản phẩm</label>
                <select class="form-control" style="width: 100%;" name="p_loaisanpham_id[]" multiple id="p_loaisanpham_id">
                    <option value=""></option>
                    @foreach($loaiSanPham as $select => $option)
                    <option value="{{$select}}">{{$option}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <button type="submit" class="btn btn-primary">Lập báo cáo</button>
        </div>
    </div>
</form>

<script>
    $('#loai_bao_cao_ten').change(function(){
        if($('#loai_bao_cao_ten').val() == 'tong_hop'){
            disabling_control(false,false,false,false);
        } else if($('#loai_bao_cao_ten').val() == 'don_vi'){
            disabling_control(false,true,true,true);
        } else if($('#loai_bao_cao_ten').val() == 'san_pham'){
            disabling_control(true,false,true,true);
        } else if($('#loai_bao_cao_ten').val() == 'nhom_loai'){
            disabling_control(true,true,false,false);
        }
    });
    function disabling_control(donvi, sanpham, nhomsanpham, loaisanpham){
        $('#p_donvi_id').attr('disabled', donvi) ;
        $('#p_sanpham_id').attr('disabled', sanpham) ;
        $('#p_nhomsanpham_id').attr('disabled', nhomsanpham) ;
        $('#p_loaisanpham_id').attr('disabled', loaisanpham) ;
    }
</script>

<link rel="stylesheet" href="{{ admin_asset("/vendor/laravel-admin/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css") }}">
<link rel="stylesheet" href="{{ admin_asset("/vendor/laravel-admin/AdminLTE/plugins/select2/select2.min.css") }}">
<script src="{{ admin_asset ("/vendor/laravel-admin/moment/min/moment-with-locales.min.js") }}"></script>
<script src="{{ admin_asset ("/vendor/laravel-admin/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js") }}"></script>
<script src="{{ admin_asset ("/vendor/laravel-admin/AdminLTE/plugins/select2/select2.full.min.js") }}"></script>
<?php
  $options['format'] = 'YYYY-MM-DD HH:mm:ss';
  $options['locale'] = config('app.locale');
  $options['sideBySide'] = true;
  $options['keepOpen'] = true;
  //dd(json_encode($options));
?>
<script>
  var option = {!! json_encode($options) !!};
  $('#p_ngay_batdau').datetimepicker(option);
  $('#p_ngay_ketthuc').datetimepicker(option);
  $('#p_nguoncungcap_id').select2({'allowClear': 'true'});
  $('#p_sanpham_id').select2({'allowClear': 'true'});
  $('#p_nhomsanpham_id').select2({'allowClear': 'true'});
  $('#p_loaisanpham_id').select2({'allowClear': 'true'});
</script>