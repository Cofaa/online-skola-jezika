<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online škola jezika</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900">
<header class="border-b">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="h-9 w-9 rounded-xl bg-gray-900"></div>
            <div class="font-semibold">Online škola jezika</div>
        </div>

        @if (Route::has('login'))
            <nav class="flex items-center gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 rounded border hover:bg-gray-50">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded border hover:bg-gray-50">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 rounded bg-gray-900 text-white hover:bg-gray-800">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </div>
</header>

<main>
    <section class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid lg:grid-cols-2 gap-10 items-center">
            <div>
                <p class="text-sm font-medium text-gray-600">Uči srpski online</p>
                <h1 class="mt-3 text-4xl lg:text-5xl font-bold leading-tight">
                    Privatni časovi srpskog jezika – jednostavno, jasno i praktično.
                </h1>
                <p class="mt-4 text-lg text-gray-600">
                    Kurs po nivou (A1–C2), rad 1-na-1 sa predavačem, termin koji ti odgovara i jasna evidencija časova.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('register') }}" class="px-5 py-3 rounded bg-gray-900 text-white hover:bg-gray-800">
                        Počni sada
                    </a>
                    <a href="{{ route('login') }}" class="px-5 py-3 rounded border hover:bg-gray-50">
                        Imam nalog
                    </a>
                </div>

                <div class="mt-8 grid grid-cols-3 gap-4 text-sm">
                    <div class="p-4 rounded-xl bg-gray-50 border">
                        <div class="font-semibold">A1–C2</div>
                        <div class="text-gray-600">nivoi</div>
                    </div>
                    <div class="p-4 rounded-xl bg-gray-50 border">
                        <div class="font-semibold">1-na-1</div>
                        <div class="text-gray-600">rad sa predavačem</div>
                    </div>
                    <div class="p-4 rounded-xl bg-gray-50 border">
                        <div class="font-semibold">Online</div>
                        <div class="text-gray-600">termini po dogovoru</div>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border bg-gray-50 p-8">
                <div class="text-sm text-gray-600">Kako funkcioniše</div>
                <ol class="mt-4 space-y-4">
                    <li class="flex gap-3">
                        <div class="h-8 w-8 rounded-full bg-gray-900 text-white flex items-center justify-center text-sm">1</div>
                        <div>
                            <div class="font-semibold">Registruj se kao student</div>
                            <div class="text-gray-600 text-sm">Napravi nalog i uđi u student dashboard.</div>
                        </div>
                    </li>
                    <li class="flex gap-3">
                        <div class="h-8 w-8 rounded-full bg-gray-900 text-white flex items-center justify-center text-sm">2</div>
                        <div>
                            <div class="font-semibold">Izaberi termin</div>
                            <div class="text-gray-600 text-sm">Pregledaj dostupne časove i rezerviši.</div>
                        </div>
                    </li>
                    <li class="flex gap-3">
                        <div class="h-8 w-8 rounded-full bg-gray-900 text-white flex items-center justify-center text-sm">3</div>
                        <div>
                            <div class="font-semibold">Uči i prati napredak</div>
                            <div class="text-gray-600 text-sm">Sve rezervacije i statusi su vidljivi u aplikaciji.</div>
                        </div>
                    </li>
                </ol>

                <div class="mt-8 p-4 rounded-xl bg-white border">
                    <div class="font-semibold">Demo nalog</div>
                    <div class="text-gray-600 text-sm mt-1">
                        Uloguj se i vidi dashboard: <span class="font-mono">password</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="border-t">
        <div class="max-w-7xl mx-auto px-6 py-8 text-sm text-gray-600 flex flex-col md:flex-row gap-2 md:items-center md:justify-between">
            <div>© {{ date('Y') }} Online škola jezika</div>
            <div class="flex gap-4">
                <a class="hover:underline" href="{{ route('login') }}">Login</a>
                <a class="hover:underline" href="{{ route('register') }}">Register</a>
            </div>
        </div>
    </footer>
</main>
</body>
</html>
