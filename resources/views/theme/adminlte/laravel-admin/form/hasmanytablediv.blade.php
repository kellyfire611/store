
<div class="row">
    <div class="{{$viewClass['label']}}"><h4 class="pull-right">{{ $label }}</h4></div>
    <div class="{{$viewClass['field']}}"></div>
</div>
<hr style="margin-top: 0px;">
<div id="has-many-{{$column}}" class="has-many-{{$column}} has-many-{{ $viewMode }}">
    <div class="has-many-{{$column}}-forms has-many-{{ $viewMode }}-forms">
        @if(!empty($form))
        <div>
            <?php
            $form = reset($forms);
            ?>
            @foreach($form->fields() as $field)
                @if(!$field->isHidden()) 
                <th width="">{!! $field->label() !!}</th>
                @endif
            @endforeach
            <th>Xóa</th>
        </div>
        @endif

        @foreach($forms as $pk => $form)
        <div class="has-many-{{$column}}-form fields-group clearfix">
            @foreach($form->fields() as $field)
                {!! $field->render() !!}
            @endforeach

            <div class="form-group col-sm-1 no-padding no-margin">
                <div class="remove btn btn-warning btn-sm"><i class="fa fa-trash">&nbsp;</i></div>
            </div>
        </div>
        @endforeach
        
       
    </div>

    <template class="{{$column}}-tpl">
        <div class="has-many-{{$column}}-form fields-group">
            {!! $template !!}

            <div class="form-group col-sm-1">
                <label class="{{$viewClass['label']}} control-label"></label>
                <div class="{{$viewClass['field']}}">
                    <div class="remove btn btn-warning btn-sm pull-right"><i class="fa fa-trash"></i>&nbsp;</div>
                </div>
            </div>
        </div>
    </template>

    <div class="form-group">
        <label class="{{$viewClass['label']}} control-label"></label>
        <div class="{{$viewClass['field']}}">
            <div class="add btn btn-success btn-sm"><i class="fa fa-save"></i>&nbsp;{{ trans('admin.new') }}</div>
        </div>
    </div>

</div>