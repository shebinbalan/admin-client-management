<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $assignedTexts = auth()->user()->assignedTexts()->latest()->get();
        
        return view('client.dashboard', compact('assignedTexts'));
    }
}