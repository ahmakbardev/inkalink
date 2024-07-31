@extends('layouts.layout')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 min-h-screen">
        <div class="bg-white flex justify-center items-center px-4 py-8 relative">
            <!-- Tombol Beranda -->
            <a href="/" class="absolute top-4 left-4 text-indigo-600 hover:text-indigo-800 flex items-center gap-2 m-5">
                <i data-feather="arrow-left" class="w-6 h-6"></i> Kembali ke Beranda
            </a>

            <div class="w-full max-w-md p-8 bg-white shadow-lg rounded-2xl">
                <h2 class="text-2xl font-bold text-center mb-6">Buat Akun Baru</h2>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" id="name" name="name" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="password" name="password" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                            Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Sign up
                    </button>
                </form>
            </div>
        </div>
        <div class="hidden md:flex bg-[#2460C2] justify-center items-center relative px-4 py-8">
            <img src="{{ asset('assets/images/bg/bg.png') }}"
                class="absolute inset-0 w-full h-full z-0 opacity-60 object-cover pointer-events-none" alt="">
            <div
                class="bg-white/20 w-full max-w-lg flex flex-col items-center gap-10 p-6 backdrop-blur-[3px] border-2 border-slate-300 rounded-2xl">
                <h1 class="text-3xl text-center sm:text-4xl pl-5 border-l-2 text-white"><span
                        class="font-semibold block">Wujudkan Impianmu!</span>
                    dengan mengetahui kapasitas dirimu!</h1>
                <img src="{{ asset('assets/images/hero/login.png') }}" class="w-full max-w-md object-fill" alt="">
            </div>
        </div>
    </div>
@endsection
