{{-- resources/views/layouts/sidebar.blade.php --}}

<aside 
    class="flex-shrink-0 bg-gray-900 text-gray-300 flex flex-col transition-all duration-300 ease-in-out"
    :class="{'w-64': !sidebarCollapsed, 'w-20': sidebarCollapsed}"
>
    <div class="shrink-0 flex items-center h-16 px-4 border-b border-gray-700">
        <a href="{{ route('dashboard') }}" class="flex items-center overflow-hidden">
            <img src="{{ asset('/images/logo.png') }}" alt="Logo" class="h-9 w-auto object-contain flex-shrink-0">
            <span 
                class="text-white font-bold ml-3 text-lg whitespace-nowrap transition-opacity duration-200"
                :class="{'opacity-100 delay-200': !sidebarCollapsed, 'opacity-0': sidebarCollapsed}"
            >A3 KOI Farm</span>
        </a>
    </div>

    {{-- Ganti seluruh isi <nav> dengan kode ini --}}
    <nav class="flex-grow px-2 py-4">
        <ul class="space-y-2">
            <li>
                {{-- SETIAP LINK KITA BUNGKUS DENGAN DIV --}}
                {{-- :class sekarang berada di div, bukan di komponen --}}
                <div :class="{'flex justify-center': sidebarCollapsed}">
                    {{-- Komponen link kini menjadi lebih sederhana tanpa :class --}}
                    <x-side-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25ZM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25Z" /></svg>
                        <span class="ml-3 whitespace-nowrap transition-opacity duration-200" :class="{'opacity-0': sidebarCollapsed}">{{ __('Dashboard') }}</span>
                    </x-side-nav-link>
                </div>
            </li>
            @can('admin')
                <li>
                    <div :class="{'flex justify-center': sidebarCollapsed}">
                        <x-side-nav-link :href="route('product.index')" :active="request()->routeIs('product.index')">
                            <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h7.5" /></svg>
                            <span class="ml-3 whitespace-nowrap transition-opacity duration-200" :class="{'opacity-0': sidebarCollapsed}">{{ __('Manajemen Produk') }}</span>
                        </x-side-nav-link>
                    </div>
                </li>
                <li>
                    <div :class="{'flex justify-center': sidebarCollapsed}">
                        <x-side-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">
                            <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-4.67c.62.91 1.074 1.96 1.074 3.071v.003z" /></svg>
                            <span class="ml-3 whitespace-nowrap transition-opacity duration-200" :class="{'opacity-0': sidebarCollapsed}">{{ __('Manajemen Pengguna') }}</span>
                        </x-side-nav-link>
                    </div>
                </li>
            @endcan
        </ul>
    </nav>

    <div class="flex-shrink-0 p-4 border-t border-gray-700">
        <button @click="sidebarCollapsed = !sidebarCollapsed" class="hidden md:flex items-center justify-center w-full p-2 rounded-lg text-gray-400 hover:text-white hover:bg-gray-700">
            <svg class="h-6 w-6 transition-transform duration-300" :class="{'rotate-180': sidebarCollapsed}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
            </svg>
            <span class="ml-3 whitespace-nowrap transition-opacity duration-200" :class="{'opacity-0': sidebarCollapsed}">Kecilkan</span>
        </button>
    </div>
</aside>