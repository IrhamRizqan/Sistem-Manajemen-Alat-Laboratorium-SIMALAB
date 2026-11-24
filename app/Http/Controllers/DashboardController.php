<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalPetugas = User::count();
        $totalKategori = Category::count();

        return view('dashboard', [
            'user' => Auth::user(),
            'totalPetugas' => $totalPetugas,
            'totalKategori' => $totalKategori,
        ]);
    }
}
