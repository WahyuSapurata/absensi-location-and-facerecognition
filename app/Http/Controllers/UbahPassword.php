<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAkunRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UbahPassword extends BaseController
{
    public function index()
    {
        $module = 'Profil';
        $akun = auth()->user();
        return view('admin.ubahpassword.index', compact('module', 'akun'));
    }

    public function update(StoreAkunRequest $storeAkunRequest, $params)
    {
        if ($storeAkunRequest->password_lama && Hash::check($storeAkunRequest->password_lama, auth()->user()->password) == false) {
            return $this->sendError('Invalid input', 'Password lama tidak sesuai', 200);
        }

        try {
            $data = User::where('uuid', $params)->first();
            $data->name = $storeAkunRequest->name;
            $data->nip = $storeAkunRequest->nip;

            $data->email = $storeAkunRequest->email;
            $data->password = $storeAkunRequest->password ? $storeAkunRequest->password : $data->password;

            if ($storeAkunRequest->hasFile('foto')) {
                // Hapus file yang lama sebelum menyimpan yang baru
                if ($data->foto) {
                    Storage::disk('public')->delete('foto/' . $data->foto);
                }

                $foto = $storeAkunRequest->file('foto');
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
}
