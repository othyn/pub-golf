@extends ('layouts.master')

@section ('hero-content')

    <h1 class="title is-fancy-font is-size-0">{{ $game_name }}</h1>
    <h4 class="subtitle p-b-md">Keep your score &amp; see how the game's going...</h4>

@endsection

@section ('main-content')

    <div class="notification is-fancy-font is-primary">

        <p class="is-size-3">Currently on hole {{ $current_hole + 1 }}. You'll need to be at {{ $holes[$current_hole]['location'] }} and ordering {{ $holes[$current_hole]['drink'] }}.</p>

    </div>

    <div class="box content">

        <h2>Add Score</h2>

        <div class="field has-addons">

            <div class="control is-expanded">
                <input class="input is-medium" type="number" name="add-score" value="1" min="1" max="99">
                <p class="help">Enter the amount you did it in, the system will do the maths for you 😄</p>
            </div>

            <div class="control">
                <a id="add-score-btn" class="button is-medium is-info">Add score</a>
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

                        @foreach ($holes as $hole_order => $hole)

                            <th>
                                <abbr title="{{ $hole['location'] }}">{{ ++$hole_order }}</abbr>
                            </th>

                        @endforeach

                        <th>Totals</th>

                    </tr>

                    <tr>

                        <th><abbr title="Position">Pos</abbr></th>

                        <th>Par</th>

                        @foreach ($holes as $hole)

                            <th>{{ $hole['par'] }}</th>

                        @endforeach

                        <th>{{ $par_total }}</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($players as $position => $player)

                        <tr class="{{ $position == 0 ? 'is-selected' : '' }}">

                            <th>{{ ++$position }}</th>

                            <td>{{ $player['nickname'] }}</td>

                            @foreach ($player['scores'] as $score)

                                <td>{{ $score }}</td>

                            @endforeach

                            <td>{{ $player['score_total'] }}</td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

@endsection
