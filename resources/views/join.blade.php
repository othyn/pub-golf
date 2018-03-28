@extends ('layouts.master')

@section ('hero-size', 'is-fullheight')

@section ('hero-content')

    <h1 class="title is-fancy-font is-size-0">Join a game</h1>
    <h4 class="subtitle p-b-md">Enter a nickname and get playing!</h4>

    <div class="tile is-child box content">

        <h2 class="is-fancy-font is-size-3">Join Game</h2>

        <p>Join game. Get bevs. Have a laugh!</p>

        @include ('layouts.errors')

        <form method="POST" action="/games/{{ $game->code }}/join">

            @csrf

            <div class="field">
                <div class="control has-icons-left">
                    <input class="input is-medium" type="text" name="name" placeholder="Your nickname" minlength="1" maxlength="50" required autocomplete="off">
                    <span class="icon is-small is-left">
                        <i class="fa fa-user fa-xs"></i>
                    </span>
                </div>
            </div>

            <div class="field">
                <div class="control has-icons-left">
                    <input class="input is-medium" type="text" value="{{ $game->code }}" disabled>
                    <span class="icon is-small is-left">
                        <i class="fa fa-hashtag fa-xs"></i>
                    </span>
                </div>
            </div>

            <button type="submit" class="button is-info is-medium is-fullwidth">Join</button>

        </form>

    </div>

@endsection
