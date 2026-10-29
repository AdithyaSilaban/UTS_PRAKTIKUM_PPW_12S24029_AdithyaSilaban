@extends('layouts.app')

@section('title', 'Pengajuan Peminjaman')

@section('content')
    <h1 class="text-2xl font-semibold text-black mb-6">Pengajuan Peminjaman</h1>

    <form action="{{ route('loans.store') }}" method="POST" class="bg-white rounded-lg shadow p-6 max-w-3xl space-y-6">
        @csrf

        <div>
            <label for="equipment_id" class="block text-sm font-medium text-black mb-2">Aset</label>
            <select id="equipment_id" name="equipment_id" required class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
                <option value="">Pilih Aset Tersedia</option>
                @foreach (\App\Models\Equipment::where('status', 'tersedia')->with('category')->get() as $equipment)
                    <option value="{{ $equipment->id }}">{{ $equipment->name }} ({{ $equipment->asset_code }})</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-6">
            <div>
                <label for="borrower_name" class="block text-sm font-medium text-black mb-2">Nama Peminjam</label>
                <input id="borrower_name" name="borrower_name" type="text" maxlength="100" required class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
            </div>
            <div>
                <label for="borrower_nim" class="block text-sm font-medium text-black mb-2">NIM</label>
                <input id="borrower_nim" name="borrower_nim" type="text" maxlength="10" required class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-6">
            <div>
                <label for="borrower_email" class="block text-sm font-medium text-black mb-2">Email</label>
                <input id="borrower_email" name="borrower_email" type="email" maxlength="100" required class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
            </div>
            <div>
                <label for="purpose" class="block text-sm font-medium text-black mb-2">Keperluan</label>
                <input id="purpose" name="purpose" type="text" maxlength="255" required class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-6">
            <div>
                <label for="loan_date" class="block text-sm font-medium text-black mb-2">Tanggal Pinjam</label>
                <input id="loan_date" name="loan_date" type="date" required class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
            </div>
            <div>
                <label for="expected_return_date" class="block text-sm font-medium text-black mb-2">Perkiraan Pengembalian</label>
                <input id="expected_return_date" name="expected_return_date" type="date" required class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="rounded-lg bg-black px-4 py-2 text-sm font-medium text-white hover:bg-black/80">Ajukan Peminjaman</button>
            <a href="{{ url('/') }}" class="rounded-lg px-4 py-2 text-sm font-medium text-black ring-1 ring-black/20 hover:bg-gray-50">Batal</a>
        </div>
    </form>
@endsection
