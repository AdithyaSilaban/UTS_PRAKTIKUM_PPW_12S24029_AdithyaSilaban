@extends('layouts.app')

@section('title', 'Detail Aset')

@section('content')
    <a href="{{ route('equipments.index') }}" class="text-sm font-medium text-black/70 hover:text-black">&larr; Kembali ke Katalog</a>

    <article class="mt-4 bg-white rounded-lg shadow p-6">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <p class="text-xs font-medium uppercase tracking-wide text-black/50">{{ $equipment->category?->name ?? 'Tanpa Kategori' }}</p>
                <h1 class="text-2xl font-semibold text-black">{{ $equipment->name }}</h1>
                <p class="text-sm text-black/60">{{ $equipment->asset_code }}</p>
                <div class="mt-2">
                    <x-status-badge :status="$equipment->status" />
                </div>
            </div>
        </div>

        @if ($equipment->image_path)
            <img src="{{ asset($equipment->image_path) }}" alt="{{ $equipment->name }}" class="mt-6 h-72 w-full rounded-md object-cover">
        @endif

        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div>
                <h2 class="text-sm font-semibold text-black">Spesifikasi</h2>
                <p class="mt-2 text-sm text-black/70">{{ $equipment->specification }}</p>
            </div>
            <div>
                <h2 class="text-sm font-semibold text-black">Kondisi</h2>
                <p class="mt-2 text-sm text-black/70">{{ ucfirst($equipment->condition) }}</p>
            </div>
            <div>
                <h2 class="text-sm font-semibold text-black">Tarif Rental</h2>
                <p class="mt-2 text-sm font-semibold text-black">Rp {{ number_format($equipment->daily_rental_fee, 0, ',', '.') }} / hari</p>
            </div>
        </div>
    </article>
@endsection
