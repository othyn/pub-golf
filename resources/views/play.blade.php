@extends ('layouts.master')

@section ('hero-content')

    <h1 class="title is-fancy-font is-size-0">{{ $game->name }}</h1>
    <h4 class="subtitle p-b-md">Let's see how the game's going...</h4>

@endsection

@section ('main-content')

    @if (session('player_id') == $game->adminPlayer()->id)

        <a href="/games/{{ $game->code }}/edit" class="button is-large is-fullwidth is-info m-b-lg">Edit game</a>
        <!-- TODO: Push to top right of page, in nav style -->

    @endif

    <div class="notification is-primary">

        <h2 class="is-fancy-font is-size-3">We're at <span id="game-location">{{ $game->activeHole()->location }}</span>!</h2>
        <p>Get the round in for <strong id="game-drink">{{ $game->activeHole()->drink }}</strong></p>

    </div>

    <div class="box content">

        <h2>Add Score</h2>

        <div class="field has-addons">

            <div class="control is-expanded">
                <input class="input is-medium" type="number" name="score" value="{{ $game->activeHole()->par }}">
                <p class="help">Enter the amount you did it in, between 0 and 99, the system will do the golf maths for you 😄</p>
            </div>

            <div class="control">
                <button type="button" id="submit-score-btn" class="button is-medium is-info" data-game="{{ $game->code }}" data-player="{{ $player->uuid }}">Submit score</button>
            </div>

        </div>

    </div>

    <div class="box">

        <span class="content">

            <h2>Leaderboard</h2>

        </span>

        <div class="table-mobile">

            <table class="table is-striped is-fullwidth">

                <thead>
                    <tr>

                        <td></td>

                        <th>Hole</th>

                        @foreach ($game->holes as $i => $hole)

                            <th>
                                <abbr title="{{ $hole->location }}">{{ ++$i }}</abbr>
                            </th>

                        @endforeach

                        <th>Totals</th>

                    </tr>

                    <tr>

                        <th><abbr title="Position">Pos</abbr></th>

                        <th>Par</th>

                        @foreach ($game->holes as $hole)

                            <th>{{ $hole->par }}</th>

                        @endforeach

                        <th>{{ $game->holes->sum('par') }}</th>

                    </tr>

                </thead>

                <tbody>

                    <!-- TODO: This needs sorting by SUM ASC -->

                    @foreach ($game->players as $i => $player)

                        <tr class="{{ $i == 0 ? 'is-selected' : '' }}">

                            <th>{{ ++$i }}</th>

                            <td>{{ $player->name }}</td>

                            @foreach ($player->scores as $score)

                                @if ($game->activeHole()->id == $score->hole_id)

                                    <td id="active-score">{{ $score->score }}</td>

                                @else

                                    <td>{{ $score->score }}</td>

                                @endif

                            @endforeach

                            @if (session('player_id') == $player->id)

                                <td id="total-score">{{ $player->scores->sum('score') }}</td>

                            @else

                                <td>{{ $player->scores->sum('score') }}</td>

                            @endif

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

@endsection
