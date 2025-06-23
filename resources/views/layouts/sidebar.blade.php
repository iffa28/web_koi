{{-- resources/views/layouts/sidebar.blade.php --}}

<aside class="hidden md:flex flex-col flex-shrink-0 bg-gray-900 text-gray-300 transition-all duration-300 ease-in-out overflow-hidden"
    :class="{ 'w-64': !sidebarCollapsed, 'w-10': sidebarCollapsed }">
    {{-- Bagian Logo dan Tombol Toggle di Top Bar (diatur di app.blade.php) --}}
    {{-- Di sini hanya Navigasi Links --}}
    <nav class="flex-grow px-2 py-4">
        <ul class="space-y-2">
            <li>
                {{-- Setiap link dibungkus dengan div, dan :class ditaruh di sini --}}
                <div :class="{ 'flex justify-center': sidebarCollapsed }">
                    {{-- Komponen link menjadi lebih sederhana tanpa :class dinamis --}}
                    <x-side-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25ZM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25Z" />
                        </svg>
                        <span class="ml-3 whitespace-nowrap"
                            :class="{ 'opacity-0': sidebarCollapsed }">{{ __('Dashboard') }}</span>
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
                                    d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25ZM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25Z" />
                            </svg>
                            <span class="ml-3 whitespace-nowrap"
                                :class="{ 'opacity-0': sidebarCollapsed }">{{ __('Manajemen Produk') }}</span>
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
                            <span class="ml-3 whitespace-nowrap"
                                :class="{ 'opacity-0': sidebarCollapsed }">{{ __('Manajemen Pengguna') }}</span>
                        </x-side-nav-link>
                    </div>
                </li>
                <li>
                    <div :class="{ 'flex justify-center': sidebarCollapsed }">
                        <x-side-nav-link :href="route('adminPesanan.index')" :active="request()->routeIs('adminPesanan.index')">
                            <svg class="w-6 h-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-4.67c.62.91 1.074 1.96 1.074 3.071v.003z" />
                            </svg>
                            <span class="ml-3 whitespace-nowrap"
                                :class="{ 'opacity-0': sidebarCollapsed }">{{ __('Pesanan') }}</span>
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
        <nav class="flex-grow px-2 py-4 mt-5">
            {{-- Duplikasi link dari sidebar desktop untuk mobile --}}
            <ul class="space-y-2">
                <li>
                    <x-side-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <svg class="w-6 h-6 flex-shrink-0" ...></svg>
                        <span class="ml-3">{{ __('Dashboard') }}</span>
                    </x-side-nav-link>
                </li>
                @can('admin')
                    <li>
                        <x-side-nav-link :href="route('product.index')" :active="request()->routeIs('product.index')">
                            <svg class="w-6 h-6 flex-shrink-0" ...></svg>
                            <span class="ml-3">{{ __('Manajemen Produk') }}</span>
                        </x-side-nav-link>
                    </li>
                    <li>
                        <x-side-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">
                            <svg class="w-6 h-6 flex-shrink-0" ...></svg>
                            <span class="ml-3">{{ __('Manajemen Pengguna') }}</span>
                        </x-side-nav-link>
                    </li>
                    <li>
                        <x-side-nav-link :href="route('adminPesanan.index')" :active="request()->routeIs('adminPesanan.index')">
                            <svg class="w-6 h-6 flex-shrink-0" ...></svg>
                            <span class="ml-3">{{ __('Pesanan') }}</span>
                        </x-side-nav-link>
                    </li>
                @endcan
            </ul>
        </nav>
    </aside>
</div>
