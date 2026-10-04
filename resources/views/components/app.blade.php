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

<body>


    <div class="flex flex-col min-h-screen">
        <nav class="fixed inset-x-0 top-0 z-50 rounded-b-xl bg-nav shadow-sm overflow-x-auto">
            <div class="flex w-max min-w-full justify-start">
                <x-menu.sidebar-component />
            </div>
        </nav>

        <div class="flex justify-center">
            <x-layouts.header />
        </div>

        <main class="flex-1 w-full mx-auto max-w-screen-xl px-1 sm:px-2 md:px-2 pb-10">
            <div class="max-w-screen-xl mx-auto p-5 sm:p-5 md:p-5">
                {{ $slot }}
            </div>
        </main>


        <div class="fixed bottom-0 left-0 right-0 z-50 flex justify-between rounded-t-xl bg-nav shadow-sm">
            <x-menu.bottom-navigation-component />
        </div>
    </div>

</body>

</html>
