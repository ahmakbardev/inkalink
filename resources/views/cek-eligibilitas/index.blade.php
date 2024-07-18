@extends('layouts.layout')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 py-10">
        <!-- Heading and Description Section -->
        <div class="text-center p-4 max-w-2xl">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Eligibilitas Nilai</h1>
            <p class="text-lg text-gray-600 mb-4">
                Cek nilai dan temukan rekomendasi perguruan tinggi sesuai dengan nilai akademik kamu.
            </p>
            <img src="{{ asset('assets/images/eligibilitas.png') }}" alt="Careers Image" class="w-full h-auto mt-4 mb-6">
        </div>

        <!-- Instructions Section -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6 w-full max-w-md">
            <p class="text-gray-700 mb-4">
                Lakukan input nilai untuk mengetahui peluang perguruan tinggi berdasarkan nilai akademik kamu. Isikan nilai
                sesuai dengan nilai raport kamu.
            </p>
            <p class="text-gray-700 mb-4">
                Input nilai dapat dilakukan secara mandiri namun tetap dalam pengawasan guru BK.
            </p>
            <button onclick="startInput()"
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full">
                Buat
            </button>
        </div>

        <!-- Additional Info Section -->
        <div class="flex items-center justify-center">
            <a href="#" class="text-blue-500 hover:text-blue-600">
                <div class="flex items-center">
                    <i data-feather="archive" class="mr-2"></i>
                    View other personality types information here
                </div>
            </a>
        </div>
    </div>

    <script>
        function startInput() {
            // Implement the function to navigate or open a form for input
            window.location.href = "{{ route('start.input') }}"; // Adjust the route as necessary
        }
    </script>
@endsection
