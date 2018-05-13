@if($renderStyle == \App\Models\CommonModel::RENDER_STYLE_ONLY_CONTROL)
<div class="{{$viewClass['form-group']}} {!! !$errors->has($errorKey) ? '' : 'has-error' !!}">

    <div class="{{$viewClass['field']}}">

        @include('admin::form.error')

        <div class="input-group">
            <input {!! $attributes !!} />
        </div>

        @include('admin::form.help-block')

    </div>
</div>
@else
<div class="{{$viewClass['form-group']}} {!! !$errors->has($errorKey) ? '' : 'has-error' !!}">
    @if($labelPosition == \App\Models\CommonModel::LABEL_POSITION_LEFT)
    <label for="{{$id}}" class="{{$viewClass['label']}} control-label">{{$label}}</label>
    @endif

    <div class="{{$viewClass['field']}}">
        @if($labelPosition == \App\Models\CommonModel::LABEL_POSITION_TOP)
        <label for="{{$id}}" class="{{$viewClass['label']}} control-label">{{$label}}</label>
        @endif

        @include('admin::form.error')

        <div class="input-group">

            @if ($prepend)
            
            @endif

            <input {!! $attributes !!} />

            @if ($append)
                <span class="input-group-addon clearfix">{!! $append !!}</span>
            @endif

            @if ($ajaxHtmlCssLoader)
                {!! $ajaxHtmlCssLoader !!}
            @endif
        </div>

        @include('admin::form.help-block')

    </div>
</div>
@endif