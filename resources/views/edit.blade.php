@extends ('layouts.master')

@section ('hero-content')

    <h1 class="title is-fancy-font is-size-0">Edit {{ $game->name }}</h1>
    <h4 class="subtitle p-b-md">To invite people to play, send them the code below...</h4>

    <div class="box">

        <div class="field has-addons">

            <div class="control is-expanded has-icons-left">
                <input class="input is-medium" type="text" name="code" value="{{ $game->code }}" readonly>
                <span class="icon is-small is-left">
                    <i class="fa fa-hashtag fa-xs"></i>
                </span>
            </div>

            <div class="control">
                <a id="code-btn" class="button is-medium is-info">Copy link</a>
            </div>

        </div>

    </div>

@endsection

@section ('main-content')

    <a href="/games/{{ $game->code }}/play" class="button is-large is-fullwidth is-primary m-b-lg">Play game</a>
    <!-- TODO: Push to top right of page, in nav style -->

    <div class="box content">

        <h2>Active Hole</h2>

        <p>Set the current active hole for all players. This is what all the scores will then be placed against that they submit, and the information on their score card will reflect the hole information.</p>

        <hr class="is-dashed">

        <a id="active-hole-btn" class="button is-medium is-primary is-fullwidth" data-game="{{ $game->code }}">Set active hole</a>

        <section id="swal-active-hole-content-template" style="display: none">

            <form class="active-hole">

                <div class="field is-horizontal">

                    <div class="field-label is-normal">
                        <label class="label">Hole</label>
                    </div>

                    <div class="field-body">
                        <div class="field">

                            <p class="control is-expanded has-icons-left">

                                <span class="select is-fullwidth">
                                    <select name="active_hole">

                                        @foreach ($game->holes as $hole)

                                            <option value="{{ $hole->uuid }}">
                                                {{ $hole->location }} - {{ $hole->drink }} - {{ $hole->par }}
                                            </option>

                                        @endforeach

                                    </select>
                                </span>

                                <span class="icon is-small is-left">
                                    <i class="fa fa-flag"></i>
                                </span>

                            </p>

                        </div>
                    </div>

                </div>

            </form>

        </section>

    </div>

    <div class="box content">

        <h2>General Bits</h2>

        <p>Stuff for the game itself. Bits like name, number of players, etc...</p>

        <hr class="is-dashed">

        <a id="edit-game-btn" class="button is-medium is-primary is-fullwidth">Edit game</a>

        <section id="swal-edit-game-content-template" style="display: none">

            <form class="edit-game">

                <div class="field is-horizontal">

                    <div class="field-label is-normal">
                        <label class="label has-nowrap">Game Name</label>
                    </div>

                    <div class="field-body">
                        <div class="field">

                            <div class="control is-expanded has-icons-left">
                                <input class="input" type="text" name="name" value="{{ $game->name }}" placeholder="Pub Golf #1" minlength="5" maxlength="50" required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-beer fa-xs"></i>
                                </span>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="field is-horizontal">

                    <div class="field-label is-normal">
                        <label class="label has-nowrap">Max Players</label>
                    </div>

                    <div class="field-body">
                        <div class="field">

                            <div class="control is-expanded has-icons-left">
                                <input class="input" type="number" name="max_players" value="{{ $game->max_players }}" min="1" max="100" required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-users fa-xs"></i>
                                </span>
                            </div>

                        </div>
                    </div>

                </div>

            </form>

        </section>

    </div>

    <div class="box content">

        <h2>Holes</h2>

        <p>These will be the places you want to go, what you want to drink and the par scores for them.</p>

        <hr class="is-dashed">

        <table class="table is-striped is-fullwidth">

            <thead>
                <tr>
                    <th>Hole</th>
                    <th>Location</th>
                    <th>Drink</th>
                    <th>Par</th>
                    <th class="has-text-centered"><i class="fa fa-wrench"></i></th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th colspan="4"></th>
                    <th class="has-text-centered">
                        <a id="create-hole-btn" class="button is-primary is-small">New hole</a>
                    </th>
                </tr>
            </tfoot>

            <tbody>

                @foreach ($game->holes as $i => $hole)

                    <tr>

                        <td>{{ ++$i }}</td>
                        <td>{{ $hole->location }}</td>
                        <td>{{ $hole->drink }}</td>
                        <td>{{ $hole->par }}</td>

                        <td class="has-text-centered">
                            <a class="button is-small is-info edit-hole-btn" data-ref="{{ $hole->uuid }}" data-location="{{ $hole->location }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a class="button is-small is-danger delete-hole-btn" data-ref="{{ $hole->uuid }}" data-location="{{ $hole->location }}">
                                <i class="fa fa-trash"></i>
                            </a>
                            {{-- Implement  --}}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

        <section id="swal-hole-content-template" style="display: none">

            {{-- Create JSON of holes for modal loading? --}}

            <form class="hole-edit">

                <div class="field is-horizontal">

                    <div class="field-label is-normal">
                        <label class="label">Location</label>
                    </div>

                    <div class="field-body">
                        <div class="field">

                            <div class="control is-expanded has-icons-left">
                                <input class="input" type="text" name="hole_location" value="" required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-map-marker fa-xs"></i>
                                </span>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="field is-horizontal">

                    <div class="field-label is-normal">
                        <label class="label">Drink</label>
                    </div>

                    <div class="field-body">
                        <div class="field">

                            <div class="control is-expanded has-icons-left">
                                <input class="input" type="text" name="hole_drink" value="" required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-beer fa-xs"></i>
                                </span>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="field is-horizontal">

                    <div class="field-label is-normal">
                        <label class="label">Par</label>
                    </div>

                    <div class="field-body">
                        <div class="field">

                            <div class="control is-expanded has-icons-left">
                                <input class="input" type="number" name="hole_par" value="5" min="1" max="100" required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-star fa-xs"></i>
                                </span>
                            </div>

                        </div>
                    </div>

                </div>

            </form>

        </section>

    </div>

    <div class="box content">

        <h2>Players</h2>

        <p>These are the players currently playing in the game.</p>

        <hr class="is-dashed">

        <table class="table is-striped is-fullwidth">

            <thead>
                <tr>
                    <th>Name</th>
                    <th class="has-text-centered"><i class="fa fa-wrench"></i></th>
                </tr>
            </thead>

            <tbody>

                @foreach ($game->players as $player)

                    <tr>

                        <td>{{ $player->name }}</td>

                        <td class="has-text-centered">
                            <a class="button is-small is-warning penalise-player-btn" data-ref="{{ $player->uuid }}" data-name="{{ $player->name }}">
                                <i class="fa fa-flag"></i>
                            </a>
                            <a class="button is-small is-danger delete-player-btn" data-ref="{{ $player->uuid }}" data-name="{{ $player->name }}">
                                <i class="fa fa-trash"></i>
                            </a>
                            {{-- Implement  --}}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

        <section id="swal-player-content-template" style="display: none">

            <form class="player-penalise">

                <div class="field is-horizontal">

                    <div class="field-label is-normal">
                        <label class="label">Points</label>
                    </div>

                    <div class="field-body">
                        <div class="field">

                            <div class="control is-expanded has-icons-left">
                                <input class="input" type="number" name="penalise_points" value="2" min="1" max="100" required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-plus fa-xs"></i>
                                </span>
                                <p class="help">Highest score loses, so get adding points!</p>
                            </div>

                        </div>
                    </div>

                </div>

            </form>

        </section>

    </div>

@endsection
