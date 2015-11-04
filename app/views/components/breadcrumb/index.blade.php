<div class="row">
    <div class="col-sm-12 text-center-sm">
        <ol class="breadcrumb">
            @foreach ($breadcrumb->links as $link)
                <li>
                    @if (isset($link['icon']))
                        <i class="fa fa-fw {{ $link['icon'] }}"></i>
                    @endif
                    <a href="{{ route($link['route'], $link['params']) }}">{{ $link['text'] }}</a>
                </li>
            @endforeach
            @if (isset($breadcrumb->currentPage['icon']))
                <i class="fa fa-fw {{ $breadcrumb->currentPage['icon'] }}"></i>
            @endif
            <li class="active">{{ $breadcrumb->currentPage['text'] }}</li>
        </ol>
    </div>
</div>