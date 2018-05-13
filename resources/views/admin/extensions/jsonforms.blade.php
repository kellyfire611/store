<div class="form-group {!! !$errors->has($errorKey) ?: 'has-error' !!}">

    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>

    <div class="col-sm-6" id="{{$id}}">

        @include('admin::form.error')

        

        @include('admin::form.help-block')

    </div>
</div>
