@extends('layouts.layout')

@section('content')
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
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Welcome to the Personality Test</h3>
                    <div class="mt-2 px-7 py-3">
                        <p class="text-sm text-gray-500">Before you start, please read the instructions carefully. Click
                            'Start' when you are ready.</p>
                    </div>
                    <div class="items-center px-4 py-3">
                        <button onclick="closeModal('welcomeModal')"
                            class="px-4 py-2 bg-primary-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-primary-700 transition-all ease-in-out">
                            Start Test
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Question Section -->
        <div class="w-full max-w-4xl bg-white rounded-lg shadow-md p-8 mt-10">
            <h2 class="text-xl font-semibold text-gray-700">Personality Test</h2>
            <form class="mt-4" {{-- action="{{ route('submit.personality.test') }}" --}} method="POST">
                @csrf
                @foreach (range(1, 5) as $index)
                    <!-- Dummy data loop -->
                    <div class="mt-6">
                        <p class="text-lg font-medium text-gray-600">Question {{ $index }}: What is your favorite
                            color?</p>
                        <div class="flex flex-col mt-2">
                            @foreach (['Red', 'Blue', 'Green', 'Yellow'] as $option)
                                <label class="inline-flex items-center mt-3">
                                    <input type="radio" name="question{{ $index }}"
                                        class="form-radio h-5 w-5 text-blue-600"><span
                                        class="ml-2 text-gray-700">{{ $option }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                <button type="button" onclick="openModal('confirmationModal')"
                    class="mt-6 px-4 py-2 bg-primary-500 text-white font-medium rounded-lg shadow-sm hover:bg-primary-700 transition-all ease-in-out">
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            openModal('welcomeModal');
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

        // Fungsi untuk mengirim formulir
        function submitForm() {
            closeModal('confirmationModal');
            setTimeout(() => {
                document.querySelector('form').submit();
            }, 310); // Menunggu modal benar-benar tertutup
        }
    </script>
@endsection
