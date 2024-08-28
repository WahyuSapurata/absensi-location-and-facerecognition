<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Gaji;
use App\Models\JamKerja;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Rekap extends BaseController
{
    public function index()
    {
        $module = 'Rekap';
        return view('admin.rekap.index', compact('module'));
    }

    public function get($params)
    {
        // Memisahkan tanggal berdasarkan kata kunci "to"
        $dateParts = explode(' to ', $params);

        // $dateParts[0] akan berisi tanggal awal dan $dateParts[1] akan berisi tanggal akhir
        $startDateStr = trim($dateParts[0]);
        $endDateStr = trim($dateParts[1]);

        $absen = Absen::all();
        $userUuids = $absen->pluck('uuid_user')->unique();

        // Menggunakan metode with untuk memuat data absensi bersamaan dengan data pengguna
        $users = User::whereIn('uuid', $userUuids)->with('absensi')->get();

        // Gabungkan data absen dan data user
        $combinedData = $users->map(function ($user) use ($startDateStr, $endDateStr) {
            // Filter data absen berdasarkan rentang tanggal
            $filteredAbsensi = $user->absensi->whereBetween('tanggal_absen', [$startDateStr, $endDateStr]);

            // Menambahkan data user ke dalam setiap item absen
            $user->absensi = $filteredAbsensi;

            // Hitung jumlah absen berdasarkan jenis absen
            $user->jumlahHadir = $filteredAbsensi->whereIn('jenis_absen', ['masuk', 'pulang'])->count();
            $user->jumlahIzin = $filteredAbsensi->where('jenis_absen', 'izin')->count();
            $user->jumlahSakit = $filteredAbsensi->where('jenis_absen', 'sakit')->count();

            // Hitung jumlah tidak ceklok masuk dan pulang pada hari tertentu
            $tidakCeklokMasuk = $filteredAbsensi->where('jenis_absen', 'tidak ceklok masuk')->count();
            $tidakCeklokPulang = $filteredAbsensi->where('jenis_absen', 'tidak ceklok pulang')->count();
            $user->jumlahTidakCeklokMasuk = $tidakCeklokMasuk;
            $user->jumlahTidakCeklokPulang = $tidakCeklokPulang;

            $gaji = Gaji::where('uuid_user', $user->uuid)->first();
            $jumlahTidakCeklok = $tidakCeklokMasuk + $tidakCeklokPulang;
            dd($jumlahTidakCeklok);
            $hasil = $jumlahTidakCeklok * 5000;

            $user->gaji = floatval($gaji->jumlah_gaji) - $hasil;

            return $user;
        });

        return $this->sendResponse($combinedData, 'Get data success');
    }

    public function exportToExcel($params)
    {
        // Memisahkan tanggal berdasarkan kata kunci "to"
        $dateParts = explode(' to ', $params);

        // $dateParts[0] akan berisi tanggal awal dan $dateParts[1] akan berisi tanggal akhir
        $startDateStr = trim($dateParts[0]);
        $endDateStr = trim($dateParts[1]);

        // Buat objek Spreadsheet
        $spreadsheet = new Spreadsheet();

        // Ambil objek aktif (sheet aktif)
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_FOLIO);
        $sheet->getRowDimension(1)->setRowHeight(30);
        $spreadsheet->getDefaultStyle()->getFont()->setName('Times New Roman');
        $fontStyle = [
            'font' => [
                'name' => 'Times New Roman',
                'size' => 12,
            ],
        ];

        // Isi data ke dalam sheet


        $centerStyle = [
            'alignment' => [
                //'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ];
        $sheet->setCellValue('A1', 'REKAP ABSEN GURU DAN STAF')->mergeCells('A1:I1');
        $sheet->setCellValue('A2', 'Tanggal ' . $startDateStr . ' Sampai ' . $endDateStr)->mergeCells('A2:I2');
        //$sheet->getStyle('A1:J1')->applyFromArray($fontStyle);
        //$sheet->getStyle('A1:J1')->applyFromArray($centerStyle);

        $sheet->setCellValue('A3', 'NO')->mergeCells('A3:A4');
        $sheet->setCellValue('B3', 'NAMA')->mergeCells('B3:B4');
        $sheet->setCellValue('C3', 'ABSENSI')->mergeCells('C3:I3');
        $sheet->setCellValue('C4', 'UNIT');
        $sheet->setCellValue('D4', 'HADIR');
        $sheet->setCellValue('E4', 'SAKIT');
        $sheet->setCellValue('F4', 'IZIN');
        $sheet->setCellValue('G4', 'TIDAK CEKLOK MASUK');
        $sheet->setCellValue('H4', 'TIDAK CEKLOK PULANG');
        $sheet->setCellValue('I4', 'REKAP GAJI');

        $absen = Absen::all();
        $userUuids = $absen->pluck('uuid_user')->unique();

        // Menggunakan metode with untuk memuat data absensi bersamaan dengan data pengguna
        $users = User::whereIn('uuid', $userUuids)->with('absensi')->get();

        // Gabungkan data absen dan data user
        $combinedData = $users->map(function ($user) use ($startDateStr, $endDateStr) {
            // Filter data absen berdasarkan rentang tanggal
            $filteredAbsensi = $user->absensi->whereBetween('tanggal_absen', [$startDateStr, $endDateStr]);

            // Menambahkan data user ke dalam setiap item absen
            $user->absensi = $filteredAbsensi;

            // Hitung jumlah absen berdasarkan jenis absen
            $user->jumlahHadir = $filteredAbsensi->whereIn('jenis_absen', ['masuk', 'pulang'])->count();
            $user->jumlahIzin = $filteredAbsensi->where('jenis_absen', 'izin')->count();
            $user->jumlahSakit = $filteredAbsensi->where('jenis_absen', 'sakit')->count();

            // Hitung jumlah tidak ceklok masuk dan pulang pada hari tertentu
            $tidakCeklokMasuk = $filteredAbsensi->where('jenis_absen', 'tidak ceklok masuk')->count();
            $tidakCeklokPulang = $filteredAbsensi->where('jenis_absen', 'tidak ceklok pulang')->count();
            $user->jumlahTidakCeklokMasuk = $tidakCeklokMasuk;
            $user->jumlahTidakCeklokPulang = $tidakCeklokPulang;

            $gaji = Gaji::where('uuid_user', $user->uuid)->first();
            $jumlahTidakCeklok = $tidakCeklokMasuk + $tidakCeklokPulang;
            $hasil = $jumlahTidakCeklok * 5000;

            $user->gaji = floatval($gaji->jumlah_gaji) - $hasil;

            return $user;
        });

        $row = 5;

        foreach ($combinedData as $index => $rekap) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $rekap->name);
            $sheet->setCellValue('C' . $row, $rekap->unit);
            $sheet->setCellValue('D' . $row, $rekap->jumlahHadir);
            $sheet->setCellValue('E' . $row, $rekap->jumlahIzin);
            $sheet->setCellValue('F' . $row, $rekap->jumlahSakit);
            $sheet->setCellValue('G' . $row, $rekap->jumlahTidakCeklokMasuk);
            $sheet->setCellValue('H' . $row, $rekap->jumlahTidakCeklokPulang);

            // Set nilai gaji dengan format Rupiah tanpa desimal
            $sheet->setCellValue('I' . $row, "Rp. " . number_format($rekap->gaji, 0, ',', '.'));

            $row++;
        }

        // Ambil objek kolom terakhir yang memiliki data (A, B, C, dst.)
        $lastColumn = $sheet->getHighestDataColumn();

        // Iterate melalui kolom-kolom yang memiliki data dan atur lebar kolomnya
        foreach (range('A', $lastColumn) as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Menerapkan style alignment untuk seluruh sel dalam spreadsheet
        $sheet->getStyle('A1:' . $lastColumn . $row)->applyFromArray([
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        // Memberikan border ke seluruh sel di kolom
        $sheet->getStyle('A3:' . 'I' . ($row - 1))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        $excelFileName = 'laporan_' . $startDateStr . ' Sampai ' . $endDateStr . '.xlsx';
        $excelFilePath = public_path($excelFileName);
        $writer = new Xlsx($spreadsheet);
        $writer->save($excelFilePath);

        // Kembalikan response dengan file PDF yang diunduh
        return response()->download(public_path($excelFileName));
    }

    public function exportToPDF($params)
    {
        // Memisahkan tanggal berdasarkan kata kunci "to"
        $dateParts = explode(' to ', $params);

        // $dateParts[0] akan berisi tanggal awal dan $dateParts[1] akan berisi tanggal akhir
        $startDateStr = trim($dateParts[0]);
        $endDateStr = trim($dateParts[1]);

        // Buat objek mPDF dengan orientasi lanskap
        //$mpdf = new Mpdf(['orientation' => 'L']);
        $mpdf = new \Mpdf\Mpdf(['format' => 'Legal']);

        $absen = Absen::all();
        $userUuids = $absen->pluck('uuid_user')->unique();

        // Menggunakan metode with untuk memuat data absensi bersamaan dengan data pengguna
        $users = User::whereIn('uuid', $userUuids)->with('absensi')->get();

        // Gabungkan data absen dan data user
        $combinedData = $users->map(function ($user) use ($startDateStr, $endDateStr) {
            // Filter data absen berdasarkan rentang tanggal
            $filteredAbsensi = $user->absensi->whereBetween('tanggal_absen', [$startDateStr, $endDateStr]);

            // Menambahkan data user ke dalam setiap item absen
            $user->absensi = $filteredAbsensi;

            // Hitung jumlah absen berdasarkan jenis absen
            $user->jumlahHadir = $filteredAbsensi->whereIn('jenis_absen', ['masuk', 'pulang'])->count();
            $user->jumlahIzin = $filteredAbsensi->where('jenis_absen', 'izin')->count();
            $user->jumlahSakit = $filteredAbsensi->where('jenis_absen', 'sakit')->count();

            // Hitung jumlah tidak ceklok masuk dan pulang pada hari tertentu
            $tidakCeklokMasuk = $filteredAbsensi->where('jenis_absen', 'tidak ceklok masuk')->count();
            $tidakCeklokPulang = $filteredAbsensi->where('jenis_absen', 'tidak ceklok pulang')->count();
            $user->jumlahTidakCeklokMasuk = $tidakCeklokMasuk;
            $user->jumlahTidakCeklokPulang = $tidakCeklokPulang;

            $gaji = Gaji::where('uuid_user', $user->uuid)->first();
            $jumlahTidakCeklok = $tidakCeklokMasuk + $tidakCeklokPulang;
            $hasil = $jumlahTidakCeklok * 5000;

            $user->gaji = $gaji->jumlah_gaji - $hasil;

            return $user;
        });

        // Contoh konten PDF
        $html = view('admin.rekap.pdf', compact('combinedData', 'startDateStr', 'endDateStr'))->render();

        // Tambahkan konten ke PDF
        $mpdf->WriteHTML($html);

        // Tampilkan PDF di browser (inline) dengan orientasi lanskap
        $mpdf->Output('laporan_' . $startDateStr . ' Sampai ' . $endDateStr . '.pdf', 'I');
    }
}
