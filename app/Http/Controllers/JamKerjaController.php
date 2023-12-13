<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJamKerjaRequest;
use App\Http\Requests\UpdateJamKerjaRequest;
use App\Models\JamKerja;

class JamKerjaController extends BaseController
{
    public function index()
    {
        $module = 'Daftar Jam Kerja';
        return view('admin.jamkerja.index', compact('module'));
    }

    public function get()
    {
        // Mengambil semua data pengguna
        $dataFull = JamKerja::all();

        // Mengembalikan response berdasarkan data yang sudah disaring
        return $this->sendResponse($dataFull, 'Get data success');
    }

    public function store(StoreJamKerjaRequest $storeJamKerjaRequest)
    {
        $data = array();
        try {
            $data = new JamKerja();
            $data->hari = $storeJamKerjaRequest->hari;
            $data->jam_masuk = $storeJamKerjaRequest->jam_masuk;
            $data->jam_pulang = $storeJamKerjaRequest->jam_pulang;
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
            $data = JamKerja::where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(StoreJamKerjaRequest $storeJamKerjaRequest, $params)
    {
        try {
            $data = JamKerja::where('uuid', $params)->first();
            $data->hari = $storeJamKerjaRequest->hari;
            $data->jam_masuk = $storeJamKerjaRequest->jam_masuk;
            $data->jam_pulang = $storeJamKerjaRequest->jam_pulang;
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
            $data = JamKerja::where('uuid', $params)->first();
            $data->delete();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Delete data success');
    }
}
