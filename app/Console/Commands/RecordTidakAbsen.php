<?php

namespace App\Console\Commands;

use App\Models\Absen;
use App\Models\JamKerja;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RecordTidakAbsen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'absen:record-tidak-absen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Record tidak absen masuk atau pulang secara otomatis';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tanggalAbsen = now()->format('d-m-Y');
        $date = Carbon::now();
        // Set lokasi menjadi Indonesia (ID)
        $date->setLocale('id');
        // Menggunakan metode isoFormat dengan format 'dddd'
        $hari = $date->isoFormat('dddd');
        $jam_kerja = JamKerja::where('hari', strtolower($hari))->first();

        $waktuMasuk = Carbon::parse($jam_kerja->jam_masuk);
        $jamMasukAkhir = $waktuMasuk->addHours(1)->format('H:i');

        $waktuPulang = Carbon::parse($jam_kerja->jam_pulang);
        $jamPulangAkhir = $waktuPulang->addHours(1)->format('H:i');

        $jamAbsenMasukAwal = $jam_kerja->jam_masuk;
        $jamAbsenMasukAkhir = $jamMasukAkhir;
        $jamAbsenPulangAwal = $jam_kerja->jam_pulang;
        $jamAbsenPulangAkhir = $jamPulangAkhir;

        // Ambil semua pengguna
        $users = User::where('role', '!=', 'admin')->get();

        foreach ($users as $user) {
            // Cek apakah user sudah absen sakit atau izin pada hari itu
            $absenSakitIzin = Absen::where([
                'uuid_user' => $user->uuid,
                'tanggal_absen' => $tanggalAbsen,
            ])->whereIn('jenis_absen', ['sakit', 'izin'])->exists();

            if (!$absenSakitIzin) {
                // Cek apakah user belum absen masuk
                $absenMasuk = Absen::where([
                    'uuid_user' => $user->uuid,
                    'jenis_absen' => 'masuk',
                    'tanggal_absen' => $tanggalAbsen,
                ])->first();

                if (!$absenMasuk) {
                    // Cek waktu absen masuk
                    $waktuAbsenMasuk = Carbon::now()->format('H:i');

                    if ($waktuAbsenMasuk > $jamAbsenMasukAkhir) {
                        Absen::firstOrNew([
                            'uuid_user' => $user->uuid,
                            'jenis_absen' => 'tidak ceklok masuk',
                            'tanggal_absen' => $tanggalAbsen,
                        ])->save();

                        Log::info("User {$user->name} tidak ceklok masuk pada {$tanggalAbsen}.");
                    }
                }

                // Cek apakah user belum absen pulang
                $absenPulang = Absen::where([
                    'uuid_user' => $user->uuid,
                    'jenis_absen' => 'pulang',
                    'tanggal_absen' => $tanggalAbsen,
                ])->first();

                if (!$absenPulang) {
                    // Cek waktu absen pulang
                    $waktuAbsenPulang = Carbon::now()->format('H:i');

                    if ($waktuAbsenPulang > $jamAbsenPulangAkhir) {
                        Absen::firstOrNew([
                            'uuid_user' => $user->uuid,
                            'jenis_absen' => 'tidak ceklok pulang',
                            'tanggal_absen' => $tanggalAbsen,
                        ])->save();

                        Log::info("User {$user->name} tidak ceklok pulang pada {$tanggalAbsen}.");
                    }
                }
            }
        }
        $this->info('Ketidakabsenan berhasil dicatat.');
        Log::info('Ketidakabsenan berhasil dicatat.');
    }
}
