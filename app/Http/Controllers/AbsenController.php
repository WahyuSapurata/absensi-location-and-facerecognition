<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\JamKerja;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use svay\FaceDetector;

class AbsenController extends BaseController
{
    public function index()
    {
        $module = 'Absensi';
        return view('admin.absen.index', compact('module'));
    }

    public function get_absensi()
    {
        // $tanggalAbsen = now()->format('d-m-Y');
        // $users = User::where('role', '!=', 'admin')->get();

        // foreach ($users as $user) {
        //     $absenMasuk = Absen::where([
        //         'uuid_user' => $user->uuid,
        //         'jenis_absen' => 'masuk',
        //         'tanggal_absen' => $tanggalAbsen,
        //     ])->first();

        //     // Tambahkan pengecekan apakah data absen masuk ditemukan atau tidak
        //     if ($absenMasuk) {
        //         dd($absenMasuk);
        //     } else {
        //         dd("Absen masuk tidak ditemukan untuk user {$user->name} pada tanggal {$tanggalAbsen}");
        //     }
        // }

        $module = 'Absensi';
        return view('admin.absensi.index', compact('module'));
    }

    public function getDataAbsen()
    {
        $absen = Absen::all();
        $userUuids = $absen->pluck('uuid_user')->unique();
        $users = User::whereIn('uuid', $userUuids)->get();

        // Gabungkan data absen dan data user
        $combinedData = $absen->map(function ($item) use ($users) {
            $user = $users->where('uuid', $item->uuid_user)->first();
            $item->user = $user->name; // Menambahkan data user ke dalam setiap item absen
            return $item;
        });

        return $this->sendResponse($combinedData, 'Get data success');
    }

    public function get()
    {
        $data = Absen::where('uuid_user', auth()->user()->uuid)->get();
        return $this->sendResponse($data, 'Added data success');
    }

    public function absen_masuk()
    {
        $module = 'Absen Masuk';
        return view('admin.absen.absenmasuk', compact('module'));
    }

    public function absen_pulang()
    {
        $module = 'Absen Pulang';
        return view('admin.absen.absenpulang', compact('module'));
    }

    public function get_user()
    {
        $data = auth()->user();
        return $this->sendResponse($data, 'Data Success Ftech');
    }

    public function absensi(Request $request)
    {
        $data = array();
        try {
            $data = new Absen();
            $data->uuid_user = auth()->user()->uuid;
            $data->jam_absen = $request->jam_absen;
            $data->tanggal_absen = $request->tanggal_absen;
            $data->lokasi = $request->lokasi;
            $data->status = 'telah absen ' . $request->jenis_absen;
            $data->jenis_absen = $request->jenis_absen;
            $data->ket = $request->ket;

            if ($request->hasFile('foto_absen')) {
                $foto = $request->file('foto_absen');
                $fotoName = time() . '.' . $foto->getClientOriginalExtension();
                $foto->storeAs('absen', $fotoName, 'public'); // Simpan file ke direktori 'public/images'
                $data->foto_absen = $fotoName;
            }

            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Added data success');
    }
}
