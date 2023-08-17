@foreach ($elements as $element)
    <div class="row">
        <div class="col-lg-12">
            <div class="product__pagination">
                @if (is_string($element))
                    <a class="active" href="#">{{ $element }}</a>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a class="active" href="#">{{ $page }}</a>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endforeach
