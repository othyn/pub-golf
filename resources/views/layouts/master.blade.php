<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Othyn</title>

        <link rel="shortcut icon" href="favicon.ico">
        <link rel="stylesheet" href="{{ CDN::mix('/dist/css/app.css') }}">

    </head>

    <body>

        @yield ('content')

        <script src="{{ CDN::mix('/dist/js/manifest.js') }}"></script>
        <script src="{{ CDN::mix('/dist/js/vendor.js') }}"></script>
        <script src="{{ CDN::mix('/dist/js/app.js') }}"></script>

    </body>

</html>
