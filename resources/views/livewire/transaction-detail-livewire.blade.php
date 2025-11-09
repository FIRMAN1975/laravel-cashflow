<div class="bg-warning-subtle py-3 py-md-4">
    {{-- Header Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h6 class="text-uppercase text-muted mb-1 small">Transaksi</h6>
            <h3 class="fw-bold mb-0">
                <span class="text-muted fw-light">Detail /</span>
                <span class="ms-1">Transaksi</span>
            </h3>
        </div>
        <a href="{{ route('app.home') }}" class="btn btn-light border d-flex align-items-center" wire:navigate>
            <i class="bi bi-arrow-left me-1"></i>
            Kembali
        </a>
    </div>

    <div class="row g-4">
        {{-- Kolom Kiri: Detail Transaksi --}}
        <div class="col-lg-7 col-md-6">
            <div class="card rounded-4 shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    {{-- Judul Transaksi --}}
                    <h4 class="card-title mb-2 fw-semibold">
                        {{ $transaction->title }}
                    </h4>

                    {{-- Tipe dan Tanggal --}}
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                        @if ($transaction->type == 'income')
                            <span class="badge bg-success-subtle text-success-emphasis rounded-pill px-3 py-2">
                                <i class="bi bi-arrow-down-short me-1"></i>
                                Pemasukan
                            </span>
                        @else
                            <span class="badge bg-danger-subtle text-danger-emphasis rounded-pill px-3 py-2">
                                <i class="bi bi-arrow-up-short me-1"></i>
                                Pengeluaran
                            </span>
                        @endif

                        <span class="text-muted d-flex align-items-center">
                            <i class="bi bi-calendar-event me-1"></i>
                            {{ $transaction->date->format('d F Y') }}
                        </span>
                    </div>

                    {{-- Jumlah (Amount) --}}
                    <div class="mb-4">
                        <div class="rounded-3 p-3 bg-warning-subtle d-inline-block">
                            <h2 class="fw-bold mb-0">
                                @if ($transaction->type == 'income')
                                    <span class="text-success">
                                        + Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="text-danger">
                                        - Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                    </span>
                                @endif
                            </h2>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <h6 class="fw-semibold text-muted text-uppercase small mb-2">
                        Deskripsi
                    </h6>
                    <p class="card-text fs-6 mb-0">
                        {!! nl2br(e($transaction->description)) !!}
                    </p>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Bukti Transaksi (Cover) --}}
        <div class="col-lg-5 col-md-6">
            <div class="card rounded-4 shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0 px-4 pt-4 pb-2">
                    <h5 class="card-title mb-0 fw-semibold d-flex align-items-center">
                        <i class="bi bi-receipt-cutoff me-2"></i>
                        Bukti Transaksi
                    </h5>
                </div>
                <div class="card-body text-center px-4 pb-4 pt-3">
                    {{-- Tampilkan Cover --}}
                    @if ($transaction->cover)
                        <div class="mb-3">
                            <img
                                src="{{ asset('storage/' . $transaction->cover) }}"
                                alt="Bukti Transaksi"
                                class="img-fluid rounded-3 shadow-sm"
                                style="max-height: 400px; object-fit: cover; width: 100%;">
                        </div>
                    @else
                        <div class="alert alert-secondary text-start rounded-3">
                            <i class="bi bi-info-circle me-1"></i>
                            Belum ada bukti transaksi yang di-upload.
                        </div>
                    @endif

                    {{-- Tombol untuk Buka Modal Edit Cover --}}
                    <button
                        type="button"
                        class="btn btn-primary w-100 mt-1 d-flex align-items-center justify-content-center"
                        data-bs-toggle="modal"
                        data-bs-target="#editCoverTransactionModal">
                        <i class="bi bi-upload me-1"></i>
                        Ubah / Upload Bukti
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal edit cover (tetap sama) --}}
    @include('components.modals.transactions.edit-cover')
</div>
