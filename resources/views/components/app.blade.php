<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://telegram.org/js/telegram-web-app.js"></script>

    <title>{{ $title ?? 'ЖИВА' }}</title>
</head>

<body class="min-h-full flex flex-col items-center m-0">

    <header>
        <x-layouts.header />
    </header>

    <nav>
        <x-menu.sidebar-component />
    </nav>

    <main class="mb-[36px]">
        {{ $slot }}
    </main>

    <footer>
        <x-layouts.footer />
    </footer>

</body>

</html>
