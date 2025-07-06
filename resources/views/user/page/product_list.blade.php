<div class="prd-grid">
    @forelse ($products as $product)
        <div class="prd-item">
            @if ($product->product_extend && $product->product_extend->is_premium)
                <div class="prd-premium-badge">Premium</div>
            @endif
            <a href="{{ route('product-detail', $product->product_id) }}">
                <img src="{{ asset($product->main_image_url) }}" alt="{{ $product->product_name }}" class="prd-item-image">
                <div class="prd-item-name">{{ $product->product_name }}</div>
                <div class="prd-item-price">{{ number_format($product->base_price, 0, ',', '.') }} đ</div>
            </a>
        </div>
    @empty
        <p>Không có sản phẩm nào phù hợp.</p>
    @endforelse
</div>

@if ($products->hasPages())
    <div class="pagination-wrapper">
        {!! $products->withQueryString()->links() !!}
    </div>
@endif
