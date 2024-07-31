@extends('layouts.layout')

@section('content')
    <div
        class="w-full flex flex-col justify-center items-center py-16 px-8 sm:py-20 sm:px-32 bg-[#2460C2] relative overflow-hidden">
        <img src="{{ asset('assets/images/bg/bg.png') }}" class="absolute inset-0 w-full h-full z-0 opacity-60" alt="">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 sm:gap-10 z-[1]">
            <div class="text-center sm:text-left">
                <h1 class="text-3xl sm:text-6xl font-bold text-white">Selamat Datang di <br>Inkalink</h1>
                <h4 class="text-base sm:text-xl font-medium text-white mt-4">Halo sobat karir, selamat datang di Inkalink!!!
                    Bingung bagaimana
                    merencanakan karir dengan baik? Ayo
                    daftar akun sekarang juga dan nikmati sederet fitur di inkalink untuk mencapai tujuan karirmu!!</h4>
            </div>
            <img src="{{ asset('assets/images/hero/hero-2.png') }}" class="w-1/2" alt="">
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 w-full z-[1] mt-6">
            <div class="flex flex-col justify-center items-center py-5 bg-primary-50 hover:scale-[1.03] hover:bg-primary-100 transition-all ease-in-out rounded-xl cursor-pointer"
                onclick="openModal('kepribadianModal')">
                <img src="{{ asset('assets/images/hero/cek-kepribadian.png') }}" class="w-16 h-16 sm:w-24 sm:h-24"
                    alt="">
                <p class="text-lg font-medium">Cek Kepribadian</p>
            </div>
            <!-- Div untuk Cek Eligibilitas -->
            <div class="flex flex-col justify-center items-center py-5 bg-primary-50 hover:scale-[1.03] hover:bg-primary-100 transition-all ease-in-out rounded-xl cursor-pointer"
                onclick="openModal('eligibilityModal')">
                <img src="{{ asset('assets/images/hero/cek-eligibilitas.png') }}" class="w-16 h-16 sm:w-24 sm:h-24"
                    alt="">
                <p class="text-lg font-medium">Cek Eligibilitas</p>
            </div>

            <!-- Div untuk Jurnal Karier -->
            <div class="flex flex-col justify-center items-center py-5 bg-primary-50 hover:scale-[1.03] hover:bg-primary-100 transition-all ease-in-out rounded-xl cursor-pointer"
                onclick="openModal('careerJournalModal')">
                <img src="{{ asset('assets/images/hero/jurnal.png') }}" class="w-16 h-16 sm:w-24 sm:h-24" alt="">
                <p class="text-lg font-medium">Jurnal Karier</p>
            </div>
        </div>
    </div>
    <div class="w-full flex flex-col items-center pt-16 px-8 sm:px-32 relative overflow-hidden">
        <h1 class="text-center text-xl">Bagaimana dengan karier mu? apakah kamu sudah mempersiapkannya?
            Proses seseorang akan berbeda, yuk persiapkan dirimu dan rencanakan masa depanmu, raih mimpimu lalu banggakan
            orang tuamu! </h1>

        <div class="grid md:grid-cols-2 items-center">
            <div class="flex flex-col order-2 md:order-1">
                <h1 class="text-3xl font-semibold">Apa sih pentingnya perencanaan karier ???</h1>
                <p class="mt-4">Perencanaan karier sangat berpengaruh dalam keberhasilan masa depan kamu kawan, karena
                    dengan perencanaan
                    karier kamu dapat menentukan kemanakan kamu akan menempuh masa depanmu dengan baik.</p>
                <button
                    class="px-8 py-2 rounded-lg bg-primary-700 text-white hover:bg-primary-600 transition-all ease-in-out w-fit mt-3">Rencanakan</button>
            </div>
            <img src="{{ asset('assets/images/perencanaan.png') }}" class="ml-auto order-1 md:order-2" alt="">
        </div>
    </div>
    <div class="w-full flex flex-col items-center px-8 sm:px-32 relative overflow-hidden">
        {{-- <h1 class="text-center text-xl">Bagaimana dengan karier mu? apakah kamu sudah mempersiapkannya?
            Proses seseorang akan berbeda, yuk persiapkan dirimu dan rencanakan masa depanmu, raih mimpimu lalu banggakan
            orang tuamu! </h1> --}}

        <div class="grid md:grid-cols-2 items-center">
            <img src="{{ asset('assets/images/tipe.png') }}" class="ml-auto order-1" alt="">
            <div class="flex flex-col order-2">
                <h1 class="text-3xl font-semibold">Tipe Kepribadian</h1>
                <p class="mt-4">Hidupmu adalah tanggung jawabmu, jangan jadikan orang lain sebagai tumpuan dan kunci dalam
                    meraih kesuksesan. Jadilah dirimu sendiri, pahami dirimu dengan melakukan test kepribadian untuk
                    mengetahui kesesuaian dirimu dengan linkunganmu.</p>
                <button
                    class="px-8 py-2 rounded-lg bg-primary-700 text-white hover:bg-primary-600 transition-all ease-in-out w-fit mt-3">Lihat
                    Tipe</button>
            </div>
        </div>
    </div>
    <div class="w-full flex flex-col items-center px-8 sm:px-32 relative overflow-hidden">
        {{-- <h1 class="text-center text-xl">Bagaimana dengan karier mu? apakah kamu sudah mempersiapkannya?
            Proses seseorang akan berbeda, yuk persiapkan dirimu dan rencanakan masa depanmu, raih mimpimu lalu banggakan
            orang tuamu! </h1> --}}

        <div class="grid md:grid-cols-2 items-center">
            <img src="{{ asset('assets/images/perguruan.png') }}" class="ml-auto order-1" alt="">
            <div class="flex flex-col order-2">
                <h1 class="text-3xl font-semibold">#Perguruan Tinggi</h1>
                <p class="mt-4">Kamu bingung memilih perguruan tinggi yang sesuai dengan nilai rapportmu??? Yukk segera
                    cari tau jurusan dan perguruan tinggi yang sesuai dengan hasil belajarmu.</p>
                <button
                    class="px-8 py-2 rounded-lg bg-primary-700 text-white hover:bg-primary-600 transition-all ease-in-out w-fit mt-3">Lihat..</button>
            </div>
        </div>
    </div>
    <div class="w-full flex flex-col items-center py-5 px-8 sm:px-32 relative overflow-hidden bg-primary-500 text-white">
        <div class="grid md:grid-cols-2 items-end gap-6">
            <div class="flex flex-col">
                <h1 class="text-3xl font-semibold">Jadikan mimpimu terwujud lalu banggakan orang tuamu!!!</h1>
                <p class="text-2xl">#RaihKarirMu
                    Dengan Perencanaan Karir Yang Lebih Baik!</p>
            </div>
            <p>Ayo persiapkan karirmu!! Kenali perencanaan karir, dan keselarasan kepribadian dengan minat jurusan karirmu!!
            </p>
        </div>
        <!-- Contact Us Section -->
        <div class="mt-10 w-full">
            <h2 class="text-xl font-bold">Hubungi Kami</h2>
            <div class="flex items-center gap-4 mt-4">
                <i data-feather="mail" class="w-6 h-6"></i>
                <p>email@example.com</p>
            </div>
            <div class="flex items-center gap-4 mt-2">
                <i data-feather="phone" class="w-6 h-6"></i>
                <p>+62 123 4567 8901</p>
            </div>
            <div class="flex items-center gap-4 mt-2">
                <i data-feather="map-pin" class="w-6 h-6"></i>
                <p>Jalan Pintar No.123, Jakarta, Indonesia</p>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="kepribadianModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-[50]"
        style="display: none; opacity: 0; transition: opacity 0.3s ease-in-out;">
        <div class="relative top-1/2 -translate-y-1/2 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <!-- Close button -->
            <button onclick="closeModal('kepribadianModal')"
                class="absolute top-3 right-3 group bg-transparent border-none">
                <i data-feather="x" class="group-hover:text-slate-500 transition-all ease-in-out"></i>
            </button>
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Cek Kepribadian</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">Kenali tipe kepribadianmu!!
                        Apakah tipe kepribadianmu sesuai dengan minatmu?
                        Yuk lakukan tes kepribadian untuk mengetahui hasilnya!!</p>
                </div>
                <div class="items-center px-4 py-3">
                    <a href="{{ route('test-kepribadian') }}"
                        class="px-4 py-2 bg-primary-500 text-white text-base font-medium rounded-md w-full shadow-sm transition-all ease-in-out hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        Tes Kepribadian
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for Cek Eligibilitas -->
    <div id="eligibilityModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-[50]"
        style="display: none; opacity: 0; transition: opacity 0.3s ease-in-out;">
        <div class="relative top-1/2 -translate-y-1/2 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <!-- Close button -->
            <button onclick="closeModal('eligibilityModal')"
                class="absolute top-3 right-3 group bg-transparent border-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Cek Eligibilitas</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">Cek nilai dan temukan rekomendasi perguruan tinggi sesuai dengan nilai
                        akademik kamu
                    </p>
                </div>
                <div class="items-center px-4 py-3">
                    <a href="{{ route('start.input') }}"
                        class="px-4 py-2 bg-primary-500 text-white text-base font-medium rounded-md w-full shadow-sm transition-all ease-in-out hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        Cek Eligibilitas
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Jurnal Karier -->
    <div id="careerJournalModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-[50]"
        style="display: none; opacity: 0; transition: opacity 0.3s ease-in-out;">
        <div class="relative top-1/2 -translate-y-1/2 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <!-- Close button -->
            <button onclick="closeModal('careerJournalModal')"
                class="absolute top-3 right-3 group bg-transparent border-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round, stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Jurnal Karier</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">Isikan Tujuan dalam perencanaan kariermu, sesuaikan dengan kelebihan
                        dan skill yang kamu miliki.</p>
                </div>
                <div class="items-center px-4 py-3">
                    <button
                        class="px-4 py-2 bg-primary-500 text-white text-base font-medium rounded-md w-full shadow-sm transition-all ease-in-out hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        Buka Jurnal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = 'block';
            setTimeout(() => {
                modal.style.opacity = 1;
            }, 10);
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.opacity = 0;
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
        }
    </script>
@endsection
