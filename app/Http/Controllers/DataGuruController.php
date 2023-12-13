<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDataGuruRequest;
use App\Http\Requests\UpdateDataGuruRequest;
use App\Models\DataGuru;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        try {
            $data = new User();
            $data->name = $storeDataGuruRequest->name;
            $data->nip = $storeDataGuruRequest->nip;
            $data->unit = $storeDataGuruRequest->unit;

            $data->email = $storeDataGuruRequest->email;
            $data->password = Hash::make('<>password');
            $data->role = 'guru';

            if ($storeDataGuruRequest->hasFile('foto')) {
                $foto = $storeDataGuruRequest->file('foto');
                $fotoName = time() . '.' . $foto->getClientOriginalExtension();
                $foto->storeAs('foto', $fotoName, 'public'); // Simpan file ke direktori 'public/images'
                $data->foto = $fotoName;
            }

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
        try {
            $data = User::where('uuid', $params)->first();
            $data->name = $updateDataGuruRequest->name;
            $data->nip = $updateDataGuruRequest->nip;
            $data->unit = $updateDataGuruRequest->unit;

            $data->email = $updateDataGuruRequest->email;
            $data->password = $updateDataGuruRequest->password ? $updateDataGuruRequest->password : $data->password;

            if ($updateDataGuruRequest->hasFile('foto')) {
                // Hapus file yang lama sebelum menyimpan yang baru
                if ($data->foto) {
                    Storage::disk('public')->delete('foto/' . $data->foto);
                }

                $foto = $updateDataGuruRequest->file('foto');
                $fotoName = time() . '.' . $foto->getClientOriginalExtension();
                $foto->storeAs('foto', $fotoName, 'public'); // Simpan foto ke direktori 'public/foto'
                $data->foto = $fotoName;
            }

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

            // Hapus file terkait sebelum menghapus data dari database
            if ($data->foto) {
                Storage::disk('public')->delete('foto/' . $data->foto);
            }
            $data->delete();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Delete data success');
    }
}
