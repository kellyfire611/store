<div class="{{$viewClass['view']}}">
    <div class="form-float {{$viewClass['form-group']}} {!! !$errors->has($errorKey) ? '' : 'has-error' !!}">
        <div class="input-group date">
            @if ($prepend)
                <span class="input-group-addon">{!! $prepend !!}</span>
            @endif

            <div class="form-line">
                @include('admin::form.error')

                

                <input {!! $attributes !!} />

                

                @include('admin::form.help-block')

                <label for="{{$id}}" class="form-label">{{$label}}</label>
            </div>

            @if ($append)
                <span class="input-group-addon clearfix">{!! $append !!}</span>
            @endif
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker2'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker2').datetimepicker({
                    locale: 'ru'
                });
            });
        </script>
    </div>
</div>