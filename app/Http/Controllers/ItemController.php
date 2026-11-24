<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ItemController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim($request->get('q') ?? '');
        $categoryId = $request->get('category_id');

        $items = Item::with('category')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('code', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%");
                });
            })
            ->when(!empty($categoryId), function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('items.index', [
            'items' => $items,
            'categories' => $categories,
            'search' => $search,
            'categoryId' => $categoryId,
        ]);
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('items.create', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'code' => ['required', 'string', 'max:30', 'unique:items,code'],
            'name' => ['required', 'string', 'max:150'],
            'location' => ['required', 'string', 'max:100'],
            'condition' => ['required', 'in:Baik,Rusak Ringan,Rusak Berat'],
            'stock' => ['required', 'integer', 'min:0'],
        ], [
            'category_id.required' => 'Kategori wajib dipilih',
            'category_id.exists' => 'Kategori tidak valid',
            'code.required' => 'Kode barang wajib diisi',
            'code.max' => 'Kode barang maksimal 30 karakter',
            'code.unique' => 'Kode barang sudah terdaftar',
            'name.required' => 'Nama barang wajib diisi',
            'name.max' => 'Nama barang maksimal 150 karakter',
            'location.required' => 'Lokasi barang wajib diisi',
            'location.max' => 'Lokasi barang maksimal 100 karakter',
            'condition.required' => 'Kondisi barang wajib dipilih',
            'condition.in' => 'Kondisi barang tidak valid',
            'stock.required' => 'Stok barang wajib diisi',
            'stock.integer' => 'Stok harus berupa angka bulat',
            'stock.min' => 'Stok minimal 0',
        ]);

        Item::create($validated);

        return redirect()->route('items.index')->with('status', 'Barang berhasil ditambahkan');
    }

    public function edit(Item $item): View
    {
        $categories = Category::orderBy('name')->get();

        return view('items.edit', [
            'item' => $item,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Item $item): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'code' => [
                'required',
                'string',
                'max:30',
                Rule::unique('items', 'code')->ignore($item->id),
            ],
            'name' => ['required', 'string', 'max:150'],
            'location' => ['required', 'string', 'max:100'],
            'condition' => ['required', 'in:Baik,Rusak Ringan,Rusak Berat'],
            'stock' => ['required', 'integer', 'min:0'],
        ], [
            'category_id.required' => 'Kategori wajib dipilih',
            'category_id.exists' => 'Kategori tidak valid',
            'code.required' => 'Kode barang wajib diisi',
            'code.max' => 'Kode barang maksimal 30 karakter',
            'code.unique' => 'Kode barang sudah terdaftar',
            'name.required' => 'Nama barang wajib diisi',
            'name.max' => 'Nama barang maksimal 150 karakter',
            'location.required' => 'Lokasi barang wajib diisi',
            'location.max' => 'Lokasi barang maksimal 100 karakter',
            'condition.required' => 'Kondisi barang wajib dipilih',
            'condition.in' => 'Kondisi barang tidak valid',
            'stock.required' => 'Stok barang wajib diisi',
            'stock.integer' => 'Stok harus berupa angka bulat',
            'stock.min' => 'Stok minimal 0',
        ]);

        $item->update($validated);

        return redirect()->route('items.index')->with('status', 'Barang berhasil diperbarui');
    }

    public function destroy(Item $item): RedirectResponse
    {
        $item->delete();

        return redirect()->route('items.index')->with('status', 'Barang berhasil dihapus');
    }
}
