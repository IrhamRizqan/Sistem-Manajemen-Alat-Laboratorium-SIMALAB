<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalPetugas = User::count();

        return view('dashboard', [
            'user' => Auth::user(),
            'totalPetugas' => $totalPetugas,
        ]);
    }
}
