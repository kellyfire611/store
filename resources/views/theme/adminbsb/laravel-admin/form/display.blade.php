<div class="{{$viewClass['field']}}">
    <div class="form-float {{$viewClass['form-group']}}">
        <div class="form-line focused">

            <input type="text" id="" name="" value="{!! $value !!}" class="form-control" disabled>
            @include('admin::form.help-block')

            <label for="{{$id}}" class="form-label">{{$label}}</label>
        </div>
    </div>
</div>