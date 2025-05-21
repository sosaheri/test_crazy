<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard(Request $request)
    {

        $userId = $request->session()->get('user_id');
        $user = User::find($userId);

        if (!$user) {
            return redirect('/login')->with('error', 'Sesión inválida.');
        }

        return view('dashboard.admin', compact('user'));
    }

    public function managerDashboard(Request $request)
    {
        $userId = $request->session()->get('user_id');
        $user = User::find($userId);

        if (!$user) {
            return redirect('/login')->with('error', 'Sesión inválida.');
        }

        return view('dashboard.manager', compact('user'));
    }
}
