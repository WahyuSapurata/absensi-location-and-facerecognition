<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDataGuruRequest;
use App\Http\Requests\UpdateDataGuruRequest;
use App\Models\DataGuru;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DataGuruController extends BaseController
{
    public function index()
    {
        $module = 'Daftar Pegawai';
        return view('admin.dataguru.index', compact('module'));
    }

    public function get()
    {
        // Mengambil semua data pengguna
        $dataFull = User::all();

        // Mengembalikan response berdasarkan data yang sudah disaring
        return $this->sendResponse($dataFull, 'Get data success');
    }

    public function store(StoreDataGuruRequest $storeDataGuruRequest)
    {
        $data = array();

        $newFoto = '';
        if ($storeDataGuruRequest->file('foto')) {
            $extension = $storeDataGuruRequest->file('foto')->extension();
            $newFoto = $storeDataGuruRequest->name . '-' . now()->timestamp . '.' . $extension;
            $storeDataGuruRequest->file('foto')->storeAs('foto', $newFoto);
        }

        try {
            $data = new User();
            $data->name = $storeDataGuruRequest->name;
            $data->nip = $storeDataGuruRequest->nip;
            $data->unit = $storeDataGuruRequest->unit;

            $data->email = $storeDataGuruRequest->email;
            $data->password = Hash::make('<>password');
            $data->role = 'guru';
            $data->foto = $newFoto;

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
            $data = User::where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(UpdateDataGuruRequest $updateDataGuruRequest, $params)
    {
        $data = User::where('uuid', $params)->first();

        $oldFotoPath = public_path('foto/' . $data->foto);

        $newFoto = '';
        if ($updateDataGuruRequest->file('foto')) {
            $$extension = $storeDataGuruRequest->file('foto')->extension();
            $newFoto = $storeDataGuruRequest->name . '-' . now()->timestamp . '.' . $extension;
            $storeDataGuruRequest->file('foto')->storeAs('foto', $newFoto);

            // Hapus foto lama jika ada
            if (File::exists($oldFotoPath)) {
                File::delete($oldFotoPath);
            }
        }
        try {
            $data->name = $updateDataGuruRequest->name;
            $data->nip = $updateDataGuruRequest->nip;
            $data->unit = $updateDataGuruRequest->unit;

            $data->email = $updateDataGuruRequest->email;
            $data->password = $updateDataGuruRequest->password ? $updateDataGuruRequest->password : $data->password;
            $data->foto = $updateDataGuruRequest->file('foto') ? $newFoto : $data->foto;

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
            $data = User::where('uuid', $params)->first();

            $oldFotoPath = public_path('foto/' . $data->foto);
            // Hapus foto lama jika ada
            if (File::exists($oldFotoPath)) {
                File::delete($oldFotoPath);
            }
            $data->delete();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Delete data success');
    }
}
