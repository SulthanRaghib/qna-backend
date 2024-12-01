@if ($paginator->hasPages())
    <div class="pagination-container">
        <div class="pagination-info">
            <!-- Menampilkan informasi jumlah item -->
            {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} of {{ $paginator->total() }}
        </div>

        <div class="pagination-links">
            <!-- Tombol Previous -->
            @if ($paginator->onFirstPage())
                <span class="disabled"><i class="bi bi-chevron-left"></i></span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="bi bi-chevron-left"></i></a>
            @endif

            {{-- <!-- Tombol Halaman -->
            @foreach ($elements as $element)
                <!-- Tanda "..." -->
                @if (is_string($element))
                    <span class="dots">{{ $element }}</span>
                @endif

                <!-- Link ke Halaman -->
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach --}}

            <!-- Tombol Next -->
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="bi bi-chevron-right"></i></a>
            @else
                <span class="disabled"><i class="bi bi-chevron-right"></i></span>
            @endif
        </div>
    </div>
@endif

<style>
    .pagination-container {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-end;
        gap: 8px;
    }

    .pagination-info {
        font-size: 14px;
        color: #555;
    }

    .pagination-links {
        display: flex;
        gap: 8px;
        font-size: 14px;
    }

    .pagination-links a {
        padding: 4px 8px;
        text-decoration: none;
        border-radius: 4px;
        color: #333;
    }

    .pagination-links .active {
        padding: 4px 8px;
        background-color: #007bff;
        border: 1px solid #007bff;
        border-radius: 4px;
        color: #fff;
        font-weight: bold;
    }

    .pagination-links .disabled {
        padding: 4px 8px;
        color: #999;
        border-radius: 4px;
    }
</style>
