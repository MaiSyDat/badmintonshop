<div class="prd-grid">
    @forelse ($products as $product)
        @php
            $variant = $product->variants->first();
            $discount = $variant->discount ?? 0;
            $basePrice = $product->base_price;

            $finalPrice = max(0, $basePrice - $discount); // không để âm
            $discountPercent = $basePrice > 0 ? round(($discount / $basePrice) * 100) : 0;
        @endphp
        <div class="prd-item">
            @if ($product->product_extend && $product->product_extend->is_premium)
                <div class="prd-premium-badge">Premium</div>
            @endif
            <a href="{{ route('product-detail', $product->product_id) }}">
                <img src="{{ asset($product->main_image_url) }}" alt="{{ $product->product_name }}" class="prd-item-image">
                <div class="prd-item-name">{{ $product->product_name }}</div>
                <div class="prd-item-price">{{ number_format($finalPrice, 0, ',', '.') }}₫</div>
            </a>
        </div>
    @empty
        <p>Không có sản phẩm nào phù hợp.</p>
    @endforelse
</div>

@if ($products->hasPages())
    <div class="pagination-wrapper" style="display: flex; justify-content: center; margin-top: 20px;">
        <ul style="display: flex; list-style: none; gap: 8px; padding: 0;">

            {{-- Nút quay lại --}}
            @if ($products->onFirstPage())
                <li style="padding: 5px 10px; border: 1px solid #ccc; color: #aaa;">&lt;</li>
            @else
                <li>
                    <a href="{{ $products->previousPageUrl() }}"
                        style="padding: 5px 10px; border: 1px solid #ccc; display: block;">&lt;</a>
                </li>
            @endif

            {{-- Hiển thị số trang --}}
            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                @if ($page == $products->currentPage())
                    <li style="padding: 5px 10px; background: #1976d2; color: white;">{{ $page }}</li>
                @elseif (
                    ($page <= $products->currentPage() + 1 && $page >= $products->currentPage() - 1) ||
                        $page == 1 ||
                        $page == $products->lastPage())
                    <li><a href="{{ $url }}"
                            style="padding: 5px 10px; border: 1px solid #ccc; display: block;">{{ $page }}</a>
                    </li>
                @elseif ($page == $products->currentPage() - 2 || $page == $products->currentPage() + 2)
                    <li>...</li>
                @endif
            @endforeach

            {{-- Nút tiếp theo --}}
            @if ($products->hasMorePages())
                <li>
                    <a href="{{ $products->nextPageUrl() }}"
                        style="padding: 5px 10px; border: 1px solid #ccc; display: block;">&gt;</a>
                </li>
            @else
                <li style="padding: 5px 10px; border: 1px solid #ccc; color: #aaa;">&gt;</li>
            @endif

        </ul>
    </div>
@endif
