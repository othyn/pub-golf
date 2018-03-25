@extends ('layouts.master')

@section ('content')

    <section class="hero is-info is-bold is-fullheight">

        @include ('layouts.nav')

        <div class="hero-body">

            <div class="container">

                <h1 class="title is-fancy-font is-size-0">Time to tee off!</h1>
                <h4 class="subtitle p-b-md">To begin, create or join a game...</h4>

                <div class="tile is-ancestor reverse-row-mobile">

                    <div class="tile is-parent is-6">

                        <div class="tile is-child box content">

                            <h2 class="box-title fancy-font is-size-3">New Game</h2>

                            <p>Create game. Invite friends. Get bevs. Have a laugh!</p>

                            <form method="post" action="/game">

                                <div class="field">
                                    <div class="control has-icons-left has-icons-right">
                                        <input class="input is-medium" type="text" name="game_name" placeholder="Game name" maxlength="50">
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-beer fa-xs"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="control has-icons-left has-icons-right">
                                        <input class="input is-medium" type="text" name="organiser_name" placeholder="Your name, e.g. Keginator" maxlength="50">
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-user fa-xs"></i>
                                        </span>
                                    </div>
                                </div>

                                <button type="submit" class="button is-primary is-medium is-fullwidth">Create</button>

                            </form>

                        </div>

                    </div>

                    <div class="tile is-parent is-6">

                        <div class="tile is-child box content">

                            <h2 class="box-title fancy-font is-size-3">Join Game</h2>

                            <p>Want to join a friend? Get them to send you their game code and enter it below.</p>

                            <div class="field">
                                <div class="control has-icons-left has-icons-right">
                                    <input class="input is-medium" type="email" placeholder="ABCDEFG" maxlength="7">
                                    <span class="icon is-small is-left">
                                        <i class="fa fa-hashtag fa-xs"></i>
                                    </span>
                                </div>
                            </div>

                            <button type="submit" class="button is-info is-medium is-fullwidth">Join</button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection
