@foreach ($game->holes as $i => $hole)

    <tr id="{{ $hole->uuid }}">

        <td>{{ ++$i }}</td>
        <td>{{ $hole->location }}</td>
        <td>{{ $hole->drink }}</td>
        <td>{{ $hole->par }}</td>

        <td class="has-text-centered">
            <a class="button is-small is-info edit-hole-btn" data-game="{{ $game->code }}" data-hole="{{ $hole->uuid }}">
                <i class="fa fa-edit"></i>
            </a>
            <a class="button is-small is-danger delete-hole-btn" data-game="{{ $game->code }}" data-hole="{{ $hole->uuid }}">
                <i class="fa fa-trash"></i>
            </a>
            {{-- Implement  --}}
        </td>

    </tr>

@endforeach
