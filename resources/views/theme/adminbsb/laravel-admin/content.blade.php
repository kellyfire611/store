@extends('admin::index')

@section('content')
    <div class="container-fluid" ng-controller="{{ $controller }}">
        <div class="block-header">
            {{ $header or trans('admin.title') }}
            <small>{{ $description or trans('admin.description') }}</small>
        </div>

        <div>
            <!-- breadcrumb start -->
            @if ($breadcrumb)
            <ol class="breadcrumb" style="margin-right: 30px;">
                <li><a href="{{ admin_url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                @foreach($breadcrumb as $item)
                    @if($loop->last)
                        <li class="active">
                            @if (array_has($item, 'icon'))
                                <i class="fa fa-{{ $item['icon'] }}"></i>
                            @endif
                            {{ $item['text'] }}
                        </li>
                    @else
                    <li>
                        <a href="{{ admin_url(array_get($item, 'url')) }}">
                            @if (array_has($item, 'icon'))
                                <i class="fa fa-{{ $item['icon'] }}"></i>
                            @endif
                            {{ $item['text'] }}
                        </a>
                    </li>
                    @endif
                @endforeach
            </ol>
            @endif
            <!-- breadcrumb end -->
        </div>

        <div>
            
            @include('admin::partials.error')
            @include('admin::partials.success')
            @include('admin::partials.exception')
            @include('admin::partials.toastr')

            {!! $content !!}

        </div>
    </div>
@endsection