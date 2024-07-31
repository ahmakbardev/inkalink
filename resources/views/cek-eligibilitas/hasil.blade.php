@extends('layouts.layout')

@section('content')
    <div
        class="w-full flex flex-col justify-center items-center py-16 px-8 sm:py-20 sm:px-32 bg-[#2460C2] relative overflow-hidden">
        <!-- Bagian Data Passing Grade -->
        <div class="w-full max-w-4xl bg-white rounded-lg shadow-md p-8 mt-10">
            <h2 class="text-xl font-semibold text-gray-700">Hasil Cek Eligibilitas</h2>
            <h3 class="text-lg font-medium text-gray-600 mt-4">Rata-Rata Nilai: {{ $overallAverage }}</h3>

            @if ($eligibleUniversities->isEmpty())
                <p class="mt-6 text-red-500">Maaf, tidak ada universitas yang cocok dengan rata-rata nilai Anda.</p>
            @else
                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach ($eligibleUniversities as $university)
                        <div class="p-4 border rounded-lg bg-gray-50">
                            <h4 class="font-semibold text-lg">{{ $university->nama_universitas }}</h4>
                            <p class="text-gray-600">Jurusan: {{ $university->nama_jurusan }}</p>
                            <p class="text-gray-600">Nilai RNM: {{ $university->nilai_rnm }}</p>

                            @if ($university->gambar_rnm)
                                <div class="mt-4">
                                    <img src="{{ asset('storage/' . $university->gambar_rnm) }}"
                                        alt="Gambar RNM" class="w-full rounded-lg shadow-lg cursor-pointer"
                                        onclick="showModal('{{ asset('storage/' . $university->gambar_rnm) }}')">
                                </div>
                            @endif

                            <div class="mt-4">
                                <a href="{{ $university->url_info_pendaftaran }}"
                                    class="text-primary-500 hover:text-primary-600">Info Pendaftaran</a>
                                <br>
                                <a href="{{ $university->url_info_passinggrade }}"
                                    class="text-primary-500 hover:text-primary-600">Info Passing Grade</a>
                                <br>
                                <a href="{{ $university->url_biaya_pendidikan }}"
                                    class="text-primary-500 hover:text-primary-600">Info Biaya Pendidikan</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Image -->
    <div id="imageModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white p-4 rounded-lg shadow-lg transform scale-95 transition-transform">
            <img id="modalImage" src="" alt="Modal Image" class="w-full h-auto rounded-lg">
            <button onclick="closeModal()" class="mt-4 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                Close
            </button>
        </div>
    </div>

    <script>
        function showModal(imageUrl) {
            document.getElementById('modalImage').src = imageUrl;
            document.getElementById('imageModal').classList.remove('hidden');
            setTimeout(() => {
                document.getElementById('imageModal').classList.add('flex');
                document.getElementById('imageModal').classList.remove('scale-95');
            }, 10);
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('scale-95');
            setTimeout(() => {
                document.getElementById('imageModal').classList.remove('flex');
                document.getElementById('imageModal').classList.add('hidden');
            }, 300);
        }
    </script>
@endsection
