<footer class="main-footer">

    @if (isset($settingsfields['footer_text']))
        <strong>{{ $settingsfields['footer_text'] }}</strong>
    @else
        <strong>Footer text</strong>
    @endif

</footer>
