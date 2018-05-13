<button type="button" class="btn btn-default waves-effect m-r-20" data-toggle="modal" data-target="#largeModal" data-backdrop="static" data-keyboard="false">Thêm mới Sản phẩm</button>

<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel">Thêm mới Sản phẩm</h4>
            </div>
            <div class="modal-body">
                <form id="sanPhamForm" method="post" action="{{ url('/store/sanpham') }}">
                    {{ csrf_field() }}
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" id="ma_sanpham" name="ma_sanpham" class="form-control">
                            <label class="form-label">Mã sản phẩm</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" id="ten_sanpham" name="ten_sanpham" class="form-control">
                            <label class="form-label">Tên sản phẩm</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" id="ten_hoatchat" name="ten_hoatchat" class="form-control">
                            <label class="form-label">Tên hoạt chất</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" id="nongdo_hamluong" name="nongdo_hamluong" class="form-control">
                            <label class="form-label">Nồng độ / hàm lượng</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" id="quycachdonggoi" name="quycachdonggoi" class="form-control">
                            <label class="form-label">Quy cách đóng gói</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <select class="form-control" style="width: 100%;" name="donvitinh_id" id="donvitinh_id">
                                <option value=""></option>
                                @foreach($donvitinh as $select => $option)
                                    <option value="{{$select}}">{{$option}}</option>
                                @endforeach
                            </select>
                            <label class="form-label">Đơn vị tính</label>
                        </div>
                    </div>

                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect save">Lưu</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<script>
$('#largeModal').on('hidden.bs.modal', function() {
$(this)
.find("input,textarea,select")
.val('')
.end()
.find("input[type=checkbox], input[type=radio]")
.prop("checked", "")
.end();
})

$('.modal-footer').on('click', '.save', function() {
    $.ajax({
        type: 'POST',
        url: '{{ route('store.sanpham.storeInModal') }}',
        data: $("#sanPhamForm").serialize(),
        success: function(data) {

            // create the option and append to Select2
            var option = new Option(data.ten_sanpham, data.id, true, true);
            $(".sanpham_id").append(option);//.trigger('change');






            // // Set the value, creating a new option if necessary
            // if ($(".sanpham_id").find("option[value='" + newStateVal + "']").length) {
            //     //$("#state").val(newStateVal).trigger("change");
            // } else { 
            //     // Create the DOM option that is pre-selected by default
            //     var newState = new Option(newStateVal, newStateVal, true, true);
            //     // Append it to the select
            //     $(".sanpham_id").append(newState);//.trigger('change');
            // } 








            // $('.errorTitle').addClass('hidden');
            // $('.errorContent').addClass('hidden');

            // if ((data.errors)) {
            //     setTimeout(function () {
            //         $('#addModal').modal('show');
            //         toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
            //     }, 500);

            //     if (data.errors.title) {
            //         $('.errorTitle').removeClass('hidden');
            //         $('.errorTitle').text(data.errors.title);
            //     }
            //     if (data.errors.content) {
            //         $('.errorContent').removeClass('hidden');
            //         $('.errorContent').text(data.errors.content);
            //     }
            // } else {
                


            //     // toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 5000});
            //     // $('#postTable').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.title + "</td><td>" + data.content + "</td><td class='text-center'><input type='checkbox' class='new_published' data-id='" + data.id + " '></td><td>Right now</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
            //     // $('.new_published').iCheck({
            //     //     checkboxClass: 'icheckbox_square-yellow',
            //     //     radioClass: 'iradio_square-yellow',
            //     //     increaseArea: '20%'
            //     // });
            //     // $('.new_published').on('ifToggled', function(event){
            //     //     $(this).closest('tr').toggleClass('warning');
            //     // });
            //     // $('.new_published').on('ifChanged', function(event){
            //     //     id = $(this).data('id');
            //     //     $.ajax({
            //     //         type: 'POST',
            //     //         url: "",
            //     //         data: {
            //     //             '_token': $('input[name=_token]').val(),
            //     //             'id': id
            //     //         },
            //     //         success: function(data) {
            //     //             // empty
            //     //         },
            //     //     });
            //     // });
            // }
        },
    }).done(function (data) {
        $('#largeModal').modal('hide');
    });
    return false;;
});
</script>