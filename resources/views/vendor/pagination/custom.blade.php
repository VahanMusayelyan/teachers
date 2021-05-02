
    @if ($paginator->hasPages() && $paginator->lastPage() > 1)
    <style>
        .pager{
            width: 50%;
            margin:0 auto;
        }
        .pager li{
            display: inline-block;
            margin-left: 12px;
            text-align: center;
            padding: 5px;
            border-radius: 25px;
        }
        </style>

        <ul class="pager">

            @if ($paginator->onFirstPage())
                <li class="disabled"><span><img src="/img/carousel-control-prev.svg"></span></li>
            @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><img src="/img/carousel-control-prev.svg"></a></li>
            @endif

            @foreach ($elements as $element)

                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                        <li class="active my-active" style="width: 41px;height: 40px;background: #FFFFFF 0% 0% no-repeat padding-box; box-shadow: 0px 0px 6px #FEC200;">{{ $page }}</li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><img src="/img/Arrow2.svg"></a></li>
            @else
                <li class="disabled"><span> <img src="/img/Arrow1.svg"></span></li>
            @endif
        </ul>
       @endif
