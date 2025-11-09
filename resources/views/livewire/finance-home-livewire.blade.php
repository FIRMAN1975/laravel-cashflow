<div class="bg-warning-subtle py-3 py-md-4">
    {{-- HEADER / GREETING CARD --}}
    <div class="mt-3">
        <div class="card rounded-4 shadow-sm border-0 overflow-hidden">
            <div class="row g-0 align-items-center px-3 py-3 py-md-4 bg-white">
                <div class="col-md-8 d-flex align-items-center">
                    <div class="me-3">
                        <div
                            class="avatar rounded-circle bg-primary text-white d-flex align-items-center justify-content-center shadow-sm"
                            style="width:56px;height:56px;font-weight:600;">
                            {{ strtoupper(substr($auth->name,0,1)) }}
                        </div>
                    </div>
                    <div>
                        <h4 class="mb-1 fw-semibold">
                            Halo, <span class="text-primary">{{ $auth->name }}</span>
                        </h4>
                        <small class="text-muted">
                            Selamat datang kembali! Kelola transaksi keuangan Anda di sini.
                        </small>
                    </div>
                </div>

                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="{{ route('auth.logout') }}" class="btn btn-outline-danger me-2">
                        <i class="bi bi-box-arrow-right me-1"></i> Keluar
                    </a>
                    <button class="btn btn-primary shadow-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#addTransactionModal">
                        <i class="bi bi-plus-lg me-1"></i> Tambah
                    </button>
                </div>
            </div>

            {{-- FILTER & SEARCH BAR --}}
            <div class="card-body border-top bg-warning-subtle p-3">
                <div class="row g-2 align-items-center">
                    <div class="col-md-5">
                        <div class="input-group input-group-sm input-group-lg">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="bi bi-search"></i>
                            </span>
                            <input
                                type="text"
                                class="form-control border-start-0"
                                placeholder="Cari judul atau deskripsi transaksi..."
                                wire:model.live.debounce.300ms="search" />
                        </div>
                    </div>

                    <div class="col-md-3">
                        <select class="form-select form-select-sm"
                                wire:model.live="filterType">
                            <option value="all">Semua Tipe</option>
                            <option value="income">Pemasukan</option>
                            <option value="expense">Pengeluaran</option>
                        </select>
                    </div>

                    <div class="col-md-4 text-md-end mt-2 mt-md-0">
                        @if($search || $filterType != 'all')
                            <button class="btn btn-sm btn-outline-secondary"
                                    wire:click="resetFilters">
                                <i class="bi bi-arrow-counterclockwise me-1"></i>
                                Reset filter
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- =============================================== --}}
    {{-- STAT CARDS --}}
    {{-- =============================================== --}}
    <div class="row g-4 my-4">
        {{-- Total Pemasukan --}}
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <small class="text-muted text-uppercase fw-semibold">Total Pemasukan</small>
                        <span class="badge bg-success-subtle text-success-emphasis border border-success-subtle">
                            <i class="bi bi-graph-up-arrow me-1"></i> Positif
                        </span>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded-circle bg-success-subtle text-success-emphasis d-flex align-items-center justify-content-center"
                                  style="width:40px;height:40px;">
                                <i class="bi bi-arrow-down-short fs-4"></i>
                            </span>
                        </div>
                        <div class="me-auto">
                            <h4 class="mb-0 fw-bold">Rp {{ number_format($totalIncome, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Pengeluaran --}}
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <small class="text-muted text-uppercase fw-semibold">Total Pengeluaran</small>
                        <span class="badge bg-danger-subtle text-danger-emphasis border border-danger-subtle">
                            <i class="bi bi-graph-down-arrow me-1"></i> Keluar
                        </span>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded-circle bg-danger-subtle text-danger-emphasis d-flex align-items-center justify-content-center"
                                  style="width:40px;height:40px;">
                                <i class="bi bi-arrow-up-short fs-4"></i>
                            </span>
                        </div>
                        <div class="me-auto">
                            <h4 class="mb-0 fw-bold">Rp {{ number_format($totalExpense, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Saldo Saat Ini --}}
        <div class="col-lg-4 col-md-12 col-12">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <small class="text-muted text-uppercase fw-semibold">Total Saldo</small>
                        @if ($totalBalance >= 0)
                            <span class="badge bg-primary-subtle text-primary-emphasis border border-primary-subtle">
                                <i class="bi bi-check-circle me-1"></i> Sehat
                            </span>
                        @else
                            <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle">
                                <i class="bi bi-exclamation-triangle me-1"></i> Minus
                            </span>
                        @endif
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="avatar flex-shrink-0 me-3">
                            @if ($totalBalance >= 0)
                                <span class="avatar-initial rounded-circle bg-primary-subtle text-primary-emphasis d-flex align-items-center justify-content-center"
                                      style="width:40px;height:40px;">
                                    <i class="bi bi-wallet2 fs-5"></i>
                                </span>
                            @else
                                <span class="avatar-initial rounded-circle bg-warning-subtle text-warning-emphasis d-flex align-items-center justify-content-center"
                                      style="width:40px;height:40px;">
                                    <i class="bi bi-exclamation-triangle fs-5"></i>
                                </span>
                            @endif
                        </div>
                        <div class="me-auto">
                            <h4 class="mb-0 fw-bold">
                                @if ($totalBalance < 0)
                                    -Rp {{ number_format(abs($totalBalance), 0, ',', '.') }}
                                @else
                                    Rp {{ number_format($totalBalance, 0, ',', '.') }}
                                @endif
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- GRAFIK KEUANGAN --}}
    <div class="row my-4">
        <div class="col-12">
            <div class="card rounded-4 shadow-sm border-0">
                <div class="card-header bg-white border-0 py-3 d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="mb-1 fw-semibold">Statistik Keuangan</h6>
                        <small class="text-muted">Grafik Pemasukan vs Pengeluaran berdasarkan filter saat ini</small>
                    </div>
                    <div class="text-end">
                        <small class="text-muted">
                            Periode:
                            <span class="badge bg-warning-subtle text-dark border">
                                {{ $currentPeriod ?? 'Semua' }}
                            </span>
                        </small>
                    </div>
                </div>
                <div class="card-body">
                    <div wire:ignore>
                        <div id="finance-chart" style="min-height:260px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TABEL TRANSAKSI --}}
    <div class="card rounded-4 shadow-sm border-0">
        <div class="card-header bg-white border-0 py-3 d-flex align-items-center justify-content-between">
            <div>
                <h5 class="mb-0 fw-semibold">Daftar Transaksi</h5>
                <small class="text-muted">Menampilkan total {{ $transactions->total() }} transaksi</small>
            </div>
        </div>

        <div class="card-body p-0">
            @if ($transactions->isEmpty())
                <div class="p-5 text-center">
                    <div class="mb-3">
                        <i class="bi bi-wallet2" style="font-size:32px;color:#adb5bd;"></i>
                    </div>
                    <h6 class="mb-1 text-muted">Tidak ada transaksi</h6>
                    <p class="small text-muted mb-0">
                        Tidak ditemukan transaksi untuk kriteria pencarian atau filter saat ini.
                    </p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-warning-subtle small text-muted">
                            <tr>
                                <th style="width:56px">No</th>
                                <th style="min-width:140px">Tanggal</th>
                                <th style="min-width:110px">Tipe</th>
                                <th class="text-end" style="min-width:140px">Jumlah</th>
                                <th style="min-width:220px">Deskripsi</th>
                                <th class="text-end" style="min-width:160px">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $key => $transaction)
                                <tr class="border-top">
                                    <td class="small text-muted">
                                        {{ $transactions->firstItem() + $loop->index }}
                                    </td>
                                    <td class="fw-medium">
                                        <i class="bi bi-calendar2-week me-1 text-muted"></i>
                                        {{ $transaction->date->format('d F Y') }}
                                    </td>
                                    <td>
                                        @if ($transaction->type == 'income')
                                            <span class="badge rounded-pill bg-success-subtle text-success-emphasis border border-success-subtle">
                                                <i class="bi bi-arrow-down-short me-1"></i> Pemasukan
                                            </span>
                                        @else
                                            <span class="badge rounded-pill bg-danger-subtle text-danger-emphasis border border-danger-subtle">
                                                <i class="bi bi-arrow-up-short me-1"></i> Pengeluaran
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-end fw-semibold">
                                        Rp {{ number_format($transaction->amount,0,',','.') }}
                                    </td>
                                    <td class="small">
                                        <div class="text-truncate" style="max-width:320px;"
                                             title="{{ $transaction->description }}">
                                            {{ $transaction->description }}
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('app.transactions.detail', ['transaction_id' => $transaction->id]) }}"
                                           class="btn btn-sm btn-outline-info me-1">
                                            <i class="bi bi-eye me-1"></i> Detail
                                        </a>
                                        <button wire:click="prepareEditTransaction({{ $transaction->id }})"
                                            class="btn btn-sm btn-outline-warning me-1">
                                            <i class="bi bi-pencil-square me-1"></i> Edit
                                        </button>
                                        <button wire:click="prepareDeleteTransaction({{ $transaction->id }})"
                                            class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash3 me-1"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex align-items-center justify-content-between p-3 border-top bg-warning-subtle">
                    <div>
                        <small class="text-muted">
                            Menampilkan
                            <strong>{{ $transactions->firstItem() }}</strong>
                            -
                            <strong>{{ $transactions->lastItem() }}</strong>
                            dari
                            <strong>{{ $transactions->total() }}</strong>
                            transaksi
                        </small>
                    </div>
                    <div class="mb-0">
                        {{ $transactions->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- FAB BUTTON (MOBILE) --}}
    <div class="position-fixed end-0 bottom-0 p-3 d-md-none" style="z-index:1050;">
        <button class="btn btn-primary rounded-circle shadow-lg d-flex align-items-center justify-content-center"
            style="width:56px;height:56px;"
            data-bs-toggle="modal"
            data-bs-target="#addTransactionModal"
            aria-label="Tambah Transaksi">
            <i class="bi bi-plus-lg" style="font-size:20px"></i>
        </button>
    </div>

    @include('components.modals.transactions.add')
    @include('components.modals.transactions.edit')
</div>
