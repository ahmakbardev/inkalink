@extends('layouts.layout')

@section('content')
    <div class="fixed top-24 right-10 z-10 bg-white p-4 rounded-full">
        <!-- Lottie animation container -->
        <div id="lottieAnimation" class="w-48 h-48 z-10"></div>
    </div>
    <div
        class="w-full flex flex-col justify-center items-center py-16 px-8 sm:py-20 sm:px-32 bg-[#2460C2] relative overflow-hidden">
        <!-- Modal -->
        <div id="welcomeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
            style="display: block; opacity: 0; transition: opacity 0.5s ease-in-out;">
            <div class="relative top-1/2 -translate-y-1/2 mx-auto p-5 border w-96 sm:w-1/3 shadow-lg rounded-md bg-white">
                <button onclick="closeModal('welcomeModal')" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <div class="text-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Selamat datang di Tes Kepribadian</h3>
                    <div class="mt-2 px-7 py-3">
                        <p class="text-sm text-gray-500">Sebelum memulai, harap baca petunjuknya dengan saksama. Klik
                            'Mulai' jika Anda sudah siap.</p>
                    </div>
                    <div class="items-center px-4 py-3">
                        <button onclick="closeModal('welcomeModal')"
                            class="px-4 py-2 bg-primary-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-primary-700 transition-all ease-in-out">
                            Mulai Tes
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Content -->
        <div class="w-full max-w-4xl bg-white rounded-lg shadow-md p-8">
            <h1 class="text-lg sm:text-3xl font-semibold mb-5 text-center">Petunjuk Pengisian Tes Kepribadian</h1>
            <div class="grid grid-cols-1 gap-3">
                <div class="bg-green-100 p-4 rounded-lg">
                    <div class="flex items-center">
                        <img src="{{ asset('assets/images/icon/1.png') }}" alt="Icon 1"
                            class="h-12 w-12 object-contain rounded-full mr-4">
                        <p class="text-gray-700">Tes kepribadian merupakan tes yang dirancang berdasarkan teori John Holland
                            yang berisikan mengenai soal-soal minat dan bakat dalam diri.</p>
                    </div>
                </div>
                <div class="bg-yellow-100 p-4 rounded-lg">
                    <div class="flex items-center">
                        <img src="{{ asset('assets/images/icon/2.png') }}" alt="Icon 2"
                            class="h-12 w-12 object-contain rounded-full mr-4">
                        <p class="text-gray-700">Tes kepribadian ini dapat digunakan untuk melihat tipe kepribadian diri.</p>
                    </div>
                </div>
                <div class="bg-purple-100 p-4 rounded-lg">
                    <div class="flex items-center">
                        <img src="{{ asset('assets/images/icon/3.png') }}" alt="Icon 3"
                            class="h-12 w-12 object-contain rounded-full mr-4">
                        <p class="text-gray-700">Kerjakanlah soal-soal dibawah ini dengan sejujurnya sesuai dengan kondisi diri anda saat ini untuk mengetahui tipe kepribadianmu.</p>
                    </div>
                </div>
                <div class="bg-red-100 p-4 rounded-lg">
                    <div class="flex items-center">
                        <img src="{{ asset('assets/images/icon/4.png') }}" alt="Icon 3"
                            class="h-12 w-12 object-contain rounded-full mr-4">
                        <p class="text-gray-700">Jawablah pertanyaan dengan opsi jawaban YA jika sesuai dengan kondisi diri anda saat ini dan jawab TIDAK jika tidak sesuai dengan kondisi anda saat ini.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full max-w-4xl bg-white rounded-lg shadow-md p-4 my-6">
        </div>

        <!-- Question Section -->
        <div class="w-full max-w-4xl bg-white rounded-lg shadow-md p-8">
            <h2 class="text-xl font-semibold text-gray-700">Tes Kepribadian</h2>
            <form id="testForm" method="POST" action="{{ route('submit.personality.test') }}">
                @csrf
                @foreach ($categories as $category)
                    <div class="category" id="category-{{ $category->category_id }}" style="display: none;">
                        @foreach ($questions[$category->category_id] as $question)
                            <div class="mt-6">
                                <p class="text-lg font-medium text-gray-600">{{ $question->question }}</p>
                                <div class="flex flex-col mt-2">
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="yes"
                                            class="form-radio h-5 w-5 text-blue-600">
                                        <span class="ml-2 text-gray-700">Ya</span>
                                    </label>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="no"
                                            class="form-radio h-5 w-5 text-blue-600">
                                        <span class="ml-2 text-gray-700">Tidak</span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                        <div class="flex justify-between mt-6">
                            @if ($loop->first)
                                <button type="button"
                                    class="nextBtn px-4 py-2 bg-primary-500 text-white font-medium rounded-lg shadow-sm hover:bg-primary-700 transition-all ease-in-out">
                                    Next
                                </button>
                            @else
                                <button type="button"
                                    class="prevBtn px-4 py-2 bg-primary-500 text-white font-medium rounded-lg shadow-sm hover:bg-primary-700 transition-all ease-in-out">
                                    Previous
                                </button>
                                <button type="button"
                                    class="nextBtn px-4 py-2 bg-primary-500 text-white font-medium rounded-lg shadow-sm hover:bg-primary-700 transition-all ease-in-out">
                                    Next
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
                <button type="button"
                    class="submitBtn mt-6 px-4 py-2 bg-primary-500 text-white font-medium rounded-lg shadow-sm hover:bg-primary-700 transition-all ease-in-out"
                    style="display: none;" onclick="confirmSubmit()">
                    Submit Answers
                </button>
            </form>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden"
        style="opacity: 0; transition: opacity 0.5s ease-in-out;">
        <div class="relative top-1/2 -translate-y-1/2 mx-auto p-5 border w-96 sm:w-1/3 shadow-lg rounded-md bg-white">
            <div class="text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Confirm Submission</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">Are you sure you want to submit your answers?</p>
                </div>
                <div class="flex justify-center gap-4 px-4 py-3">
                    <button onclick="submitForm()"
                        class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-green-700 transition-all ease-in-out">
                        Yes, Submit
                    </button>
                    <button onclick="closeModal('confirmationModal')"
                        class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-700 transition-all ease-in-out">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Warning Modal -->
    <div id="warningModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden"
        style="opacity: 0; transition: opacity 0.5s ease-in-out;">
        <div class="relative top-1/2 -translate-y-1/2 mx-auto p-5 border w-96 sm:w-1/3 shadow-lg rounded-md bg-white">
            <div class="text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Incomplete Answers</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">Please answer all the questions in this category before proceeding.
                    </p>
                </div>
                <div class="flex justify-center gap-4 px-4 py-3">
                    <button onclick="closeModal('warningModal')"
                        class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-700 transition-all ease-in-out">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Lottie library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.11/lottie.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            openModal('welcomeModal');
            showCategory(1);

            // Initialize Lottie animation
            lottie.loadAnimation({
                container: document.getElementById(
                    'lottieAnimation'), // the dom element that will contain the animation
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: '{{ asset('assets/lottie/profile.json') }}' // the path to the animation json
            });

            // Next Button Functionality
            document.querySelectorAll('.nextBtn').forEach(button => {
                button.addEventListener('click', function() {
                    const currentCategory = this.closest('.category');
                    const currentCategoryId = parseInt(currentCategory.id.split('-')[1]);
                    const nextCategory = document.getElementById(
                        `category-${currentCategoryId + 1}`);

                    const allAnswered = [...currentCategory.querySelectorAll('input[type="radio"]')]
                        .filter(input => input.checked).length === currentCategory.querySelectorAll(
                            'input[type="radio"]').length / 2;

                    if (!allAnswered) {
                        openModal('warningModal');
                    } else {
                        if (nextCategory) {
                            showCategory(currentCategoryId + 1);
                        } else {
                            showCategory(currentCategoryId);
                            document.querySelector('.submitBtn').style.display = 'block';
                            this.style.display = 'none'; // Hide Next button in the last category
                        }
                    }
                });
            });

            // Previous Button Functionality
            document.querySelectorAll('.prevBtn').forEach(button => {
                button.addEventListener('click', function() {
                    const currentCategory = this.closest('.category');
                    const currentCategoryId = parseInt(currentCategory.id.split('-')[1]);
                    const prevCategory = document.getElementById(
                        `category-${currentCategoryId - 1}`);

                    if (prevCategory) {
                        showCategory(currentCategoryId - 1);
                        document.querySelector('.submitBtn').style.display = 'none';
                        const nextBtn = document.querySelector(
                            `#category-${currentCategoryId - 1} .nextBtn`);
                        if (nextBtn) {
                            nextBtn.style.display = 'inline-block';
                        }
                    }
                });
            });
        });

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

        function showCategory(categoryId) {
            document.querySelectorAll('.category').forEach(category => category.style.display = 'none');
            const categoryElement = document.getElementById(`category-${categoryId}`);
            if (categoryElement) {
                categoryElement.style.display = 'block';
            }
        }

        function submitForm() {
            closeModal('confirmationModal');
            setTimeout(() => {
                document.getElementById('testForm').submit();
            }, 310);
        }

        function confirmSubmit() {
            const currentCategoryId = parseInt(document.querySelector('.category[style*="display: block"]').id.split('-')[
                1]);

            const allAnswered = [...document.querySelector(`#category-${currentCategoryId}`).querySelectorAll(
                    'input[type="radio"]')]
                .filter(input => input.checked).length === document.querySelector(`#category-${currentCategoryId}`)
                .querySelectorAll('input[type="radio"]').length / 2;

            if (allAnswered) {
                openModal('confirmationModal');
            } else {
                openModal('warningModal');
            }
        }
    </script>
@endsection
