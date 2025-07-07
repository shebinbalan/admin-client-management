<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AssignedText;
use App\Enums\UserType;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClients = User::where('user_type', UserType::CLIENT)->count();

        $recentClients = User::where('user_type', UserType::CLIENT)
                             ->latest()
                             ->limit(5)
                             ->get();

        $totalTexts = AssignedText::count();

        return view('admin.dashboard', compact('totalClients', 'recentClients', 'totalTexts'));
    }
}
