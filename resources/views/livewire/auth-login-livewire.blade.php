<div class="min-vh-100 d-flex align-items-center justify-content-center bg-light-gradient">
    <form wire:submit.prevent="login" class="w-100" style="max-width: 420px;">
        <div class="card rounded-4 shadow-modern border-0">
            <div class="card-body p-4 p-md-5">
                <!-- Logo & Title -->
                <div class="text-center mb-4">
                    <div class="logo-container mb-3">
                        <img src="/logo.png" alt="Logo" class="logo-image" style="width: 150px; height: 150px;">
                    </div>
                    <h2 class="h3 fw-bold mb-1">Masuk Akun</h2>
                    <p class="text-muted small mb-0">Selamat datang kembali!</p>
                </div>
                
                <hr class="my-4 opacity-10">

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Email</label>
                    <div class="input-group input-modern">
                        <span class="input-group-text bg-transparent border-0">
                            <i class="bi bi-envelope text-muted"></i>
                        </span>
                        <input type="email" class="form-control border-0 ps-0" 
                               wire:model="email" 
                               placeholder="contoh@email.com">
                    </div>
                    @error('email')
                        <span class="text-danger small mt-1 d-block">
                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label class="form-label fw-semibold small">Kata Sandi</label>
                    <div class="input-group input-modern">
                        <span class="input-group-text bg-transparent border-0">
                            <i class="bi bi-key text-muted"></i>
                        </span>
                        <input type="password" class="form-control border-0 ps-0" 
                               wire:model="password" 
                               placeholder="••••••••">
                    </div>
                    @error('password')
                        <span class="text-danger small mt-1 d-block">
                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mb-4">
                    <button type="submit" class="btn btn-primary w-100 btn-lg fw-semibold rounded-3 btn-gradient">
                        <span wire:loading.remove wire:target="login">Masuk</span>
                        <span wire:loading wire:target="login">
                            <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                            Memproses...
                        </span>
                    </button>
                </div>

                <hr class="my-4 opacity-10">
                
                <!-- Register Link -->
                <p class="text-center small mb-0">
                    Belum memiliki akun? 
                    <a href="{{ route('auth.register') }}" class="text-decoration-none fw-semibold link-primary">
                        Daftar di sini
                    </a>
                </p>
                
                <!-- Copyright -->
                <div class="text-center mt-4">
                    <p class="text-muted small mb-0">
                        &copy; 2025 11S23040. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>

@push('styles')
<style>
    /* Background Gradient */
    .bg-light-gradient {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    /* Card Modern */
    .shadow-modern {
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    }

    .card {
        transition: transform 0.3s ease;
        animation: fadeInUp 0.6s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Logo Container */
    .logo-container {
        width: 80px;
        height: 80px;
        margin: 0 auto;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 16px rgba(102, 126, 234, 0.25);
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }

    .logo-image {
        width: 70px; /* Changed from 50px to better fill container */
        height: 70px; /* Added height to maintain aspect ratio */
        object-fit: contain; /* Ensures image scales properly */
        filter: brightness(0) invert(1);
    }

    /* Modern Input Group */
    .input-modern {
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 4px 8px;
        transition: all 0.3s ease;
    }

    .input-modern:focus-within {
        background: white;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .input-modern .input-group-text {
        padding: 0.5rem 0.75rem;
    }

    .input-modern .form-control:focus {
        box-shadow: none;
    }

    .input-modern .form-control::placeholder {
        color: #cbd5e1;
    }

    /* Gradient Button */
    .btn-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.35);
    }

    .btn-gradient:active {
        transform: translateY(0);
    }

    .btn-gradient::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }

    .btn-gradient:hover::before {
        left: 100%;
    }

    /* Link Style */
    .link-primary {
        color: #667eea;
        transition: color 0.2s ease;
    }

    .link-primary:hover {
        color: #764ba2;
    }

    /* HR Style */
    hr {
        border-color: #e2e8f0;
    }

    /* Responsive */
    @media (max-width: 576px) {
        .logo-container {
            width: 65px;
            height: 65px;
        }

        .logo-image {
            width: 55px; /* Adjusted for smaller container */
            height: 55px;
        }

        .card-body {
            padding: 2rem !important;
        }
    }
</style>
@endpush