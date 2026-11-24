<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalPetugas = User::count();
        $totalKategori = Category::count();
        $totalBarang = Item::count();
        $totalStok = Item::sum('stock');
        $barangPerhatian = Item::with('category')
            ->where('stock', '<=', 2)
            ->orWhere('condition', '!=', 'Baik')
            ->orderBy('stock')
            ->limit(5)
            ->get();

        return view('dashboard', [
            'user' => Auth::user(),
            'totalPetugas' => $totalPetugas,
            'totalKategori' => $totalKategori,
            'totalBarang' => $totalBarang,
            'totalStok' => $totalStok,
            'barangPerhatian' => $barangPerhatian,
        ]);
    }
}
