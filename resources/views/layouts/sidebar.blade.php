<aside class="w-64 flex-shrink-0 bg-gray-900 text-gray-300 p-4 flex flex-col">
    <div class="shrink-0 flex items-center mb-8 px-4">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('images/logo1.png') }}" class="block h-9 w-auto object-contain" alt="Logo">
        </a>
        <span class="text-white font-bold ml-3 text-lg">A3 KOI Farm</span>
    </div>

    <nav class="flex-grow">
        <ul>
            <li>
                <a href="{{ route('manajemen.produk') }}"
                    class="flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 {{ request()->routeIs('manajemen.produk') ? 'bg-blue-800 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                    <svg class="w-6 h-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                    </svg>
                    <span>Manajemen Produk</span>
                </a>
            </li>
            <li class="mt-2">
                <a href="#"
                    class="flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200 hover:bg-gray-700 hover:text-white">
                    <svg class="w-6 h-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m-7.284-2.72a3 3 0 0 0-4.682 2.72 9.094 9.094 0 0 0 3.741.479m7.284-2.72-2.475 2.475m0 0a3 3 0 0 1-4.242 0m4.242 0a3 3 0 0 0 0-4.242m-4.242 0a3 3 0 0 1 0-4.242m0 4.242a3 3 0 0 0-4.242 0m4.242 0-2.475-2.475m2.475 2.475a3 3 0 0 1-4.242 0m4.242 0a3 3 0 0 0 0-4.242" />
                    </svg>
                    <span>Manajemen Pengguna</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
