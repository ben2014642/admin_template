@if (isset($breadcrums))
    <div class="page-header d-print-none">
        <div class="container">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            @foreach ($breadcrums as $item)
                                @if (!$loop->last)
                                    <li class="breadcrumb-item">
                                        @if (isset($item['url']))
                                            <a href="{{ $item['url'] }}" class="text-muted">{{ $item['label'] }}</a>
                                        @else
                                            <span class="text-muted">{{ $item['label'] }}</span>

                                        @endif
                                    </li>
                                @else
                                    <li class="breadcrumb-item active" aria-current="page">{{ $item['label'] }} </li>
                                @endif
                            @endforeach
                                <span class="text">  / {{ $posts->danhmuc[0]->name }}</span>

                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endif
