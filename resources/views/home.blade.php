@extends ('layouts.master')

@section ('hero-size', 'is-fullheight')

@section ('hero-content')

    <h1 class="title is-fancy-font is-size-0">Time to tee off!</h1>
    <h4 class="subtitle p-b-md">To begin, create or join a game...</h4>

    <div class="tile is-ancestor reverse-row">

        <div class="tile is-parent is-6">

            <div class="tile is-child box content">

                <h2 class="is-fancy-font is-size-3">Join Game</h2>

                <p>Join game. Get bevs. Have a laugh!</p>

                <form method="POST" action="/play">

                    @csrf

                    <div class="field">
                        <div class="control has-icons-left">
                            <input class="input is-medium" type="text" name="organiser_name" placeholder="Your nickname" maxlength="50" required>
                            <span class="icon is-small is-left">
                                <i class="fa fa-user fa-xs"></i>
                            </span>
                        </div>
                    </div>

                    <div class="field">
                        <div class="control has-icons-left">
                            <input class="input is-medium" type="text" name="game_code" placeholder="ABCDEFG" maxlength="7" required>
                            <span class="icon is-small is-left">
                                <i class="fa fa-hashtag fa-xs"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="button is-info is-medium is-fullwidth">Join</button>

                </form>

            </div>

        </div>

        <div class="tile is-parent is-6">

            <div class="tile is-child box content">

                <h2 class="is-fancy-font is-size-3">New Game</h2>

                <p>Create game. Invite friends. Get bevs. Have a laugh!</p>

                <form method="POST" action="/manage">

                    @csrf

                    <div class="field">
                        <div class="control has-icons-left">
                            <input class="input is-medium" type="text" name="game_name" placeholder="Game name" maxlength="50" required>
                            <span class="icon is-small is-left">
                                <i class="fa fa-beer fa-xs"></i>
                            </span>
                        </div>
                    </div>

                    <div class="field">
                        <div class="control has-icons-left">
                            <input class="input is-medium" type="text" name="organiser_name" placeholder="Your nickname" maxlength="50" required>
                            <span class="icon is-small is-left">
                                <i class="fa fa-user fa-xs"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="button is-primary is-medium is-fullwidth">Create</button>

                </form>

            </div>

        </div>

    </div>

@endsection
