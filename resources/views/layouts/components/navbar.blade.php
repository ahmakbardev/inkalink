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
    <ul class="hidden sm:flex gap-3 items-center">
        <li class="hover:text-slate-300 cursor-pointer transition-all ease-in-out">Beranda</li>
        <li class="hover:text-slate-300 cursor-pointer transition-all ease-in-out">Tentang</li>
    </ul>
    <div class="hidden sm:flex gap-3 items-center">
        <a href="{{ route('login') }}"
            class="px-8 py-2 rounded-lg bg-primary-700 text-white hover:bg-primary-600 transition-all ease-in-out">Login</a>
    </div>
    <ul
        class="hidden mobile-menu flex flex-col items-center gap-3 absolute top-20 left-0 w-full bg-white shadow-md z-40 py-3 transform transition-transform duration-300 ease-in-out translate-y-[-10px] opacity-0">
        <li class="w-full text-center py-2 hover:bg-gray-100">Beranda</li>
        <li class="w-full text-center py-2 hover:bg-gray-100">Tentang</li>
        <li class="w-full text-center py-2">
            <a href="{{ route('login') }}"
                class="px-8 py-2 w-full text-center rounded-lg bg-primary-700 text-white hover:bg-primary-600 transition-all ease-in-out">Login</a>
        </li>
    </ul>
</div>
<script>
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
</script>
