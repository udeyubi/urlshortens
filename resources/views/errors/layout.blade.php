<!doctype html>
<html lang="en" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body class="d-flex h-100 text-center text-white bg-dark">
        <div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
            
            @yield('content')
            
            <footer class="mt-auto text-white-50">
                <p>© {{ config('app.name', 'Laravel') }} {{ date('Y') }}</p>
            </footer>
        </div>
    </body>
</html>
