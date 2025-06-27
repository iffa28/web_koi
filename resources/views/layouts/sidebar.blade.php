{{-- resources/views/layouts/sidebar.blade.php --}}

<aside
    class="hidden md:flex flex-col flex-shrink-0 bg-gray-900 text-gray-300 transition-all duration-300 ease-in-out overflow-hidden"
    :class="{ 'w-64': !sidebarCollapsed, 'w-20': sidebarCollapsed }">
    {{-- Di sini kita letakkan Logo & Tombol Toggle seperti desain --}}
    <div class="shrink-0 flex items-center justify-between h-16 px-4 border-b border-gray-700">
        <a href="{{ route('dashboard') }}" class="flex items-center overflow-hidden">
            <img src="{{ asset('/images/logo.png') }}" alt="Logo" class="h-9 w-auto object-contain flex-shrink-0">
            <span class="text-white font-bold ml-3 text-lg whitespace-nowrap transition-opacity duration-200"
                :class="{ 'opacity-100 delay-200': !sidebarCollapsed, 'opacity-0': sidebarCollapsed }">A3 KOI
                Farm</span>
        </a>
    </div>

    <nav class="flex-grow py-4 transition-all duration-300"
        :class="{ 'px-2': !sidebarCollapsed, 'px-0': sidebarCollapsed }">
        <ul class="space-y-2">
            <li>
                <div :class="{ 'flex justify-center': sidebarCollapsed }">
                    <x-side-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">


                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25ZM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25Z">
                        </svg>
                        {{-- KODE SPAN YANG DIPERBAIKI --}}
                        <span class="whitespace-nowrap transition-all duration-200"
                            :class="{ 'ml-3 opacity-100': !sidebarCollapsed, 'w-0 opacity-0': sidebarCollapsed }">{{ __('Dashboard') }}</span>
                    </x-side-nav-link>
                </div>
            </li>
            @can('admin')
                <li>
                    <div :class="{ 'flex justify-center': sidebarCollapsed }">
                        <x-side-nav-link :href="route('product.index')" :active="request()->routeIs('product.index')">
                            <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h7.5" />
                            </svg>
                            {{-- KODE SPAN YANG DIPERBAIKI --}}
                            <span class="whitespace-nowrap transition-all duration-200"
                                :class="{ 'ml-3 opacity-100': !sidebarCollapsed, 'w-0 opacity-0': sidebarCollapsed }">{{ __('Manajemen Produk') }}</span>
                        </x-side-nav-link>
                    </div>
                </li>
                <li>
                    <div :class="{ 'flex justify-center': sidebarCollapsed }">
                        <x-side-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">
                            <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-4.67c.62.91 1.074 1.96 1.074 3.071v.003z" />
                            </svg>
                            {{-- KODE SPAN YANG DIPERBAIKI --}}
                            <span class="whitespace-nowrap transition-all duration-200"
                                :class="{ 'ml-3 opacity-100': !sidebarCollapsed, 'w-0 opacity-0': sidebarCollapsed }">{{ __('Manajemen Pengguna') }}</span>
                        </x-side-nav-link>
                    </div>
                </li>
                <li>
                    <div :class="{ 'flex justify-center': sidebarCollapsed }">
                        <x-side-nav-link :href="route('adminPesanan.index')" :active="request()->routeIs('adminPesanan.index')">
                            <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">


                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.658-.463 1.243-1.117 1.243H4.252c-.654 0-1.187-.585-1.117-1.243l1.263-12A3.75 3.75 0 017.5 4.5h9a3.75 3.75 0 013.75 3.75V8.517z" />


                            </svg>
                            {{-- KODE SPAN YANG DIPERBAIKI --}}
                            <span class="whitespace-nowrap transition-all duration-200"
                                :class="{ 'ml-3 opacity-100': !sidebarCollapsed, 'w-0 opacity-0': sidebarCollapsed }">{{ __('Pesanan') }}</span>
                        </x-side-nav-link>
                    </div>
                </li>
                <li>
                    <div :class="{ 'flex justify-center': sidebarCollapsed }">
                        <x-side-nav-link :href="route('adminTransaksi.index')" :active="request()->routeIs('adminTransaksi.index')">
                            <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">


                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />


                            </svg>
                            {{-- KODE SPAN YANG DIPERBAIKI --}}
                            <span class="whitespace-nowrap transition-all duration-200"
                                :class="{ 'ml-3 opacity-100': !sidebarCollapsed, 'w-0 opacity-0': sidebarCollapsed }">{{ __('Transaksi') }}</span>
                        </x-side-nav-link>
                    </div>
                </li>
                <li>
                    <div :class="{ 'flex justify-center': sidebarCollapsed }">
                        <x-side-nav-link :href="route('chat.adminmessages')" :active="request()->routeIs('chat.adminmessages')">
                            <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            {{-- KODE SPAN YANG DIPERBAIKI --}}
                            <span class="whitespace-nowrap transition-all duration-200"
                                :class="{ 'ml-3 opacity-100': !sidebarCollapsed, 'w-0 opacity-0': sidebarCollapsed }">{{ __('Chat') }}</span>
                        </x-side-nav-link>
                    </div>
                </li>
            @endcan
        </ul>
    </nav>
</aside>


{{-- Sidebar untuk Mobile (Overlay) --}}
<div x-show="sidebarOpen" class="fixed inset-0 flex z-40 md:hidden" x-cloak>
    <div @click="sidebarOpen = false" class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>
    <aside class="relative flex-1 flex flex-col max-w-xs w-full bg-gray-900 text-gray-300">
        <div class="absolute top-0 right-0 -mr-12 pt-2">
            <button @click="sidebarOpen = false"
                class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                <span class="sr-only">Close sidebar</span>
                <svg class="h-6 w-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="shrink-0 flex items-center h-16 px-4 border-b border-gray-700">
            <img src="{{ asset('/images/logo.png') }}" alt="Logo" class="h-9 w-auto object-contain flex-shrink-0">
            <span class="text-white font-bold ml-3 text-lg">A3 KOI Farm</span>
        </div>
        <nav class="flex-grow px-2 py-4 mt-5">
            <ul class="space-y-2">
                <li><x-side-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-side-nav-link></li>
                @can('admin')
                    <li><x-side-nav-link :href="route('product.index')" :active="request()->routeIs('product.index')">Manajemen Produk</x-side-nav-link></li>
                    <li><x-side-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">Manajemen Pengguna</x-side-nav-link></li>
                    <li><x-side-nav-link :href="route('adminPesanan.index')" :active="request()->routeIs('adminPesanan.index')">Pesanan</x-side-nav-link></li>
                    <li><x-side-nav-link :href="route('adminTransaksi.index')" :active="request()->routeIs('adminTransaksi.index')">Transaksi</x-side-nav-link></li>
                    <li><x-side-nav-link :href="route('chat.index')" :active="request()->routeIs('chat.index')">Transaksi</x-side-nav-link></li>
                @endcan
            </ul>
        </nav>
    </aside>
</div>
