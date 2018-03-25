@extends ('layouts.master')

@section ('hero-content')

    <h1 class="title is-fancy-font is-size-0">Manage game</h1>
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

@endsection

@section ('main-content')



@endsection
