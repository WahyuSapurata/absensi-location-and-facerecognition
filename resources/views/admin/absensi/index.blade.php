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
@section('script')
    <script>
        let control = new Control();

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
        }];

        $(function() {
            control.initDatatable('/admin/absensi-data', columns);
        })
    </script>
@endsection
