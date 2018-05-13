@if(Admin::user()->visible($item['roles']))
    @if(!isset($item['children']))
        <li>
            @if(url()->isValidUrl($item['uri']))
                <a href="{{ $item['uri'] }}" target="_blank">
            @else
                 <a href="{{ admin_base_path($item['uri']) }}">
            @endif
                <i class="material-icons">{{$item['icon']}}</i>
                <span>{{$item['title']}}</span>
            </a>
        </li>
    @else
        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">{{$item['icon']}}</i>
                <span>{{$item['title']}}</span>
                
            </a>
            <ul class="ml-menu">
                @foreach($item['children'] as $item)
                    @include('admin::partials.menu', $item)
                @endforeach
            </ul>
        </li>
    @endif
@endif