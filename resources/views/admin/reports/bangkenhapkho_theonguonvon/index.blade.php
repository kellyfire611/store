

<form id="conditionForm" method="post" action="{{ route('store.print', ['view' => 'bieumau_report_bangkenhapkho_theonguonvon']) }}">
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
                <label for="p_nguoncungcap_id">Nguồn cung cấp</label>
                <select class="form-control" style="width: 100%;" name="p_nguoncungcap_id" id="p_nguoncungcap_id">
                    <option value=""></option>
                    @foreach($nguonCungCap as $select => $option)
                    <option value="{{$select}}">{{$option}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">Nhóm sản phẩm</label>
                <select class="form-control" style="width: 100%;" name="p_nguoncungcap_id" id="p_nguoncungcap_id">
                    <option value=""></option>
                    @foreach($nhomSanPham as $select => $option)
                    <option value="{{$select}}">{{$option}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">Loại sản phẩm</label>
                <select class="form-control" style="width: 100%;" name="p_nguoncungcap_id" id="p_nguoncungcap_id">
                    <option value=""></option>
                    @foreach($loaiSanPham as $select => $option)
                    <option value="{{$select}}">{{$option}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">Nhà cung cấp</label>
                <select class="form-control" style="width: 100%;" name="p_nguoncungcap_id" id="p_nguoncungcap_id">
                    <option value=""></option>
                    @foreach($nhaCungCap as $select => $option)
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
<!-- <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                                INPUT
                                <small>Different sizes and widths</small>
                            </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                            <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <h2 class="card-inside-title">Basic Examples</h2>
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                    </div>
                </div>

                <h2 class="card-inside-title">Different Widths</h2>
                <div class="row clearfix">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="col-sm-6">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="col-sm-6">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="col-sm-4">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="col-sm-4">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="col-sm-4">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="col-sm-3">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="col-sm-3">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="col-sm-3">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="col-sm-3">
                            </div>
                        </div>
                    </div>
                </div>

                <h2 class="card-inside-title">Different Sizes</h2>
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="form-group form-group-lg">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="Large Input">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="Default Input">
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="Small Input">
                            </div>
                        </div>
                    </div>
                </div>

                <h2 class="card-inside-title">Floating Label Examples</h2>
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control">
                                <label class="form-label">Username</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="password" class="form-control">
                                <label class="form-label">Password</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group form-float form-group-lg">
                            <div class="form-line">
                                <input type="text" class="form-control">
                                <label class="form-label">Large Input</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control">
                                <label class="form-label">Default Input</label>
                            </div>
                        </div>
                        <div class="form-group form-float form-group-sm">
                            <div class="form-line">
                                <input type="text" class="form-control">
                                <label class="form-label">Small Input</label>
                            </div>
                        </div>
                    </div>
                </div>

                <h2 class="card-inside-title">Input Status</h2>
                <div class="row clearfix">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line focused">
                                <input type="text" class="form-control" value="Focused" placeholder="Statu Focused">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line disabled">
                                <input type="text" class="form-control" placeholder="Disabled" disabled="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
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
  $('#p_nguoncungcap_id').select2({'allowClear': 'true'});
</script>