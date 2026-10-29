<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Equipment;
use App\Models\LoanRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Tampilkan formulir pengajuan peminjaman pihak ketiga.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $equipments = Equipment::where('status', 'tersedia')
            ->with('category')
            ->get();

        return view('loans.create', compact('categories', 'equipments'));
    }

    /**
     * Validasi aturan bisnis dan transaksi peminjaman.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipment_id' => ['required', 'integer', 'exists:equipments,id'],
            'borrower_name' => ['required', 'string', 'max:100'],
            'borrower_nim' => ['required', 'string', 'max:10'],
            'borrower_email' => ['required', 'email', 'max:100'],
            'loan_date' => ['required', 'date'],
            'expected_return_date' => ['required', 'date'],
            'purpose' => ['required', 'string'],
        ]);

        $equipment = Equipment::with('category')->findOrFail($validated['equipment_id']);

        if ($equipment->status !== 'tersedia') {
            return back()->withErrors([
                'equipment_id' => 'Aset sedang tidak tersedia untuk dipinjam.',
            ])->withInput();
        }

        $loanDate = Carbon::parse($validated['loan_date']);
        $expectedReturnDate = Carbon::parse($validated['expected_return_date']);

        if ($expectedReturnDate->lt($loanDate)) {
            return back()->withErrors([
                'expected_return_date' => 'Tanggal rencana pengembalian harus setelah tanggal pinjam.',
            ])->withInput();
        }

        $days = (int) $expectedReturnDate->diffInDays($loanDate);
        $totalEstimatedFee = $days * (int) $equipment->daily_rental_fee;

        LoanRequest::create([
            'equipment_id' => $equipment->id,
            'borrower_name' => $validated['borrower_name'],
            'borrower_nim' => $validated['borrower_nim'],
            'borrower_email' => $validated['borrower_email'],
            'loan_date' => $validated['loan_date'],
            'expected_return_date' => $validated['expected_return_date'],
            'purpose' => $validated['purpose'],
            'status' => 'diajukan',
            'total_estimated_fee' => $totalEstimatedFee,
        ]);

        $equipment->update(['status' => 'dipinjam']);

        return redirect()
            ->route('loans.create')
            ->with('success', 'Pengajuan peminjaman berhasil diajukan.');
    }
}
