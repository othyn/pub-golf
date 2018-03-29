@foreach ($game->players as $player)

    <tr>

        <td>{{ $player->name }}</td>

        <td class="has-text-centered">
            <a class="button is-small is-warning penalise-player-btn" data-game="{{ $game->code }}" data-player="{{ $player->uuid }}" data-name="{{ $player->name }}">
                <i class="fa fa-flag"></i>
            </a>

            @if (!$player->is_admin)

                <a class="button is-small is-danger delete-player-btn" data-game="{{ $game->code }}" data-player="{{ $player->uuid }}" data-name="{{ $player->name }}">
                    <i class="fa fa-trash"></i>
                </a>
                {{-- Implement  --}}

            @endif

        </td>

    </tr>

@endforeach
