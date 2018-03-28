@if ($flash = session('message.warning'))

    <div class="notification is-warning content">

        {{ $flash }}

    </div>

@endif
