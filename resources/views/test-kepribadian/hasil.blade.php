@extends('layouts.layout')

@section('content')
    <div
        class="w-full flex flex-col justify-center items-center py-16 px-8 sm:py-20 sm:px-32 bg-[#2460C2] relative overflow-hidden">
        <!-- Bagian Hasil -->
        <div class="w-full max-w-4xl bg-white rounded-lg shadow-md p-8 mt-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Bagian Teks -->
                <div class="flex flex-col justify-center">
                    <h2 class="text-xl font-semibold text-gray-700">Hasil Tes Kepribadian</h2>
                    <p class="mt-4 text-gray-600">
                        Berdasarkan jawaban Anda, kami telah menyusun wawasan mengenai ciri-ciri kepribadian Anda. Informasi
                        ini akan
                        membantu Anda memahami preferensi dan kecenderungan Anda dengan lebih baik.
                    </p>
                </div>

                <!-- Bagian Grafik -->
                <div>
                    <canvas id="personalityChart" style="width: 100%; height: auto;"></canvas>
                </div>
            </div>
        </div>

        <!-- Bagian Rekomendasi -->
        <div class="w-full max-w-4xl bg-white mt-10 p-6 shadow-lg rounded-lg relative">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2">
                    <h3 class="text-2xl font-semibold text-gray-700">Rekomendasi dari Inkalink</h3>
                    <p class="text-gray-600 mt-4">
                        Berdasarkan rekomendasi dari para ahli Inkalink, Anda cocok untuk bidang seperti Teknik Mesin,
                        Ilmu Komputer, Teknologi Otomotif, Perikanan, Pertanian, dan Geofisika.
                    </p>
                    <a href="#" class="mt-4 inline-block text-primary-500 hover:text-primary-600">Lihat informasi
                        jenis kepribadian lainnya di sini</a>
                </div>
                <div class="md:w-1/2 flex justify-center mt-6 md:mt-0">
                    <div id="lottieAnimation" style="width: 100%; height: auto;"></div>
                </div>
            </div>
            <div class="absolute right-4 bottom-4">
                <a href="#"
                    class="p-3 bg-blue-500 text-white rounded-full shadow-lg hover:bg-blue-600 transition-colors">Butuh
                    Bantuan?</a>
            </div>
        </div>
    </div>

    <!-- CDN Chart.js dan Lottie -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@lottiefiles/lottie-player"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('personalityChart').getContext('2d');
            var personalityChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Merah', 'Biru', 'Hijau', 'Kuning'],
                    datasets: [{
                        label: 'Preferensi Warna',
                        data: [12, 19, 3, 5],
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Inisialisasi Animasi Lottie
            const player = document.createElement('lottie-player');
            player.setAttribute('src', "{{ asset('assets/images/tipe-kepribadian.json') }}");
            player.setAttribute('background', 'transparent');
            player.setAttribute('speed', '1');
            player.setAttribute('style', 'width: 100%; height: auto;');
            player.autoplay = true;
            player.loop = true;
            document.getElementById('lottieAnimation').appendChild(player);
        });
    </script>
@endsection
