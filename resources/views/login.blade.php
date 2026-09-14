@extends('template')
@section('content')
<div class="flex items-center justify-center min-h-[80vh] bg-white">
    <div class="w-full max-w-sm p-6 space-y-6">
        
        <!-- Judul -->
        <h2 class="text-2xl font-bold text-center text-gray-900 mb-8">Admin</h2>

        <!-- Form Login -->
        <form action="{{ route('login.proses') }}" method="POST" class="space-y-5 text-center">
            @csrf

            <div>
                <input type="email" name="email" placeholder="masukkan Email" required
                    class="w-full px-4 py-3 bg-[#FBBF24] text-white placeholder-white rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-600">
            </div>

            <!-- Input Password -->
            <div class="relative">
                <input type="password" name="password" placeholder="Kata Sandi" required
                    class="w-full px-4 py-3 bg-[#FBBF24] text-white placeholder-white rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-600">
                
                <!-- Ikon Mata (Bisa menggunakan FontAwesome / Heroicons) -->
                <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-4 text-white">
                    <!-- SVG Ikon Mata Coret -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path></svg>
                </button>
            </div>

            <!-- Lupa Kata Sandi -->
            <div class="text-right mt-2">
                <a href="/lupa-password" class="text-xs font-semibold text-gray-600 hover:text-black underline">
                    Lupa Kata Sandi ?
                </a>
            </div>

            <!-- Tombol Submit -->
            <div class="pt-4">
                <button type="submit" 
                    class="w-full py-3 text-white font-bold bg-[#654321] rounded-md hover:bg-[#4a3118] transition-colors">
                    Masuk
                </button>
            </div>
        </form>

    </div>
</div>
@endsection