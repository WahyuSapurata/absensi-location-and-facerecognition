<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGajiRequest;
use App\Http\Requests\UpdateGajiRequest;
use App\Models\Gaji;
use App\Models\User;

class GajiController extends BaseController
{
    public function index()
    {
        $module = 'Daftar Gaji';
        return view('admin.gaji.index', compact('module'));
    }

    public function get()
    {
        // Mengambil semua data pengguna
        $gaji = Gaji::all();
        $userUuids = $gaji->pluck('uuid_user')->unique();
        $users = User::whereIn('uuid', $userUuids)->get();

        // Gabungkan data absen dan data user
        $combinedData = $gaji->map(function ($item) use ($users) {
            $user = $users->where('uuid', $item->uuid_user)->first();
            $item->user = $user->name; // Menambahkan data user ke dalam setiap item absen
            return $item;
        });

        // Mengembalikan response berdasarkan data yang sudah disaring
        return $this->sendResponse($combinedData, 'Get data success');
    }

    public function store(StoreGajiRequest $storeGajiRequest)
    {
        // Hapus karakter non-numerik (koma dan spasi)
        $numericValue = (int) str_replace(['Rp', ',', ' '], '', $storeGajiRequest->jumlah_gaji);
        $data = array();
        try {
            $data = new Gaji();
            $data->uuid_user = $storeGajiRequest->uuid_user;
            $data->jumlah_gaji = $numericValue;
            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Added data success');
    }

    public function show($params)
    {
        $data = array();
        try {
            $data = Gaji::where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(StoreGajiRequest $storeGajiRequest, $params)
    {
        try {
            $data = Gaji::where('uuid', $params)->first();
            $data->uuid_user = $storeGajiRequest->uuid_user;
            $data->jumlah_gaji = $storeGajiRequest->jumlah_gaji;
            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }

        return $this->sendResponse($data, 'Update data success');
    }

    public function delete($params)
    {
        $data = array();
        try {
            $data = Gaji::where('uuid', $params)->first();
            $data->delete();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Delete data success');
    }
}
