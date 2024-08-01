@extends('layouts.layout')

@section('content')
    <div class="min-h-screen bg-gradient-to-r from-blue-500 to-blue-700 py-10 flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
            <h2 class="text-2xl font-semibold text-center mb-6">Edit Profil</h2>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="flex flex-col items-center mb-4">
                    <img id="profilePhotoPreview"
                        src="{{ $user->profile_photo ? Storage::url($user->profile_photo) : 'https://via.placeholder.com/150' }}"
                        alt="Profile Photo" class="w-24 h-24 rounded-full mb-2 object-cover">
                    <input type="file" name="profile_photo" class="hidden" id="profile_photo">
                    <label for="profile_photo"
                        class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer hover:bg-blue-600">Ubah Foto</label>
                </div>
                <div class="mb-4">
                    <label for="username" class="block text-gray-700">Nama Pengguna</label>
                    <input type="text" name="username" id="username" value="{{ $user->username }}"
                        class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}"
                        class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Ubah Kata Sandi</label>
                    <input type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="bio" class="block text-gray-700">Bio</label>
                    <textarea name="bio" id="bio" class="w-full p-2 border border-gray-300 rounded">{{ $user->bio }}</textarea>
                </div>
                <div class="text-center">
                    <button type="submit"
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed bottom-5 right-5 bg-gray-800 text-white px-4 py-2 rounded-lg shadow-lg hidden">
        <span id="toastMessage"></span>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#profile_photo').change(function(event) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#profilePhotoPreview').attr('src', e.target.result);
                }
                reader.readAsDataURL(event.target.files[0]);
            });

            // Function to show toast message
            function showToast(message, type = 'success') {
                const toast = $('#toast');
                const toastMessage = $('#toastMessage');
                toastMessage.text(message);

                if (type === 'success') {
                    toast.removeClass('bg-red-500').addClass('bg-green-500');
                } else {
                    toast.removeClass('bg-green-500').addClass('bg-red-500');
                }

                toast.removeClass('hidden');
                setTimeout(() => {
                    toast.addClass('hidden');
                }, 3000);
            }

            // Show success message from session
            @if (session('success'))
                showToast("{{ session('success') }}", 'success');
            @endif

            // Show error messages from session
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    showToast("{{ $error }}", 'error');
                @endforeach
            @endif
        });
    </script>
@endsection
