@extends('layouts.layout')
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="fs-1 text-center text-capitalize">Selamat Datang {{ auth()->user()->name }}</div>
                </div>
            </div>

            <div class="row mt-5 justify-content-center">
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-5">
                                <svg id="masuk" xmlns="http://www.w3.org/2000/svg" height="25" width="25"
                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                    <style>
                                        #masuk {
                                            fill: #2b3674
                                        }
                                    </style>
                                    <path
                                        d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z" />
                                </svg>
                                <div>
                                    <div class="fs-6">Total Absen Masuk</div>
                                    <div class="fs-5" id="total-pendapatan">{{ $absen_masuk }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-5">
                                <svg id="pulang" xmlns="http://www.w3.org/2000/svg" height="25" width="29px"
                                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                    <style>
                                        #pulang {
                                            fill: #2b3674
                                        }
                                    </style>
                                    <path
                                        d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
                                </svg>
                                <div>
                                    <div class="fs-6">Total Absen Pulang</div>
                                    <div class="fs-5" id="total-pengeluaran">{{ $absen_pulang }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-5">
                                <svg id="gaji" xmlns="http://www.w3.org/2000/svg" height="25" width="29px"
                                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                    <style>
                                        #gaji {
                                            fill: #2b3674
                                        }
                                    </style>
                                    <path
                                        d="M320 96L192 96 144.6 24.9C137.5 14.2 145.1 0 157.9 0L354.1 0c12.8 0 20.4 14.2 13.3 24.9L320 96zM192 128l128 0c3.8 2.5 8.1 5.3 13 8.4C389.7 172.7 512 250.9 512 416c0 53-43 96-96 96L96 512c-53 0-96-43-96-96C0 250.9 122.3 172.7 179 136.4c0 0 0 0 0 0s0 0 0 0c4.8-3.1 9.2-5.9 13-8.4zm84 88c0-11-9-20-20-20s-20 9-20 20l0 14c-7.6 1.7-15.2 4.4-22.2 8.5c-13.9 8.3-25.9 22.8-25.8 43.9c.1 20.3 12 33.1 24.7 40.7c11 6.6 24.7 10.8 35.6 14l1.7 .5c12.6 3.8 21.8 6.8 28 10.7c5.1 3.2 5.8 5.4 5.9 8.2c.1 5-1.8 8-5.9 10.5c-5 3.1-12.9 5-21.4 4.7c-11.1-.4-21.5-3.9-35.1-8.5c-2.3-.8-4.7-1.6-7.2-2.4c-10.5-3.5-21.8 2.2-25.3 12.6s2.2 21.8 12.6 25.3c1.9 .6 4 1.3 6.1 2.1c0 0 0 0 0 0s0 0 0 0c8.3 2.9 17.9 6.2 28.2 8.4l0 14.6c0 11 9 20 20 20s20-9 20-20l0-13.8c8-1.7 16-4.5 23.2-9c14.3-8.9 25.1-24.1 24.8-45c-.3-20.3-11.7-33.4-24.6-41.6c-11.5-7.2-25.9-11.6-37.1-15c0 0 0 0 0 0l-.7-.2c-12.8-3.9-21.9-6.7-28.3-10.5c-5.2-3.1-5.3-4.9-5.3-6.7c0-3.7 1.4-6.5 6.2-9.3c5.4-3.2 13.6-5.1 21.5-5c9.6 .1 20.2 2.2 31.2 5.2c10.7 2.8 21.6-3.5 24.5-14.2s-3.5-21.6-14.2-24.5c-6.5-1.7-13.7-3.4-21.1-4.7l0-13.9z" />
                                </svg>
                                <div>
                                    <div class="fs-6">Total Gaji</div>
                                    <div class="fs-5" id="total-pengeluaran">
                                        {{ 'Rp ' . number_format($total_gaji, 0, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator separator-dashed mt-8 mb-5"></div>

            <div class="card mt-5">
                <div class="card-body p-0">
                    <div class="container">
                        <div class="py-5 table-responsive">
                            <table
                                class="table table-striped table-rounded border border-gray-300 table-row-bordered table-row-gray-300">
                                <thead class="text-center">
                                    <tr class="fw-bolder fs-6 text-gray-800">
                                        <th>Status</th>
                                        <th>Absen Masuk</th>
                                        <th>Absen Pulang</th>
                                        <th>Izin</th>
                                        <th>Sakit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td class="d-flex justify-content-center">
                                            <div id="alert-absen"></div>
                                        </td>
                                        <td>
                                            <a href="{{ route('guru.absen-masuk') }}" id="absenMasuk"
                                                class="btn btn-bg-primary py-2">Absen Masuk</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('guru.absen-pulang') }}" id="absenPulang"
                                                class="btn btn-bg-primary py-2">Absen Pulang</a>
                                        </td>
                                        <td>
                                            <button data-bs-toggle="modal" data-bs-target="#kt_modal_1"
                                                class="btn btn-bg-primary py-2">Izin</button>
                                        </td>
                                        <td>
                                            <button data-bs-toggle="modal" data-bs-target="#kt_modal_2"
                                                class="btn btn-bg-primary py-2">Sakit</button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" tabindex="-1" id="kt_modal_1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Form Izin</h3>

                                                    <!--begin::Close-->
                                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        <span class="svg-icon svg-icon-1"></span>
                                                    </div>
                                                    <!--end::Close-->
                                                </div>

                                                <div class="modal-body">
                                                    <div class="mb-10">
                                                        <label class="form-label">Jam Absen</label>
                                                        <input type="text" id="jam_absen"
                                                            class="form-control kt_datepicker_8 jam_absen" disabled
                                                            name="jam_absen">
                                                        <small class="text-danger jam_absen_error"></small>
                                                    </div>

                                                    <div class="mb-10">
                                                        <label class="form-label">Tanggal Absen</label>
                                                        <input type="text" id="tanggal_absen"
                                                            class="form-control kt_datepicker_8 tanggal_absen" disabled
                                                            name="tanggal_absen">
                                                        <small class="text-danger tanggal_absen_error"></small>
                                                    </div>

                                                    <div class="mb-10">
                                                        <label class="form-label">Ket. Izin</label>
                                                        <textarea id="ket" class="form-control" name="ket" cols="10" rows="5"></textarea>
                                                        <small class="text-danger ket_error"></small>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="button" id="button-kirim" data-absen="izin"
                                                        class="btn btn-primary">Kirim</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" tabindex="-1" id="kt_modal_2">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Form Sakit</h3>

                                                    <!--begin::Close-->
                                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        <span class="svg-icon svg-icon-1"></span>
                                                    </div>
                                                    <!--end::Close-->
                                                </div>

                                                <div class="modal-body">
                                                    <div class="mb-10">
                                                        <label class="form-label">Jam Absen</label>
                                                        <input type="text" id="jam_absen"
                                                            class="form-control kt_datepicker_8 jam_absen" disabled
                                                            name="jam_absen">
                                                        <small class="text-danger jam_absen_error"></small>
                                                    </div>

                                                    <div class="mb-10">
                                                        <label class="form-label">Tanggal Absen</label>
                                                        <input type="text" id="tanggal_absen"
                                                            class="form-control kt_datepicker_8 tanggal_absen   " disabled
                                                            name="tanggal_absen">
                                                        <small class="text-danger tanggal_absen_error"></small>
                                                    </div>

                                                    <div class="mb-10">
                                                        <label class="form-label">Foto</label>
                                                        <input type="file" accept="image/*" id="foto"
                                                            class="form-control" name="foto">
                                                        <small class="text-danger foto_error"></small>

                                                        <div class="mt-3" id="logoInfoContainer"></div>
                                                    </div>

                                                    <div class="mb-10">
                                                        <label class="form-label">Ket. Sakit</label>
                                                        <textarea id="ket" class="form-control ket_sakit" name="ket" cols="10" rows="5"></textarea>
                                                        <small class="text-danger ket_error"></small>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="button" id="button-kirim" data-absen="sakit"
                                                        class="btn btn-primary">Kirim</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
@endsection

@section('script')
    <script>
        let control = new Control();

        // Deklarasikan variabel formData di luar fungsi
        let formData = new FormData();

        // Fungsi untuk mengirim formData ke server
        $(document).on('click', "#button-kirim", function(e) {
            e.preventDefault();
            let jenisAbsen = $(this).attr('data-absen');
            formData.append('jenis_absen', jenisAbsen);
            if (jenisAbsen === 'izin') {
                formData.append('ket', $('#ket').val());
            } else if (jenisAbsen === 'sakit') {
                formData.append('ket', $('.ket_sakit').val());
            }
            control.submitFormMultipartDataAbsen('/guru/add-absen', 'Tambah',
                'Absen',
                'POST', formData);
            dataAbsen();
            $('#kt_modal_1').modal('hide');
            $('#kt_modal_2').modal('hide');
            $('#ket').val(null);
        });

        $('#foto').change(function() {
            previewImage(this);
        });

        function previewImage(input) {
            var logoInfoContainer = $('#logoInfoContainer');
            var logoError = $('.foto_error');

            // Reset error message
            logoError.text('');

            // Cek apakah file yang dipilih adalah gambar
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    // Tampilkan gambar
                    logoInfoContainer.html('<img id="img-foto" src="' + e.target.result + '" style="max-width:100%;">');

                    // Tambahkan file gambar ke formData
                    const fotoFile = input.files[0];
                    formData.append('foto_absen', fotoFile);
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                // Tampilkan pesan error jika file tidak valid
                logoError.text('Pilih file gambar yang valid.');
                logoInfoContainer.html('');
            }
        }

        const dataAbsen = async () => {
            try {
                const now = new Date();
                // Format tanggal menjadi YYYY-MM-DD
                const tahun = now.getFullYear();
                const bulan = String(now.getMonth() + 1).padStart(2, '0');
                const tanggal = String(now.getDate()).padStart(2, '0');
                const tanggalFormatted = `${tanggal}-${bulan}-${tahun}`;
                // Mendapatkan nama hari
                const options = {
                    weekday: 'long'
                }; // pilihannya bisa 'short', 'long', atau 'narrow'
                const namaHari = new Intl.DateTimeFormat('id-ID', options).format(now);

                // Format jam menjadi HH:mm
                const jam = String(now.getHours()).padStart(2, '0');
                const menit = String(now.getMinutes()).padStart(2, '0');
                const jamFormatted = `${jam}:${menit}`;

                const res = await $.ajax({
                    url: '/guru/get-absen',
                    method: 'GET',
                });

                const res_jamKerja = await $.ajax({
                    url: '/admin/get-jamkerja',
                    method: 'GET',
                });

                // if (res_jamKerja.success === true) {
                //     // Lakukan sesuatu dengan data yang diterima
                //     res_jamKerja.data.forEach(key => {
                //         if (key.hari.toLowerCase() === namaHari.toLowerCase()) {
                //             const newJamMasuk = moment(key.jam_masuk, 'HH:mm').add(1,
                //                     'hours')
                //                 .format(
                //                     'HH:mm');
                //             if (key.jam_masuk <= jamFormatted && jamFormatted <=
                //                 newJamMasuk) {
                //                 $('#absenMasuk').removeClass(
                //                     'disabled-link'); // Mengaktifkan tautan
                //             } else {
                //                 $('#absenMasuk').addClass(
                //                     'disabled-link'); // Menonaktifkan tautan
                //             }

                //             const newJamPulang = moment(key.jam_pulang, 'HH:mm').add(1,
                //                     'hours')
                //                 .format(
                //                     'HH:mm');
                //             if (key.jam_pulang <= jamFormatted && jamFormatted <=
                //                 newJamPulang) {
                //                 $('#absenPulang').removeClass(
                //                     'disabled-link'); // Mengaktifkan tautan
                //             } else {
                //                 $('#absenPulang').addClass(
                //                     'disabled-link'); // Menonaktifkan tautan
                //             }

                //         } else {
                //             $('#absenMasuk').addClass(
                //                 'disabled-link'); // Menonaktifkan tautan
                //             $('#absenPulang').addClass(
                //                 'disabled-link'); // Menonaktifkan tautan
                //         }
                //     });
                // } else {
                //     console.error('Gagal mengambil data:', res.message);
                //     // Tampilkan pesan kesalahan atau lakukan sesuatu yang sesuai
                // }

                if (res.success === true) {
                    // Lakukan sesuatu dengan data yang diterima
                    if (res.data.length === 0) {
                        $('#alert-absen').html(`
                                <div class="alert bg-light-warning border border-warning d-flex justify-content-center py-2 m-0 gap-4 align-items-center"
                                    style="max-width: max-content">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512">
                                        <style>
                                            svg {
                                                fill: #f4632a;
                                            }
                                        </style>
                                        <path
                                            d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480H40c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24V296c0 13.3 10.7 24 24 24s24-10.7 24-24V184c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z" />
                                    </svg>
                                    <div class="fw-bolder">Belum Absen</div>
                                </div>
                            `);
                    } else {
                        res.data.forEach(key => {
                            if (tanggalFormatted === key.tanggal_absen) {
                                $('#alert-absen').html(`
                                <div class="alert bg-light-success border border-success d-flex justify-content-center py-2 m-0 gap-4 align-items-center"
                                    style="max-width: max-content">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512">
                                        <style>
                                            svg {
                                                fill: #15ce21;
                                            }
                                        </style>
                                        <path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/>
                                    </svg>
                                    <div class="fw-bolder text-capitalize">${key.status}</div>
                                </div>
                            `);
                            } else {
                                $('#alert-absen').html(`
                                <div class="alert bg-light-warning border border-warning d-flex justify-content-center py-2 m-0 gap-4 align-items-center"
                                    style="max-width: max-content">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512">
                                        <style>
                                            svg {
                                                fill: #f4632a;
                                            }
                                        </style>
                                        <path
                                            d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480H40c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24V296c0 13.3 10.7 24 24 24s24-10.7 24-24V184c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z" />
                                    </svg>
                                    <div class="fw-bolder">Belum Absen</div>
                                </div>
                            `);
                            }
                        });
                    }

                } else {
                    console.error('Gagal mengambil data:', res.message);
                    // Tampilkan pesan kesalahan atau lakukan sesuatu yang sesuai
                }
            } catch (error) {
                console.error('Gagal melakukan permintaan AJAX:', error.statusText);
                // Tampilkan pesan kesalahan atau lakukan sesuatu yang sesuai
            }
        }

        $(document).ready(function() {
            dataAbsen()

            // Fungsi untuk mendapatkan jam dan tanggal saat ini
            function updateDateTime() {
                const now = new Date();

                const jamAbsenInput = $('.jam_absen');
                const tanggalAbsenInput = $('.tanggal_absen');

                // Format jam menjadi HH:mm
                const jam = String(now.getHours()).padStart(2, '0');
                const menit = String(now.getMinutes()).padStart(2, '0');
                const jamFormatted = `${jam}:${menit}`;

                // Format tanggal menjadi YYYY-MM-DD
                const tahun = now.getFullYear();
                const bulan = String(now.getMonth() + 1).padStart(2, '0');
                const tanggal = String(now.getDate()).padStart(2, '0');
                const tanggalFormatted = `${tanggal}-${bulan}-${tahun}`;

                // Isi nilai input dengan jam dan tanggal saat ini
                jamAbsenInput.val(jamFormatted);
                tanggalAbsenInput.val(tanggalFormatted);

                formData.append('jam_absen', jamFormatted);
                formData.append('tanggal_absen', tanggalFormatted);
            }

            // Panggil fungsi updateDateTime saat halaman dimuat
            $(document).ready(function() {
                updateDateTime();

                // Set interval untuk menjalankan fungsi updateDateTime setiap detik (1000 milidetik)
                setInterval(updateDateTime, 1000);
            });
        });
    </script>
@endsection
