@extends('layouts.app')

@section('title', 'Katalog Aset')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-semibold text-black">Katalog Aset</h1>
        <a href="{{ route('equipments.create') }}" class="inline-flex items-center rounded-lg bg-black px-4 py-2 text-sm font-medium text-white hover:bg-black/80">
            + Tambah Aset
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($equipments as $equipment)
            <article class="bg-white rounded-lg shadow p-6 flex flex-col gap-4">
                @if ($equipment->image_path)
                    <img src="{{ asset($equipment->image_path) }}" alt="{{ $equipment->name }}" class="h-40 w-full rounded-md object-cover">
                @endif

                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-black/50">{{ $equipment->category?->name ?? 'Tanpa Kategori' }}</p>
                        <h2 class="text-lg font-semibold text-black">{{ $equipment->name }}</h2>
                        <p class="text-sm text-black/60">{{ $equipment->asset_code }}</p>
                    </div>
                </div>

                <x-status-badge :status="$equipment->status" />

                <p class="text-sm text-black/70">{{ $equipment->specification }}</p>

                <div class="mt-auto flex items-center justify-between gap-4">
                    <p class="text-sm font-semibold text-black">Rp {{ number_format($equipment->daily_rental_fee, 0, ',', '.') }} / hari</p>
                    <a href="{{ route('equipments.show', $equipment->id) }}" class="text-sm font-medium text-black underline hover:text-black/70">Detail</a>
                </div>
            </article>
        @empty
            <p class="text-black/50">Belum ada data alat laboratorium.</p>
        @endforelse
    </div>
@endsection
