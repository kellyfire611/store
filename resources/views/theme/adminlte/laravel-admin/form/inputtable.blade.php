@if($renderStyle == \App\Models\CommonModel::RENDER_STYLE_ONLY_CONTROL)
<td class="{{$viewClass['form-group']}} {!! !$errors->has($errorKey) ? '' : 'has-error' !!}">

    <div class="{{$viewClass['field']}}">

        @include('admin::form.error')

        <div class="input-group">
            <input {!! $attributes !!} />
        </div>

        @include('admin::form.help-block')

    </div>
</td>
@else
<td class="{{$viewClass['form-group']}} {!! !$errors->has($errorKey) ? '' : 'has-error' !!}">

    <label for="{{$id}}" class="{{$viewClass['label']}} control-label">{{$label}}</label>

    <div class="{{$viewClass['field']}}">

        @include('admin::form.error')

        <div class="input-group">

            @if ($prepend)
            <span class="input-group-addon">{!! $prepend !!}</span>
            @endif

            <input {!! $attributes !!} />

            @if ($append)
                <span class="input-group-addon clearfix">{!! $append !!}</span>
            @endif

        </div>

        @include('admin::form.help-block')

    </div>
</td>
@endif