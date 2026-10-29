@extends('layouts.app')

@section('title', 'Riwayat Peminjaman')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-semibold text-black">Riwayat Peminjaman</h1>
        <a href="{{ url('/loans/create') }}" class="inline-flex items-center rounded-lg bg-black px-4 py-2 text-sm font-medium text-white hover:bg-black/80">
            + Ajukan Peminjaman
        </a>
    </div>

    @forelse ($loanRequests as $loanRequest)
        <article class="bg-white rounded-lg shadow p-6 mb-4">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h2 class="text-lg font-semibold text-black">{{ $loanRequest->equipment?->name }}</h2>
                    <p class="text-sm text-black/60">{{ $loanRequest->equipment?->asset_code }}</p>
                </div>
                <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold bg-gray-100 text-gray-700">
                    {{ ucfirst($loanRequest->status) }}
                </span>
            </div>

            <dl class="mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 text-sm">
                <div>
                    <dt class="text-black/50">Peminjam</dt>
                    <dd class="font-medium text-black">{{ $loanRequest->borrower_name }}</dd>
                </div>
                <div>
                    <dt class="text-black/50">NIM</dt>
                    <dd class="font-medium text-black">{{ $loanRequest->borrower_nim }}</dd>
                </div>
                <div>
                    <dt class="text-black/50">Tanggal Pinjam</dt>
                    <dd class="font-medium text-black">{{ $loanRequest->loan_date->format('d M Y') }}</dd>
                </div>
                <div>
                    <dt class="text-black/50">Perkiraan Pengembalian</dt>
                    <dd class="font-medium text-black">{{ $loanRequest->expected_return_date->format('d M Y') }}</dd>
                </div>
                <div>
                    <dt class="text-black/50">Estimasi Biaya</dt>
                    <dd class="font-medium text-black">Rp {{ number_format($loanRequest->total_estimated_fee, 0, ',', '.') }}</dd>
                </div>
            </dl>
        </article>
    @empty
        <p class="text-black/50">Belum ada data pengajuan peminjaman.</p>
    @endforelse

    {{ $loanRequests->links() }}
@endsection
