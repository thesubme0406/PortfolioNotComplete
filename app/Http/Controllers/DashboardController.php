<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Load portfolio with nested items
        $portfolio = $user->portfolio()->with(['experiences','skills','qualifications','contacts'])->first();

        return view('dashboard', compact('portfolio'));
    }
}
