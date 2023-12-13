@extends('layouts.layout')
{{-- @section('button')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
            data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
            class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <button class="btn btn-primary btn-sm " data-kt-drawer-show="true" data-kt-drawer-target="#side_form"
                id="button-side-form"><i class="fa fa-plus-circle" style="color:#ffffff" aria-hidden="true"></i> Tambah
                Data</button>
            <!--end::Title-->
        </div>
    </div>
@endsection --}}
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container">
            <div class="row">

                <div class="card">
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
                                                                class="form-control kt_datepicker_8 tanggal_absen   "
                                                                disabled name="tanggal_absen">
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
        </div>
        <!--end::Container-->
    </div>
@endsection
{{-- @section('side-form')
    <div id="side_form" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true"
        data-kt-drawer-toggle="#side_form_button" data-kt-drawer-close="#side_form_close" data-kt-drawer-width="500px">
        <!--begin::Card-->
        <div class="card w-100">
            <!--begin::Card header-->
            <div class="card-header pe-5">
                <!--begin::Title-->
                <div class="card-title">
                    <!--begin::User-->
                    <div class="d-flex justify-content-center flex-column me-3">
                        <a href="#"
                            class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1 title_side_form"></a>
                    </div>
                    <!--end::User-->
                </div>
                <!--end::Title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-light-primary" id="side_form_close">
                        <!--begin::Svg Icon | path: icons/duotone/Navigation/Close.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                                    fill="#000000">
                                    <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
                                    <rect fill="#000000" opacity="0.5"
                                        transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                        x="0" y="7" width="16" height="2" rx="1" />
                                </g>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body hover-scroll-overlay-y">
                <form class="form-data" enctype="multipart/form-data">

                    <input type="hidden" name="id">
                    <input type="hidden" name="uuid">

                    <div class="mb-10">
                        <label class="form-label">Hari</label>
                        <select name="hari" class="form-select" data-control="select2" id="hari_select"
                            data-placeholder="Pilih jenis inputan">
                        </select>
                        <small class="text-danger hari_error"></small>
                    </div>

                    <div class="mb-10">
                        <label class="form-label">Jam Masuk</label>
                        <input type="text" id="jam_masuk" class="form-control kt_datepicker_8" name="jam_masuk">
                        <small class="text-danger jam_masuk_error"></small>
                    </div>

                    <div class="mb-10">
                        <label class="form-label">Jam Pulang</label>
                        <input type="text" id="jam_pulang" class="form-control kt_datepicker_8" name="jam_pulang">
                        <small class="text-danger jam_pulang_error"></small>
                    </div>

                    <div class="separator separator-dashed mt-8 mb-5"></div>
                    <div class="d-flex gap-5">
                        <button type="submit" class="btn btn-primary btn-sm btn-submit d-flex align-items-center"><i
                                class="bi bi-file-earmark-diff"></i> Simpan</button>
                        <button type="reset" id="side_form_close"
                            class="btn mr-2 btn-light btn-cancel btn-sm d-flex align-items-center"
                            style="background-color: #ea443e65; color: #EA443E"><i class="bi bi-trash-fill"
                                style="color: #EA443E"></i>Batal</button>
                    </div>
                </form>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
@endsection --}}
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

                if (res_jamKerja.success === true) {
                    // Lakukan sesuatu dengan data yang diterima
                    res_jamKerja.data.forEach(key => {
                        if (key.hari.toLowerCase() === namaHari.toLowerCase()) {
                            const newJamMasuk = moment(key.jam_masuk, 'HH:mm').add(1,
                                    'hours')
                                .format(
                                    'HH:mm');
                            if (key.jam_masuk <= jamFormatted && jamFormatted <=
                                newJamMasuk) {
                                $('#absenMasuk').removeClass(
                                    'disabled-link'); // Mengaktifkan tautan
                            } else {
                                $('#absenMasuk').addClass(
                                    'disabled-link'); // Menonaktifkan tautan
                            }

                            const newJamPulang = moment(key.jam_pulang, 'HH:mm').add(1,
                                    'hours')
                                .format(
                                    'HH:mm');
                            if (key.jam_pulang <= jamFormatted && jamFormatted <=
                                newJamPulang) {
                                $('#absenPulang').removeClass(
                                    'disabled-link'); // Mengaktifkan tautan
                            } else {
                                $('#absenPulang').addClass(
                                    'disabled-link'); // Menonaktifkan tautan
                            }

                        } else {
                            $('#absenMasuk').addClass(
                                'disabled-link'); // Menonaktifkan tautan
                            $('#absenPulang').addClass(
                                'disabled-link'); // Menonaktifkan tautan
                        }
                    });
                } else {
                    console.error('Gagal mengambil data:', res.message);
                    // Tampilkan pesan kesalahan atau lakukan sesuatu yang sesuai
                }

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
