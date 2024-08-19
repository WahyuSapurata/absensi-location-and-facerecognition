@extends('layouts.layout')
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container">
            <div class="row">

                <div class="card">
                    <div class="card-body p-0">
                        <div class="container">
                            <div class="py-5 table-responsive">
                                <table id="kt_table_data"
                                    class="table table-striped table-rounded border border-gray-300 table-row-bordered table-row-gray-300">
                                    <thead class="text-center">
                                        <tr class="fw-bolder fs-6 text-gray-800">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Jam Absen</th>
                                            <th>Tanggal Absen</th>
                                            <th>Lokasi</th>
                                            <th>Foto</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
@section('side-form')
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
                        <label class="form-label">Jam Absen</label>
                        <input type="text" id="jam_absen" class="form-control" name="jam_absen">
                        <small class="text-danger jam_absen_error"></small>
                    </div>

                    <div class="mb-10">
                        <label class="form-label">Tanggal Absen</label>
                        <input type="text" id="tanggal_absen" class="form-control" name="tanggal_absen">
                        <small class="text-danger tanggal_absen_error"></small>
                    </div>

                    <div class="mb-10">
                        <label class="form-label">Lokasi</label>
                        <input type="text" id="lokasi" class="form-control" name="lokasi">
                        <small class="text-danger lokasi_error"></small>
                    </div>

                    <div class="mb-10">
                        <label class="form-label">Status</label>
                        <input type="text" id="status" class="form-control" name="status">
                        <small class="text-danger status_error"></small>
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
@endsection
@section('script')
    <script>
        let control = new Control();

        $(document).on('click', '.button-update', function(e) {
            e.preventDefault();
            let url = '/admin/show-absensi/' + $(this).attr('data-uuid');
            control.overlay_form('Update', 'Absensi', url);
        });

        $(document).on('submit', ".form-data", function(e) {
            e.preventDefault();
            let uuid = $("input[name='uuid']").val();
            control.submitFormMultipartData('/admin/update-absensi/' + uuid, 'Update',
                'Absensi', 'POST');
        });

        $(document).on('keyup', '#search_', function(e) {
            e.preventDefault();
            control.searchTable(this.value);
        })

        let columns = [{
            data: null,
            className: 'text-center',
            render: function(data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        }, {
            data: 'user',
            className: 'text-center',
            render: function(data, type, row) {
                // Periksa apakah jam_absen null atau tidak
                if (row.user !== null) {
                    return row.user;
                } else {
                    // Tampilkan garis mendatar atau elemen lain jika jam_absen null
                    return '-'; // Anda dapat mengganti ini dengan elemen atau tata letak lainnya
                }
            }
        }, {
            data: 'jam_absen',
            className: 'text-center',
            render: function(data, type, row) {
                // Periksa apakah jam_absen null atau tidak
                if (row.jam_absen !== null) {
                    return row.jam_absen;
                } else {
                    // Tampilkan garis mendatar atau elemen lain jika jam_absen null
                    return '-'; // Anda dapat mengganti ini dengan elemen atau tata letak lainnya
                }
            }
        }, {
            data: 'tanggal_absen',
            className: 'text-center',
            render: function(data, type, row) {
                // Periksa apakah jam_absen null atau tidak
                if (row.tanggal_absen !== null) {
                    return row.tanggal_absen;
                } else {
                    // Tampilkan garis mendatar atau elemen lain jika jam_absen null
                    return '-'; // Anda dapat mengganti ini dengan elemen atau tata letak lainnya
                }
            }
        }, {
            data: 'lokasi',
            className: 'text-center',
            render: function(data, type, row) {
                // Periksa apakah jam_absen null atau tidak
                if (row.lokasi !== null) {
                    return row.lokasi;
                } else {
                    // Tampilkan garis mendatar atau elemen lain jika jam_absen null
                    return '-'; // Anda dapat mengganti ini dengan elemen atau tata letak lainnya
                }
            }
        }, {
            data: null,
            className: 'text-center',
            render: function(data, type, row, meta) {
                let result =
                    `
                        <img src="{{ asset('absen/${row.foto_absen}') }}" style="max-width: 100%;" alt="no foto">
                    `;
                return result;
            }
        }, {
            data: 'jenis_absen',
            className: 'text-center',
            render: function(data, type, row) {
                // Periksa apakah jam_absen null atau tidak
                if (data == 'masuk' || data == 'pulang') {
                    return 'Hadir';
                } else if (data == 'tidak ceklok masuk' || data == 'tidak ceklok pulang') {
                    return 'Telat';
                } else if (data == 'izin') {
                    return 'Izin';
                } else if (data == 'sakit') {
                    return 'Sakit';
                }
            }
        }, {
            data: 'ket',
            className: 'text-center',
            render: function(data, type, row) {
                // Periksa apakah jam_absen null atau tidak
                if (row.ket !== null) {
                    return row.ket;
                } else {
                    // Tampilkan garis mendatar atau elemen lain jika jam_absen null
                    return '-'; // Anda dapat mengganti ini dengan elemen atau tata letak lainnya
                }
            }
        }, {
            data: 'uuid',
        }];
        let columnDefs = [{
            targets: -1,
            className: 'text-center',
            title: 'Aksi',
            width: '8rem',
            orderable: false,
            render: function(data, type, full, meta) {
                return `
                    <a href="javascript:;" type="button" data-uuid="${data}" data-kt-drawer-show="true" data-kt-drawer-target="#side_form" class="btn btn-primary button-update btn-icon btn-sm">
                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.5 16.2738C3.5 17.8891 4.80945 19.1986 6.42474 19.1986H10.8479L11.1681 17.9178C11.3139 17.3347 11.6155 16.8022 12.0405 16.3771L17.3522 11.0655C17.9947 10.423 18.8591 10.138 19.6986 10.2103V5.92474C19.6986 4.30945 18.3891 3 16.7738 3H10.6994V7.27463C10.6994 8.88992 9.38992 10.1994 7.77463 10.1994H3.5V16.2738ZM9.34949 3.39597L3.89597 8.84949H7.77463C8.6444 8.84949 9.34949 8.1444 9.34949 7.27463V3.39597ZM17.9886 11.7018L12.6769 17.0135C12.3672 17.3231 12.1475 17.7112 12.0412 18.1361L11.6293 19.7836C11.4503 20.5 12.0993 21.1491 12.8157 20.9699L14.4632 20.558C14.8881 20.4518 15.2761 20.2321 15.5859 19.9224L20.8975 14.6107C21.7008 13.8074 21.7008 12.5051 20.8975 11.7018C20.0943 10.8984 18.7919 10.8984 17.9886 11.7018Z" fill="white"/>
                    <mask id="mask0_1953_23043" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="3" y="3" width="19" height="18">
                    <path d="M3.5 16.2738C3.5 17.8891 4.80945 19.1986 6.42474 19.1986H10.8479L11.1681 17.9178C11.3139 17.3347 11.6155 16.8022 12.0405 16.3771L17.3522 11.0655C17.9947 10.423 18.8591 10.138 19.6986 10.2103V5.92474C19.6986 4.30945 18.3891 3 16.7738 3H10.6994V7.27463C10.6994 8.88992 9.38992 10.1994 7.77463 10.1994H3.5V16.2738ZM9.34949 3.39597L3.89597 8.84949H7.77463C8.6444 8.84949 9.34949 8.1444 9.34949 7.27463V3.39597ZM17.9886 11.7018L12.6769 17.0135C12.3672 17.3231 12.1475 17.7112 12.0412 18.1361L11.6293 19.7836C11.4503 20.5 12.0993 21.1491 12.8157 20.9699L14.4632 20.558C14.8881 20.4518 15.2761 20.2321 15.5859 19.9224L20.8975 14.6107C21.7008 13.8074 21.7008 12.5051 20.8975 11.7018C20.0943 10.8984 18.7919 10.8984 17.9886 11.7018Z" fill="white"/>
                    </mask>
                    <g mask="url(#mask0_1953_23043)">
                    <rect x="0.5" width="24" height="24" fill="white"/>
                    </g>
                    </svg>
                `;
            },
        }];

        $(function() {
            control.initDatatable('/admin/absensi-data', columns, columnDefs);
        })
    </script>
@endsection
