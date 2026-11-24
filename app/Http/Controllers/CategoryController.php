<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim($request->get('q') ?? '');

        $categories = Category::when($search !== '', function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('categories.index', [
            'categories' => $categories,
            'search' => $search,
        ]);
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:categories,name'],
            'description' => ['nullable', 'string', 'max:500'],
        ], [
            'name.required' => 'Nama kategori wajib diisi',
            'name.max' => 'Nama kategori maksimal 100 karakter',
            'name.unique' => 'Nama kategori sudah terdaftar',
            'description.max' => 'Deskripsi maksimal 500 karakter',
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')->with('status', 'Kategori berhasil ditambahkan');
    }

    public function edit(Category $category): View
    {
        return view('categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('categories', 'name')->ignore($category->id),
            ],
            'description' => ['nullable', 'string', 'max:500'],
        ], [
            'name.required' => 'Nama kategori wajib diisi',
            'name.max' => 'Nama kategori maksimal 100 karakter',
            'name.unique' => 'Nama kategori sudah terdaftar',
            'description.max' => 'Deskripsi maksimal 500 karakter',
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')->with('status', 'Kategori berhasil diperbarui');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('categories.index')->with('status', 'Kategori berhasil dihapus');
    }
}
