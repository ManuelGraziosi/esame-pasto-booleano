<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    {{-- cosi importo bootstrap --}}
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body>
    <x-header></x-header>
    <div class="container">


        @yield('content')

    </div>
</body>

</html>
