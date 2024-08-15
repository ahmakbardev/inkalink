@extends('layouts.layout')

@section('content')
    <div class="h-screen bg-[#2460C2] flex items-center justify-center py-10">
        <div class="bg-white p-10 rounded-lg shadow-lg max-w-3xl text-center">
            <h1 class="text-4xl font-bold mb-6">INKALINK</h1>
            <div class="flex justify-center mb-6">
                <img src="{{ asset('assets/images/logo/logo-square.png') }}" alt="INKALINK Logo"
                    class="w-32 h-32 object-contain">
            </div>
            <p class="text-lg text-gray-700 mb-2">Inkalink merupakan aplikasi perencanaan karir yang dirancang untuk
                meningkatkan perencanaan karir individu.</p>
            <p class="text-lg text-gray-700">Aplikasi ini dibuat oleh mahasiswa Universitas Negeri Malang dengan bantuan ahli
                media.</p>
        </div>
    </div>
@endsection
