@if (isset($config['js']))
    @foreach ($config['js'] as $item)
        <script src="{{ $item }}"></script>
    @endforeach
@endif
<script src="../assets/js/page/product-detail.js"></script>
