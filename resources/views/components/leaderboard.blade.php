<div class="box">

    <span class="content">

        <h2>Leaderboard</h2>

    </span>

    <div class="table-mobile">

        <table class="table is-striped is-fullwidth">

            <thead>
                <tr>

                    <th>Hole</th>

                    @foreach ($game->holes as $i => $hole)

                        <th>
                            <abbr title="{{ $hole->location }}">{{ ++$i }}</abbr>
                        </th>

                    @endforeach

                    <th>Totals</th>

                </tr>

                <tr>

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

                        <td>{{ $player->name }}</td>

                        @foreach ($player->scores as $scoreCount => $score)

                            <td>{{ $score->score }}</td>

                        @endforeach

                        @if ($player->scores->count() < $game->holes->count())

                            @for ($j = 0; $j < ($game->holes->count() - $player->scores->count()); ++$j)

                                <td>0</td>

                            @endfor

                        @endif

                        {{-- This solution actually makes me a little queasy, but it works for now, just pads the table cells --}}

                        <td>{{ $player->scores->sum('score') }}</td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

    <small style="font-style:italic">Next refresh in <span id="refresh-counter">30</span> seconds</small>

</div>
