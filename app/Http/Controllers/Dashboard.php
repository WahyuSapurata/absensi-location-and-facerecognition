<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Gaji;
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
        $absen_masuk = Absen::where('uuid_user', auth()->user()->uuid)->where('jenis_absen', 'masuk')->count();
        $absen_pulang = Absen::where('uuid_user', auth()->user()->uuid)->where('jenis_absen', 'pulang')->count();

        $tidakCeklokMasuk = Absen::where('uuid_user', auth()->user()->uuid)->where('jenis_absen', 'tidak ceklok masuk')->count();
        $tidakCeklokPulang = Absen::where('uuid_user', auth()->user()->uuid)->where('jenis_absen', 'tidak ceklok pulang')->count();
        $gaji = Gaji::where('uuid_user', auth()->user()->uuid)->first();
        $jumlahTidakCeklok = $tidakCeklokMasuk + $tidakCeklokPulang;
        $hasil = $jumlahTidakCeklok * 5000;
        $total_gaji = floatval($gaji->jumlah_gaji) - $hasil;
        return view('dashboard.guru', compact('module', 'absen_masuk', 'absen_pulang', 'total_gaji'));
    }

    public function dashboard_kepsek()
    {
        $module = 'Dashboard';
        return view('dashboard.kepsek', compact('module'));
    }
}
