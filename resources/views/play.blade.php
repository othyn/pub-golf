@extends ('layouts.master')

@section ('hero-content')

    <h1 class="title is-fancy-font is-size-0">{{ $game->name }}</h1>
    <h4 class="subtitle p-b-md">Let's see how the game's going...</h4>

@endsection

@section ('main-content')

    @if (session('player_id') == $player->id)

        <a href="/game/edit/{{ $game->code }}" class="button is-large is-fullwidth is-info m-b-lg">Edit game</a>
        <!-- TODO: Push to top right of page, in nav style -->

    @endif

    <div class="notification is-primary">

        <h2 class="is-fancy-font is-size-3">We're at {{ $game->activeHole()->location }}!</h2>
        <p>Get the round in for <b>{{ $game->activeHole()->drink }}</b></p>

    </div>

    <div class="box content">

        <h2>Add Score</h2>

        <div class="field has-addons">

            <div class="control is-expanded">
                <input class="input is-medium" type="number" name="add-score" value="1" min="1" max="99">
                <p class="help">Enter the amount you did it in, the system will do the golf maths for you 😄</p>
            </div>

            <div class="control">
                <a id="add-score-btn" class="button is-medium is-info">Add / Change score</a>
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

                                <td>{{ $score }}</td>

                            @endforeach

                            <td>{{ $player->scores->sum('score') }}</td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

@endsection
