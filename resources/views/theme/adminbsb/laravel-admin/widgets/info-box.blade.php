<div {!! $attributes !!}>
    <div class="icon">
        <a href="{{ $link }}">
            <i class="material-icons">{{ $icon }}</i>
        </a>
    </div>
    <div class="content">
        <div class="text">{{ $name }}</div>
        <div class="number count-to" data-from="0" data-to="{{ $info }}" data-speed="15" data-fresh-interval="20"></div>
    </div>
</div>