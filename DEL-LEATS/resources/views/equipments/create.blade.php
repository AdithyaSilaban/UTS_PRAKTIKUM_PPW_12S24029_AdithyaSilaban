@extends('layouts.app')

@section('title', 'Tambah Aset')

@section('content')
    <h1 class="text-2xl font-semibold text-black mb-6">+ Tambah Aset</h1>

    <form action="{{ route('equipments.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 max-w-3xl space-y-6">
        @csrf

        <div>
            <label for="category_id" class="block text-sm font-medium text-black mb-2">Kategori</label>
            <select id="category_id" name="category_id" required class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
                <option value="">Pilih Kategori</option>
                @foreach (\App\Models\Category::orderBy('name')->get() as $category)
                    <option value="{{ $category->id }}">{{ $category->name }} ({{ $category->code }})</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="asset_code" class="block text-sm font-medium text-black mb-2">Kode Aset</label>
            <input id="asset_code" name="asset_code" type="text" maxlength="20" placeholder="EQ-[KODE_KAT]-[NOMOR]" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
        </div>

        <div>
            <label for="name" class="block text-sm font-medium text-black mb-2">Nama Aset</label>
            <input id="name" name="name" type="text" maxlength="150" required class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
        </div>

        <div>
            <label for="specification" class="block text-sm font-medium text-black mb-2">Spesifikasi</label>
            <textarea id="specification" name="specification" rows="4" required class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm"></textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-6">
            <div>
                <label for="condition" class="block text-sm font-medium text-black mb-2">Kondisi</label>
                <select id="condition" name="condition" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
                    <option value="baik">Baik</option>
                    <option value="rusak_ringan">Rusak Ringan</option>
                    <option value="rusak_berat">Rusak Berat</option>
                </select>
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-black mb-2">Status</label>
                <select id="status" name="status" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
                    <option value="tersedia">Tersedia</option>
                    <option value="dipinjam">Dipinjam</option>
                    <option value="dalam_perbaikan">Dalam Perbaikan</option>
                </select>
            </div>
        </div>

        <div>
            <label for="daily_rental_fee" class="block text-sm font-medium text-black mb-2">Tarif Harian (Rupiah)</label>
            <input id="daily_rental_fee" name="daily_rental_fee" type="number" min="0" step="1" required class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-black mb-2">Foto Aset (opsional)</label>
            <input id="image" name="image" type="file" accept="image/jpeg,image/jpg,image/png" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="rounded-lg bg-black px-4 py-2 text-sm font-medium text-white hover:bg-black/80">Simpan Aset</button>
            <a href="{{ route('equipments.index') }}" class="rounded-lg px-4 py-2 text-sm font-medium text-black ring-1 ring-black/20 hover:bg-gray-50">Batal</a>
        </div>
    </form>
@endsection
