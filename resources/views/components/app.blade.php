<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>{{ $title ?? 'Document' }}</title>
</head>

<body class="min-h-full flex flex-col items-center m-0">

    <header>
        <x-layouts.header />
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer>
        <x-layouts.footer />
    </footer>

</body>

</html>
