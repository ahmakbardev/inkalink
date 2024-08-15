<div class="w-full bg-white sticky top-0 px-8 sm:px-32 py-5 flex justify-between items-center z-50 shadow-md">
    <a href="/" class="flex gap-3 items-center">
        <img src="{{ asset('assets/images/logo/logo-square.png') }}" class="w-10 h-10" alt="">
        <h1 class="text-xl font-medium">inkalink</h1>
    </a>

    <div class="sm:hidden flex items-center">
        <button id="menu-btn" class="outline-none mobile-menu-button">
            <svg class="w-6 h-6 text-gray-500 hover:text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </div>

    <ul class="hidden sm:flex gap-3 w-full justify-center items-center">
        <li class="hover:text-slate-300 cursor-pointer transition-all ease-in-out"><a href="/">Beranda</a></li>
        <li class="hover:text-slate-300 cursor-pointer transition-all ease-in-out"><a href="{{ route('tentang') }}">Tentang</a></li>
    </ul>

    <!-- Search Bar -->
    <div class="relative w-full max-w-lg sm:ml-auto sm:mr-3">
        <input type="text" id="searchInput" class="border border-gray-300 rounded-lg py-2 px-4 w-full"
            placeholder="Cari universitas, jurusan, biaya...">
        <div id="searchResults"
            class="absolute bg-white border border-gray-300 rounded-lg w-full mt-1 hidden max-h-60 overflow-y-auto z-50">
        </div>
    </div>

    <div class="hidden sm:flex gap-3 items-center">
        @auth
            <div class="relative">
                <button id="user-menu-btn" class="flex items-center gap-2 focus:outline-none">
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
                        class="w-6 h-6 rounded-full object-cover transition-all ease-in-out" alt="">
                    <span>{{ Auth::user()->name }}</span>
                    <i data-feather="chevron-down" class="w-4 h-4 text-gray-600"></i>
                </button>
                <ul id="user-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50">
                    <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                        <a href="{{ route('profile.edit') }}">Profile</a>
                    </li>
                    <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        @else
            <a href="{{ route('login') }}"
                class="px-8 py-2 rounded-lg bg-primary-700 text-white hover:bg-primary-600 transition-all ease-in-out">Login</a>
        @endauth
    </div>

    <ul
        class="hidden mobile-menu flex flex-col items-center gap-3 absolute top-20 left-0 w-full bg-white shadow-md z-40 py-3 transform transition-transform duration-300 ease-in-out translate-y-[-10px] opacity-0">
        <li class="w-full text-center py-2 hover:bg-gray-100"><a href="/">Beranda</a></li>
        <li class="w-full text-center py-2 hover:bg-gray-100"><a href="{{ route('tentang') }}">Tentang</a></li>
        @auth
            <li class="w-full text-center py-2 hover:bg-gray-100">
                <a href="{{ route('profile.edit') }}">Profile</a>
            </li>
            <li class="w-full text-center py-2 hover:bg-gray-100">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                    Logout
                </a>
            </li>
            <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        @else
            <li class="w-full text-center py-2">
                <a href="{{ route('login') }}"
                    class="px-8 py-2 w-full text-center rounded-lg bg-primary-700 text-white hover:bg-primary-600 transition-all ease-in-out">Login</a>
            </li>
        @endauth
    </ul>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('#searchInput').on('input', function() {
            var query = $(this).val();
            if (query.length > 2) { // Minimum 3 characters to start searching
                $.ajax({
                    url: '{{ route('search.univ') }}', // Update the route to match your search endpoint
                    method: 'GET',
                    data: {
                        query: query
                    },
                    success: function(response) {
                        $('#searchResults').html('');
                        if (response.length > 0) {
                            response.forEach(function(item) {
                                $('#searchResults').append(`
                                    <div class="p-2 hover:bg-gray-100 cursor-pointer">
                                        <a href="${item.url_pendaftaran}" target="_blank" class="block">
                                            <strong>${item.university}</strong> - ${item.major}<br>
                                            <span class="text-sm text-gray-500">Nilai: ${item.score}</span><br>
                                            <a href="${item.url_passinggrade}" target="_blank" class="text-blue-500">Passing Grade</a> | 
                                            <a href="${item.url_biaya}" target="_blank" class="text-blue-500">Biaya Pendidikan</a>
                                        </a>
                                    </div>
                                `);
                            });
                        } else {
                            $('#searchResults').html(
                                '<div class="p-2 text-gray-500">Tidak ada hasil ditemukan</div>'
                            );
                        }
                        $('#searchResults').removeClass('hidden');
                    }
                });
            } else {
                $('#searchResults').addClass('hidden');
            }
        });

        // Hide results when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#searchInput, #searchResults').length) {
                $('#searchResults').addClass('hidden');
            }
        });

        // Toggle mobile menu
        document.getElementById('menu-btn').addEventListener('click', function() {
            var menu = document.querySelector('.mobile-menu');
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                setTimeout(() => {
                    menu.style.transform = 'translateY(0)';
                    menu.style.opacity = '1';
                }, 10); // Delay for CSS transition to kick in
            } else {
                menu.style.transform = 'translateY(-10px)';
                menu.style.opacity = '0';
                setTimeout(() => {
                    menu.classList.add('hidden');
                }, 300); // Match the duration of the transition
            }
        });

        // Toggle user menu
        document.getElementById('user-menu-btn').addEventListener('click', function() {
            var menu = document.getElementById('user-menu');
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
            } else {
                menu.classList.add('hidden');
            }
        });
    });
</script>

<style>
    #searchResults div:hover {
        background-color: #f0f0f0;
    }
</style>
