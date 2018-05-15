<div class="{{$viewClass['view']}}">
    <div class="form-float {{$viewClass['form-group']}} {!! !$errors->has($errorKey) ? '' : 'has-error' !!}">
            
            <div class="form-line">
                @include('admin::form.error')

                

                <input {!! $attributes !!} />

                

                @include('admin::form.help-block')

                <label for="{{$id}}" class="form-label">{{$label}}</label>
            </div>

        </div>
</div>