
<div class="row">
    <div class="{{$viewClass['label']}}"><h4 class="pull-right">{{ $label }}</h4></div>
    <div class="{{$viewClass['field']}}"></div>
</div>
<hr style="margin-top: 0px;">
<div id="has-many-{{$column}}" class="has-many-{{$column}} has-many-{{ $viewMode }}">
    <table border="1" class="has-many-{{$column}}-forms has-many-{{ $viewMode }}-forms table table-responsive table-bordered">
        @if(!empty($form))
        <tr>
            <?php
            $form = reset($forms);
            ?>
            @foreach($form->fields() as $field)
                @if(!$field->isHidden()) 
                <th width="">{!! $field->label() !!}</th>
                @endif
            @endforeach
            <th>Xóa</th>
        </tr>
        @endif

        @foreach($forms as $pk => $form)
        <tr class="has-many-{{$column}}-form fields-group">
            @foreach($form->fields() as $field)
                {!! $field->render() !!}
            @endforeach

            <td>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="remove btn btn-warning btn-sm pull-right"><i class="fa fa-trash">&nbsp;</i></div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
        
        <tr>
            <td>Tổng thành tiền:</td>
            <td>
                1500000000
            </td>
        </tr>
    </table>

    <template class="{{$column}}-tpl">
        <tr class="has-many-{{$column}}-form fields-group">
            {!! $template !!}

            <td>
                <div class="form-group">
                    <label class="{{$viewClass['label']}} control-label"></label>
                    <div class="{{$viewClass['field']}}">
                        <div class="remove btn btn-warning btn-sm pull-right"><i class="fa fa-trash"></i>&nbsp;</div>
                    </div>
                </div>
            </td>
        </tr>
    </template>

    <div class="form-group">
        <label class="{{$viewClass['label']}} control-label"></label>
        <div class="{{$viewClass['field']}}">
            <div class="add btn btn-success btn-sm"><i class="fa fa-save"></i>&nbsp;{{ trans('admin.new') }}</div>
        </div>
    </div>

</div>