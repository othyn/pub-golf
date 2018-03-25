@extends ('layouts.master')

@section ('content')

    <section class="hero is-info is-bold">

        @include ('layouts.nav')

        <div class="hero-body">

            <div class="container">

                <h1 class="title is-fancy-font is-size-0">Play time</h1>
                <h4 class="subtitle p-b-md">To invite people, send them the code below...</h4>

                <div class="box">

                    <div class="field has-addons">

                        <div class="control is-expanded has-icons-left">
                            <input name="game-code" class="input is-medium" type="text" value="{{ $game_code }}" readonly>
                            <span class="icon is-small is-left">
                                <i class="fa fa-hashtag fa-xs"></i>
                            </span>
                        </div>

                        <div class="control">
                            <a id="game-code-btn" class="button is-medium is-info">Copy</a>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <section class="section">

        <div class="container">

            <div class="notification is-fancy-font is-primary">

                <p class="is-size-3">Currently at {{ $holes[$current_hole]['name'] }}, on hole {{ ++$current_hole }}</p>
                {{-- Future self: Value for current_hole incremented for all code below. Blame laziness. --}}

            </div>

            <div class="box content">

                <h2 class="box-title">Add Score</h2>

                <div class="field has-addons">

                    <div class="control is-expanded">
                        <input name="add-score" class="input is-medium" type="number" value="1" min="1" max="99">
                        <p class="help">Enter the amount you did it in, the system will do the maths for you 😄</p>
                    </div>

                    <div class="control">
                        <a id="add-score-btn" class="button is-medium is-info">Add</a>
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
                                        <abbr title="{{ $hole['name'] }}">{{ ++$hole_order }}</abbr>
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

        </div>

    </section>

@endsection
