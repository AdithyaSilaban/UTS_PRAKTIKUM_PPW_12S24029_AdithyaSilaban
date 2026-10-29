<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Tampilkan katalog perangkat laboratorium (dengan pagination,
     * pencarian, dan filter category / status).
     */
    public function index(Request $request)
    {
        $query = Equipment::query()->with('category');

        if ($search = trim((string) $request->query('search'))) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('asset_code', 'like', "%{$search}%");
            });
        }

        if ($categoryId = $request->query('category_id')) {
            $query->where('category_id', $categoryId);
        }

        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }

        $equipments = $query->latest()->paginate(10)->withQueryString();

        return view('equipments.index', compact('equipments'));
    }

    /**
     * Tampilkan formulir tambah aset perangkat.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('equipments.create', compact('categories'));
    }

    /**
     * Validasi, upload foto, dan simpan aset perangkat baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'asset_code' => ['nullable', 'string', 'max:20', 'unique:equipments,asset_code', 'regex:/^EQ-[A-Z]{3}-[0-9]+$/i'],
            'name' => ['required', 'string', 'max:150'],
            'specification' => ['required', 'string'],
            'condition' => ['nullable', 'in:baik,rusak_ringan,rusak_berat'],
            'status' => ['nullable', 'in:tersedia,dipinjam,dalam_perbaikan'],
            'daily_rental_fee' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
        ]);

        if (empty($validated['asset_code'])) {
            $category = Category::findOrFail($validated['category_id']);
            $prefix = 'EQ-' . $category->code . '-';
            $lastNumber = 0;

            foreach (Equipment::where('asset_code', 'like', $prefix.'%')->pluck('asset_code') as $assetCode) {
                $lastNumber = max($lastNumber, (int) substr($assetCode, strlen($prefix)));
            }

            $validated['asset_code'] = $prefix . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        }

        if ($request->hasFile('image')) {
            $validated['image_path'] = 'storage/' . $request->file('image')->store('equipment', 'public');
        }

        $equipment = Equipment::create([
            'category_id' => $validated['category_id'],
            'asset_code' => $validated['asset_code'],
            'name' => $validated['name'],
            'specification' => $validated['specification'],
            'condition' => $validated['condition'] ?? 'baik',
            'status' => $validated['status'] ?? 'tersedia',
            'daily_rental_fee' => $validated['daily_rental_fee'],
            'image_path' => $validated['image_path'] ?? null,
        ]);

        return redirect()
            ->route('equipments.index')
            ->with('success', "Aset {$equipment->asset_code} berhasil ditambahkan.");
    }

    /**
     * Tampilkan detail spesifikasi dan ketersediaan aset.
     */
    public function show($id)
    {
        $equipment = Equipment::with(['category', 'loanRequests'])->findOrFail($id);

        return view('equipments.show', compact('equipment'));
    }
}
