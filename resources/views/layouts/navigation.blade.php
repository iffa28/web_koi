<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- BAGIAN KIRI: Logo + Nama Toko --}}
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                        <img src="{{ asset('/images/logo.png') }}" alt="Logo Toko Koi A3" class="h-10 w-auto object-contain">
                        {{-- Menambahkan teks di samping logo --}}
                        <span class="font-semibold text-gray-800 dark:text-gray-200">A3 KOI Farm</span>
                    </a>
                </div>
            </div>

            {{-- BAGIAN TENGAH: Nav Links --}}
            <div class="hidden sm:flex sm:items-center sm:justify-center">
                <div class="hidden space-x-8 sm:flex">
                    {{-- Ganti link sesuai gambar --}}
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('product.listproduct')" :active="request()->routeIs('product.listproduct')">
                        {{ __('Produk') }}
                    </x-nav-link>
                    <x-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                        {{ __('Keranjang') }}
                    </x-nav-link>
                    <x-nav-link :href="route('chat.index')" :active="request()->routeIs('chat.index')">
                        {{ __('Chat') }}
                    </x-nav-link>
                    {{-- Anda perlu membuat route untuk 'transaksi.index' --}}
                    <x-nav-link :href="route('history.index')" :active="request()->routeIs('history.index')">
                        {{ __('Riwayat Transaksi') }}
                    </x-nav-link>
                </div>
            </div>

            {{-- BAGIAN KANAN: Dropdown + Tombol Logout --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        {{-- Link Logout di dalam dropdown dihapus dari sini agar bisa jadi tombol terpisah --}}
                    </x-slot>
                </x-dropdown>

                <div class="ms-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg text-sm transition-colors">
                                {{ __('Logout') }}
                            </button>
                    </form>
                </div>
            </div>


            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            {{-- Sesuaikan juga link untuk tampilan mobile --}}
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Produk') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('product.listproduct')" :active="request()->routeIs('product.listproduct')">
                {{ __('Produk') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                {{ __('Keranjang') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('chat.index')" :active="request()->routeIs('chat.index')">
                {{ __('Chat') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('history.index')" :active="request()->routeIs('history.index')">
                {{ __('Riwayat Transaksi') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <div class="ms-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                                class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-red uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 active:bg-red-800 transition ease-in-out duration-150">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>