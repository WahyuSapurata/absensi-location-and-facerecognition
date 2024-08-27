<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Illuminate\Http\Request;

class Dashboard extends BaseController
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->back();
        }
        return redirect()->route('login.login-akun');
    }

    public function dashboard_admin()
    {
        $module = 'Dashboard';
        return view('dashboard.admin', compact('module'));
    }

    public function dashboard_guru()
    {
        $module = 'Dashboard';
        $absen_masuk = Absen::where('uuid_user', auth()->user()->uuid)->where('status', 'telah absen masuk')->count();
        $absen_pulang = Absen::where('uuid_user', auth()->user()->uuid)->where('status', 'telah absen pulang')->count();
        return view('dashboard.guru', compact('module', 'absen_masuk', 'absen_pulang'));
    }

    public function dashboard_kepsek()
    {
        $module = 'Dashboard';
        return view('dashboard.kepsek', compact('module'));
    }
}
