<input type="checkbox" class="grid-select-all" />&nbsp;

<div class="btn-group">
    <button type="button" class="btn btn-default waves-effect">{{ trans('admin.action') }}</button>
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="caret"></span>
        <span class="sr-only"></span>
    </button>
    <ul class="dropdown-menu">
        @foreach($actions as $action)
            <li><a href="#" class="grid-batch-{{ $action['id'] }}">{{ $action['title'] }}</a></li>
        @endforeach
    </ul>
</div>