@extends('layouts.layout')

@section('content')
    <div class="min-h-screen bg-gray-100 py-10">
        <div class="container mx-auto px-4">
            <div class="bg-white p-6 rounded-lg shadow-lg relative">
                <div class="flex justify-between gap-10">
                    <h2 class="text-2xl font-semibold text-start text-gray-700 mb-4">Tipe Kepribadian</h2>
                    <div class="flex flex-col gap-3">
                        <p class="text-start text-gray-600">
                            Kamu dapat menemukan karir sesuai dengan kepribadianmu dan dapat mencapai tujuan kariermu karena
                            memilih tipe kepribadian yang sesuai dengan diri kamu.
                        </p>
                        <p class="text-start text-pink-500 font-semibold mb-10">
                            “Pilihan karir didasarkan oleh faktor kepribadian, hal tersebut terjadi karena seseorang
                            memandang dunia terhadap pekerjaan, jabatan, serta keputusan karirnya melalui kesesuaian pilihan
                            mereka.” – John Holland
                        </p>
                    </div>
                </div>
                <!-- Swiper -->
                <div class="swiper-container overflow-x-hidden">
                    <div class="swiper-wrapper">
                        @foreach ($personalityTypes as $type)
                            <div class="swiper-slide">
                                <div class="p-6 rounded-lg shadow-lg bg-white text-center">
                                    @if ($type->image)
                                        <img src="{{ asset( 'storage/'.$type->image) }}" alt="{{ $type->name }}" class="mx-auto mb-4">
                                    @endif
                                    <h4 class="text-pink-500 font-semibold mb-2">{{ $type->name }}</h4>
                                    <p class="text-gray-600 mb-4">
                                        {{ \Illuminate\Support\Str::limit($type->description, 150) }}
                                    </p>
                                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
                                        onclick="showModal('{{ $type->name }}', '{{ $type->description }}', '{{ asset($type->image) }}')">Learn
                                        More</button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>

                    <!-- Add Navigation -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="personalityModal" class="fixed inset-0 z-10 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden w-3/4 md:w-1/2 lg:w-1/3">
            <div class="p-6">
                <h3 id="modalTitle" class="text-xl font-semibold text-gray-700 mb-4"></h3>
                <p id="modalDescription" class="text-gray-600 mb-4"></p>
                <img id="modalImage" src="" alt="" class="w-full h-auto rounded-lg mb-4">
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
                    onclick="closeModal()">Close</button>
            </div>
        </div>
    </div>

    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 10,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 50,
                },
            }
        });

        function showModal(title, description, image) {
            document.getElementById('modalTitle').innerText = title;
            document.getElementById('modalDescription').innerText = description;
            document.getElementById('modalImage').src = image;
            document.getElementById('personalityModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('personalityModal').classList.add('hidden');
        }
    </script>
@endsection
