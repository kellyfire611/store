<form id="conditionForm" method="post" action="{{ route('store.print', ['view' => 'bieumau_report_nhapxuatton_chitiet']) }}" target="_blank">
    {{ csrf_field() }}
    <div class="row">
    <div class="col-sm-6">
  <div class="form-group">
    <label for="p_ngay_batdau">Từ ngày</label>
    <input type="text" class="form-control" id="p_ngay_batdau" name="p_ngay_batdau">
  </div>
  </div>
  <div class="col-sm-6">
  <div class="form-group">
    <label for="p_ngay_ketthuc">Đến ngày</label>
    <input type="text" class="form-control" id="p_ngay_ketthuc" name="p_ngay_ketthuc">
  </div>
  </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label for="p_nguoncungcap_id">Loại báo cáo</label>
            <!--<input name="loai_bao_cao_ten"  id="loai_bao_cao_ten" class="form-control" style="width: 100%;"  value="Báo cáo xuất kho tổng hợp" />-->
            <select class="form-control" style="width: 100%;" name="loai_bao_cao_ten"  id="loai_bao_cao_ten">                        
                <option value="xnt" >Báo cáo xuất nhập tồn chi tiết</option>
                <option value="tk" >Báo cáo tồn kho</option>
            </select>
        </div>
    </div>
  <div class="col-sm-12">  
      <div class="form-group">
    <label for="p_kho_id">Kho</label>
    <select class="form-control" style="width: 100%;" name="p_kho_id"  id="p_kho_id">
        <option value=""></option>
        @foreach($kho as $select => $option)
            <option value="{{$select}}">{{$option}}</option>
        @endforeach
    </select>
    </div>
      <div class="form-group">
    <label for="p_sanpham_id">Sản phẩm</label>
    <select class="form-control" style="width: 100%;" name="p_sanpham_id[]" multiple  id="p_sanpham_id">
        <option value=""></option>
        @foreach($sanpham as $select => $option)
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
  $('#p_kho_id').select2({'allowClear': 'true'});
  $('#p_sanpham_id').select2({'allowClear': 'true'});
</script>