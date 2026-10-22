@extends('template')
@section('content')

<style>
    /* Wadah utama form login */
    .form-login-container {
        max-width: 400px;
        width: 100%;
        margin: 0 auto;
        padding-top: 60px;
    }
    
    /* Judul Admin */
    .login-title {
        font-weight: bold;
        font-size: 28px;
        margin-bottom: 30px;
        color: #000;
    }
    
    /* Input teks (Email & Password) */
    .input-login {
        background-color: #F4A259 !important; /* Oranye */
        color: white !important;
        border: none !important;
        padding: 14px 20px;
        border-radius: 6px;
        font-size: 15px;
    }
    .input-login::placeholder {
        color: white !important;
        opacity: 0.9;
    }
    .input-login:focus {
        box-shadow: 0 0 0 3px rgba(244, 162, 89, 0.4);
    }
    
    /* Penyesuaian ikon mata (gabung dengan input) */
    .input-password-field {
        border-radius: 6px 0 0 6px !important;
    }
    .input-group-text.eye-icon {
        background-color: #F4A259 !important;
        color: white !important;
        border: none !important;
        border-radius: 0 6px 6px 0;
        cursor: pointer;
        padding-right: 15px;
    }
    
    /* Tombol Masuk */
    .btn-login-submit {
        background-color: #6E491C !important; /* Cokelat */
        color: white !important;
        border: none;
        border-radius: 6px;
        padding: 12px;
        font-weight: bold;
        font-size: 16px;
    }
    .btn-login-submit:hover {
        background-color: #523614 !important;
    }
    
    /* Link Lupa Kata Sandi */
    .link-lupa-sandi {
        color: #333;
        font-size: 12px;
        text-decoration: underline;
        font-weight: 500;
    }
    .link-lupa-sandi:hover {
        color: black;
    }
</style>

<div class="d-flex justify-content-center align-items-start" style="min-height: 70vh;">
    <div class="form-login-container text-center">
        
        <!-- Judul -->
        <h2 class="login-title">Admin</h2>

        <!-- Form Login -->
        <form action="{{ route('login.proses') }}" method="POST">
            @csrf

            <!-- Input Email -->
            <div class="mb-3">
                <input type="email" name="email" placeholder="masukkan Email" required
                    class="form-control input-login">
            </div>

            <!-- Input Password dengan Ikon Mata -->
            <div class="input-group mb-1">
                <input type="password" name="password" id="passwordInput" placeholder="Kata Sandi" required
                    class="form-control input-login input-password-field">
                <span class="input-group-text eye-icon" onclick="togglePassword()">
                    <!-- Menggunakan Bootstrap Icons -->
                    <i class="bi bi-eye-slash-fill" id="toggleIcon"></i>
                </span>
            </div>

            <!-- Lupa Kata Sandi -->
            <div class="text-end mb-4 mt-2">
                <a href="/lupa-password" class="link-lupa-sandi">
                    Lupa Kata Sandi ?
                </a>
            </div>

            <!-- Tombol Submit -->
            <div>
                <button type="submit" class="btn w-100 btn-login-submit shadow-sm">
                    Masuk
                </button>
            </div>
            
        </form>
    </div>
</div>

<!-- Script untuk Toggle (Menampilkan/Menyembunyikan) Password -->
<script>
    function togglePassword() {
        var passwordInput = document.getElementById("passwordInput");
        var toggleIcon = document.getElementById("toggleIcon");
        
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.classList.remove("bi-eye-slash-fill");
            toggleIcon.classList.add("bi-eye-fill");
        } else {
            passwordInput.type = "password";
            toggleIcon.classList.remove("bi-eye-fill");
            toggleIcon.classList.add("bi-eye-slash-fill");
        }
    }
</script>

@endsection