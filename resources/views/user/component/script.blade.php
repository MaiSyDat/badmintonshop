@if (isset($config['js']))
    @foreach ($config['js'] as $item)
        <script src="{{ $item }}"></script>
    @endforeach
@endif
