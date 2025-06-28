<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>A3 KOI Farm - Jual Ikan Hias Berkualitas</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* LANGKAH 1: Membuat scroll menjadi halus */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="antialiased bg-gray-50 dark:bg-gray-900">

    {{-- Header tidak berubah --}}
    <header class="bg-white dark:bg-gray-800 shadow-sm sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0 flex items-center">
                    <a href="/">
                        <img src="{{ asset('/images/logo.png') }}" alt="Logo A3 KOI Farm" class="h-10 w-auto">
                    </a>
                    <span class="ml-3 font-bold text-xl text-gray-800 dark:text-gray-200">A3 KOI Farm</span>
                </div>

                <div>
                    <a href="{{ route('login') }}"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg transition-colors duration-300">
                        Login
                    </a>
                </div>
            </div>
        </nav>
    </header>


    <main>
        {{-- ======================= --}}
        {{--       HERO SECTION      --}}
        {{-- ======================= --}}
        {{-- LANGKAH 3: Menambahkan class untuk membuat section full-screen dan center --}}
        <section class="bg-blue-50 dark:bg-blue-900/20 min-h-screen flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div class="text-center md:text-left">
                        <h1 data-aos="fade-right" data-aos-delay="200"
                            class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white leading-tight">A3 KOI
                            Farm</h1>
                        <p data-aos="fade-right" data-aos-delay="300"
                            class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                            Toko A3 Koi adalah sebuah toko yang bergerak pada bidang penjualan ikan hias yang berlokasi
                            di Kota Semarang, Jawa Tengah.
                        </p>
                        <div data-aos="fade-up" data-aos-delay="400">
                            {{-- LANGKAH 4: Menghubungkan tombol ke section "Tentang Kami" --}}
                            <a href="#tentang-kami"
                                class="mt-8 inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg transition-colors duration-300 shadow-lg">
                                Tentang Kami
                            </a>
                        </div>
                    </div>
                    <div>
                        <img data-aos="fade-left" data-aos-delay="200" src="{{ asset('/images/kolam.png') }}"
                            alt="Kolam Ikan Koi" class="rounded-lg shadow-2xl w-full h-auto">
                    </div>
                </div>
            </div>
        </section>

        {{-- ======================= --}}
        {{--     TENTANG KAMI SECTION --}}
        {{-- ======================= --}}
        {{-- LANGKAH 2: Memberi id pada section ini --}}
        <section id="tentang-kami" class="bg-white dark:bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div data-aos="zoom-in-right" class="order-last md:order-first">
                        <img src="{{ asset('/images/ikanPlastik.png') }}" alt="Ikan Koi dalam Kemasan"
                            class="rounded-lg shadow-2xl w-full h-auto">
                    </div>
                    <div data-aos="fade-left" class="text-center md:text-left">
                        <h2 class="text-4xl font-bold text-gray-900 dark:text-white">Tentang Kami</h2>
                        <p class="mt-4 text-gray-600 dark:text-gray-300 leading-relaxed">
                            Toko A3 Koi adalah toko ikan hias yang berlokasi di Semarang, Jawa Tengah, yang fokus pada
                            penjualan dan budidaya ikan koi grade A seperti Kohaku, Tancho, Showa, dan lainnya.
                        </p>
                        <p class="mt-4 text-gray-600 dark:text-gray-300 leading-relaxed">
                            Kami menyediakan berbagai ukuran ikan koi dan melayani pemesanan serta pengiriman hingga ke
                            rumah. Melalui website ini, kami menghadirkan layanan penjualan berbasis digital dengan
                            fitur chat, keranjang dan kelola stok ikan terkini, agar pelanggan lebih mudah mengakses
                            informasi dan berbelanja kapan saja, di mana saja.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 dark:bg-gray-900 text-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
                <div class="flex items-center justify-center md:justify-start">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo A3 KOI Farm" class="h-10 w-auto">
                    <span class="ml-3 font-bold text-xl text-white">A3 KOI Farm</span>
                </div>
                <div class="flex items-center justify-center">
                    <p>--- Kelompok 4 - PWF ---</p>
                </div>
                <div class="flex items-center justify-center md:justify-end">
                    <svg class="w-5 h-5 mr-2 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.1.4-.27.662-.47.262-.2.552-.453.86-.74.308-.287.633-.626.927-.978.294-.351.555-.73.78-1.128.224-.398.4-.82.527-1.255.127-.435.195-.883.23-1.325a6.25 6.25 0 00-.23-1.325c-.127-.435-.303-.857-.527-1.255a6.772 6.772 0 00-.78-1.128c-.294-.351-.619-.691-.927-.978-.308-.287-.598-.54-.86-.74a12.94 12.94 0 00-.662-.47c-.09-.053-.187-.101-.281-.14L10.005 2c-.11-.02-.308-.065-.308-.065s-.198.045-.308.065l-.006.003-.018.008a5.741 5.741 0 00-.281.14c-.186.1-.4.27-.662.47-.262.2-.552.453-.86.74-.308.287-.633.626-.927.978-.294.351-.555.73-.78-1.128-.224-.398-.4-.82-.527-1.255-.127-.435-.195-.883-.23-1.325a6.25 6.25 0 00.23 1.325c.127.435.303.857.527 1.255.225.398.486.777.78 1.128.294.351.619.691.927.978.308.287.598.54.86.74.262.2.476.37.662.47.095.053.19.101.282.14l.018.008.006.003zM10 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z"
                            clip-rule="evenodd" />
                    </svg>
                    <p>Jl. Kedondong Dalam III No. 24, Kecamatan Semarang Selatan, Kota Semarang, Provinsi Jawa Tengah.
                    </p>
                </div>
            </div>
        </div>
    </footer>


    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
        });
    </script>

</body>

</html>
