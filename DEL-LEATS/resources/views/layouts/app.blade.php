<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'DEL-LEATS')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="font-sans antialiased bg-gray-50 text-black/50 min-h-screen flex flex-col">
        <header class="bg-white shadow">
            <nav aria-label="Navigasi utama" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <a href="{{ url('/') }}" class="text-lg font-semibold tracking-tight text-black">
                        DEL-LEATS
                    </a>
                    <div class="flex items-center gap-6">
                        <a href="{{ url('/') }}"
                           class="text-sm font-medium {{ request()->is('/') ? 'text-black font-semibold' : 'text-black/70' }} hover:text-black"
                           @if (request()->is('/')) aria-current="page" @endif>
                            Beranda
                        </a>
                        <a href="{{ url('/equipments') }}"
                           class="text-sm font-medium {{ request()->routeIs('equipments.index') || request()->routeIs('equipments.show') ? 'text-black font-semibold' : 'text-black/70' }} hover:text-black"
                           @if (request()->routeIs('equipments.index') || request()->routeIs('equipments.show')) aria-current="page" @endif>
                            Katalog Aset
                        </a>
                        <a href="{{ url('/equipments/create') }}"
                           class="text-sm font-medium {{ request()->routeIs('equipments.create') ? 'text-black font-semibold' : 'text-black/70' }} hover:text-black"
                           @if (request()->routeIs('equipments.create')) aria-current="page" @endif>
                            Tambah Aset
                        </a>
                        <a href="{{ url('/loans') }}"
                           class="text-sm font-medium {{ request()->routeIs('loans.*') ? 'text-black font-semibold' : 'text-black/70' }} hover:text-black"
                           @if (request()->routeIs('loans.*')) aria-current="page" @endif>
                            Riwayat Peminjaman
                        </a>
                    </div>
                </div>
            </nav>
        </header>

        <main id="content" class="flex-1 w-full">
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                @if (session('success'))
                    <section aria-live="polite" class="mb-6">
                        <article class="rounded-lg bg-green-50 ring-1 ring-green-200 p-4">
                            <p class="text-sm font-medium text-green-700">{{ session('success') }}</p>
                        </article>
                    </section>
                @endif

                <section>
                    <article>
                        @yield('content')
                    </article>
                </section>
            </section>
        </main>

        <footer>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-center text-sm text-black/50">
                <p>&copy; {{ date('Y') }} DEL-LEATS &mdash; Sistem Laboratorium Peminjaman Alat</p>
            </div>
        </footer>
    </body>
</html>
