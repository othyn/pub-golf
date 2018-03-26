@if (count($errors))

    <div class="notification is-danger">

        There appears to be a few errors... 😭

        <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif
