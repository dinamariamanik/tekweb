<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TekWeb Store') }}</title>
    <!-- Tailwind CSS CDN untuk styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans flex">

    <!-- Sidebar Admin -->
    <aside class="relative bg-blue-700 h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="{{ route('products.index') }}" class="text-white text-2xl font-semibold uppercase tracking-wider">Admin Store</a>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="{{ route('products.index') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item bg-blue-800">
                <i class="fas fa-box mr-3"></i> Produk
            </a>
        </nav>
    </aside>

    <!-- Konten Utama -->
    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
        <header class="w-full items-center bg-white py-4 px-6 hidden sm:flex shadow">
            <div class="w-1/2 text-gray-700 font-bold">TekWeb Store Dashboard</div>
            <div class="w-1/2 flex justify-end">
                <span class="text-sm text-gray-600 font-semibold">Administrator</span>
            </div>
        </header>

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <!-- Di sinilah konten dari index.blade.php produk akan dimasukkan secara dinamis -->
                {{ $slot }}
            </main>
            
            <footer class="w-full bg-white text-right p-4 text-xs text-gray-500">
                Built for TekWeb Store &copy; 2026
            </footer>
        </div>
    </div>

</body>
</html>