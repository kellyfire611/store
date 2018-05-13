

<form id="conditionForm" method="post" action="{{ route('store.print', ['view' => 'bieumau_report_bangkexuatkho_theosanpham']) }}">
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
    <label for="p_ngay_ketthuc">Từ ngày</label>
    <input type="text" class="form-control" id="p_ngay_ketthuc" name="p_ngay_ketthuc">
  </div>
  </div>
  <div class="col-sm-12">
  <div class="form-group">
    <label for="p_sanpham_id">Sản phẩm</label>
    <select class="form-control" style="width: 100%;" name="p_sanpham_id" id="p_sanpham_id">
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

<script>
// // this is the id of the form
// $("#conditionForm").submit(function(e) {

//     // var url = "{{ route('store.ajax.reportBangKeNhapKhoTheoNguonVon') }}"; // the script where you handle the form input.
//     // $.ajaxSetup({
//     //     headers: {
//     //         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
//     //     }
//     // });

//     // $.ajax({
//     //     type: "POST",
//     //     url: url,
//     //     data: $("#conditionForm").serialize(), // serializes the form's elements.
//     //     beforeSend: function(){
//     //         $('<div />').attr('class', 'loading').appendTo('body');
//     //     },
//     //     success: function(data)
//     //     {
//     //         alert(data); // show response from the php script.
//     //     },
//     //     error: function(data) {
//     //         console.log(data);
//     //     }
//     // }).done(function(data) {
//     //     $('.loading').remove();
//     // });

//     e.preventDefault(); // avoid to execute the actual submit of the form.
// });
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
  $('#p_sanpham_id').select2({'allowClear': 'true'});
</script>