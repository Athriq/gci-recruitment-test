<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @hasSection('title')
    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>
    @else
    <title>{{ config('app.name', 'Laravel') }}</title>
    @endif
    @vite('resources/css/app.css')
</head>
<body>
    <nav class="py-4 bg-emerald-300">
        <div class="flex flex-row text-white dark:text-gray-200 mx-auto px-8 items-center justify-between">
            <a class="text-2xl font-bold text-emerald-100" href="/">{{ config('app.name') }} (GCI Recruitment Test)</a>
            <div class="flex flex-row space-x-4 items-center">
            <p class="font-bold text-xl text-cyan-600">Saldo: Rp{{ number_format(session('balance', 15000000), 0, '', '.') }}</p>
            <a class="p-2 rounded-md bg-emerald-400 hover:bg-emerald-500 dark:hover:bg-slate-500 h-fit justify-self-end" href="{{ route('transactions') }}">
                Riwayat Transaksi
            </a>
            </div>
        </div>
    </nav>
    
    <!-- Page Content -->
    <main class="flex md:w-3/5 mx-auto py-8">
        <div class="w-full flex flex-col">
            {{ $slot }}
        </div>
    </main>
    
    <footer>
        <div class="py-4 px-8 md:px-4 border-t-2 dark:border-gray-700">
            <p class="text-sm text-center">© {{ date('Y') }} PT Toko Pak Adi.</p>
        </div>
    </footer>
</body>
</html>