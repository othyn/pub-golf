@if ($flash = session('message.info'))

    <div class="notification is-info content">

        {{ $flash }}

    </div>

@endif
