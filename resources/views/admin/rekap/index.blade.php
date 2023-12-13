@extends('layouts.layout')
@section('button')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
            data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
            class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <input type="text" id="tanggal" class="form-control kt_datepicker_7" name="tanggal"
                placeholder="Pilih Tanggal">
            <!--end::Title-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <!--begin::Secondary button-->
            <a href="#" id="export-excel" data-type="excel" class="btn btn-sm btn-success d-flex"
                style="gap: 5px"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M9.14933 1.3335H4.44445C3.97295 1.3335 3.52076 1.50909 3.18737 1.82165C2.85397 2.13421 2.66667 2.55814 2.66667 3.00016V13.0002C2.66667 13.4422 2.85397 13.8661 3.18737 14.1787C3.52076 14.4912 3.97295 14.6668 4.44445 14.6668H11.5556C12.0271 14.6668 12.4792 14.4912 12.8126 14.1787C13.146 13.8661 13.3333 13.4422 13.3333 13.0002V5.256C13.3333 5.035 13.2396 4.82307 13.0729 4.66683L9.77778 1.57766C9.61112 1.42137 9.38506 1.33354 9.14933 1.3335ZM9.33333 4.25016V2.5835L12 5.0835H10.2222C9.98648 5.0835 9.76038 4.9957 9.59368 4.83942C9.42698 4.68314 9.33333 4.47118 9.33333 4.25016ZM6.11911 6.90016L8 9.016L9.88089 6.89933C9.95645 6.81446 10.0649 6.76121 10.1823 6.75128C10.2998 6.74136 10.4166 6.77558 10.5071 6.84641C10.5976 6.91725 10.6544 7.0189 10.665 7.129C10.6756 7.23909 10.6391 7.34863 10.5636 7.4335L8.57867 9.66683L10.5636 11.9002C10.6357 11.9854 10.6694 12.0936 10.6575 12.2018C10.6456 12.3101 10.5891 12.4096 10.4999 12.4792C10.4108 12.5489 10.2961 12.5831 10.1805 12.5745C10.0648 12.566 9.95729 12.5154 9.88089 12.4335L8 10.3177L6.11911 12.4343C6.04355 12.5192 5.93513 12.5725 5.81769 12.5824C5.70025 12.5923 5.58342 12.5581 5.49289 12.4872C5.40236 12.4164 5.34556 12.3148 5.33497 12.2047C5.32439 12.0946 5.36089 11.985 5.43645 11.9002L7.42133 9.66683L5.43645 7.4335C5.39742 7.39168 5.36772 7.34297 5.34907 7.29023C5.33043 7.2375 5.32322 7.18179 5.32788 7.12641C5.33254 7.07102 5.34896 7.01706 5.37619 6.96772C5.40342 6.91837 5.4409 6.87462 5.48642 6.83906C5.53195 6.80349 5.58461 6.77681 5.64129 6.76061C5.69798 6.7444 5.75755 6.73898 5.8165 6.74467C5.87545 6.75037 5.93259 6.76706 5.98456 6.79376C6.03653 6.82046 6.08228 6.85664 6.11911 6.90016Z"
                        fill="white" />
                    <mask id="mask0_198_8745" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="2" y="1"
                        width="12" height="14">
                        <path
                            d="M9.14933 1.3335H4.44445C3.97295 1.3335 3.52076 1.50909 3.18737 1.82165C2.85397 2.13421 2.66667 2.55814 2.66667 3.00016V13.0002C2.66667 13.4422 2.85397 13.8661 3.18737 14.1787C3.52076 14.4912 3.97295 14.6668 4.44445 14.6668H11.5556C12.0271 14.6668 12.4792 14.4912 12.8126 14.1787C13.146 13.8661 13.3333 13.4422 13.3333 13.0002V5.256C13.3333 5.035 13.2396 4.82307 13.0729 4.66683L9.77778 1.57766C9.61112 1.42137 9.38506 1.33354 9.14933 1.3335ZM9.33333 4.25016V2.5835L12 5.0835H10.2222C9.98648 5.0835 9.76038 4.9957 9.59368 4.83942C9.42698 4.68314 9.33333 4.47118 9.33333 4.25016ZM6.11911 6.90016L8 9.016L9.88089 6.89933C9.95645 6.81446 10.0649 6.76121 10.1823 6.75128C10.2998 6.74136 10.4166 6.77558 10.5071 6.84641C10.5976 6.91725 10.6544 7.0189 10.665 7.129C10.6756 7.23909 10.6391 7.34863 10.5636 7.4335L8.57867 9.66683L10.5636 11.9002C10.6357 11.9854 10.6694 12.0936 10.6575 12.2018C10.6456 12.3101 10.5891 12.4096 10.4999 12.4792C10.4108 12.5489 10.2961 12.5831 10.1805 12.5745C10.0648 12.566 9.95729 12.5154 9.88089 12.4335L8 10.3177L6.11911 12.4343C6.04355 12.5192 5.93513 12.5725 5.81769 12.5824C5.70025 12.5923 5.58342 12.5581 5.49289 12.4872C5.40236 12.4164 5.34556 12.3148 5.33497 12.2047C5.32439 12.0946 5.36089 11.985 5.43645 11.9002L7.42133 9.66683L5.43645 7.4335C5.39742 7.39168 5.36772 7.34297 5.34907 7.29023C5.33043 7.2375 5.32322 7.18179 5.32788 7.12641C5.33254 7.07102 5.34896 7.01706 5.37619 6.96772C5.40342 6.91837 5.4409 6.87462 5.48642 6.83906C5.53195 6.80349 5.58461 6.77681 5.64129 6.76061C5.69798 6.7444 5.75755 6.73898 5.8165 6.74467C5.87545 6.75037 5.93259 6.76706 5.98456 6.79376C6.03653 6.82046 6.08228 6.85664 6.11911 6.90016Z"
                            fill="white" />
                    </mask>
                    <g mask="url(#mask0_198_8745)">
                        <rect width="16" height="16" fill="white" />
                    </g>
                </svg>
                Export Excel</a>
            <!--end::Secondary a-->
            <!--begin::Primary a-->
            <a href="#" id="export-pdf" data-type="pdf" class="btn btn-sm btn-danger d-flex" style="gap: 5px"><svg
                    width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M4.00001 1.3335H9.33334L13.3333 5.3335V13.3335C13.3333 13.6871 13.1929 14.0263 12.9428 14.2763C12.6928 14.5264 12.3536 14.6668 12 14.6668H4.00001C3.64638 14.6668 3.30724 14.5264 3.0572 14.2763C2.80715 14.0263 2.66667 13.6871 2.66667 13.3335V2.66683C2.66667 2.31321 2.80715 1.97407 3.0572 1.72402C3.30724 1.47397 3.64638 1.3335 4.00001 1.3335ZM5.468 11.0735C5.822 11.0735 6.126 10.9868 6.33201 10.7935C6.48934 10.6435 6.576 10.4228 6.57667 10.1615C6.57667 9.9015 6.462 9.68083 6.29267 9.54616C6.11467 9.40416 5.85067 9.3335 5.47934 9.3335C5.20742 9.32976 4.93564 9.34804 4.66667 9.38816V12.0122H5.26267V11.0615C5.33076 11.0702 5.39937 11.0742 5.468 11.0735ZM7.64334 12.0402C8.164 12.0402 8.59 11.9295 8.87001 11.6968C9.126 11.4802 9.31201 11.1288 9.31201 10.6202C9.31201 10.1502 9.13867 9.82283 8.862 9.6175C8.606 9.42416 8.278 9.3335 7.77334 9.3335C7.50143 9.33106 7.22974 9.34956 6.96067 9.38883V12.0002C7.11067 12.0202 7.33134 12.0402 7.64334 12.0402ZM10.312 9.84683H11.3333V9.3535H9.708V12.0128H10.312V10.9435H11.2667V10.4542H10.312V9.84683ZM8.66667 6.00016H9.33334H12L8.66667 2.66683V6.00016ZM5.26303 9.81086C5.30569 9.79886 5.38836 9.78687 5.51103 9.78687C5.81103 9.78687 5.98036 9.93353 5.98036 10.1775C5.98036 10.4502 5.78369 10.6115 5.46436 10.6115C5.37703 10.6115 5.31369 10.6082 5.26303 10.5962V9.81086ZM7.56436 9.81886C7.61569 9.80686 7.70236 9.79487 7.83569 9.79487C8.35303 9.79487 8.67636 10.0869 8.67236 10.6402C8.67236 11.2749 8.31769 11.5749 7.77303 11.5709C7.69836 11.5709 7.61569 11.5709 7.56436 11.5589V9.81886Z"
                        fill="white" />
                    <mask id="mask0_198_8791" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="2" y="1"
                        width="12" height="14">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M4.00001 1.3335H9.33334L13.3333 5.3335V13.3335C13.3333 13.6871 13.1929 14.0263 12.9428 14.2763C12.6928 14.5264 12.3536 14.6668 12 14.6668H4.00001C3.64638 14.6668 3.30724 14.5264 3.0572 14.2763C2.80715 14.0263 2.66667 13.6871 2.66667 13.3335V2.66683C2.66667 2.31321 2.80715 1.97407 3.0572 1.72402C3.30724 1.47397 3.64638 1.3335 4.00001 1.3335ZM5.468 11.0735C5.822 11.0735 6.126 10.9868 6.33201 10.7935C6.48934 10.6435 6.576 10.4228 6.57667 10.1615C6.57667 9.9015 6.462 9.68083 6.29267 9.54616C6.11467 9.40416 5.85067 9.3335 5.47934 9.3335C5.20742 9.32976 4.93564 9.34804 4.66667 9.38816V12.0122H5.26267V11.0615C5.33076 11.0702 5.39937 11.0742 5.468 11.0735ZM7.64334 12.0402C8.164 12.0402 8.59 11.9295 8.87001 11.6968C9.126 11.4802 9.31201 11.1288 9.31201 10.6202C9.31201 10.1502 9.13867 9.82283 8.862 9.6175C8.606 9.42416 8.278 9.3335 7.77334 9.3335C7.50143 9.33106 7.22974 9.34956 6.96067 9.38883V12.0002C7.11067 12.0202 7.33134 12.0402 7.64334 12.0402ZM10.312 9.84683H11.3333V9.3535H9.708V12.0128H10.312V10.9435H11.2667V10.4542H10.312V9.84683ZM8.66667 6.00016H9.33334H12L8.66667 2.66683V6.00016ZM5.26303 9.81086C5.30569 9.79886 5.38836 9.78687 5.51103 9.78687C5.81103 9.78687 5.98036 9.93353 5.98036 10.1775C5.98036 10.4502 5.78369 10.6115 5.46436 10.6115C5.37703 10.6115 5.31369 10.6082 5.26303 10.5962V9.81086ZM7.56436 9.81886C7.61569 9.80686 7.70236 9.79487 7.83569 9.79487C8.35303 9.79487 8.67636 10.0869 8.67236 10.6402C8.67236 11.2749 8.31769 11.5749 7.77303 11.5709C7.69836 11.5709 7.61569 11.5709 7.56436 11.5589V9.81886Z"
                            fill="white" />
                    </mask>
                    <g mask="url(#mask0_198_8791)">
                        <rect width="16" height="16" fill="white" />
                    </g>
                </svg>

                Export PDF</a>
            <!--end::Primary button-->
        </div>
        <!--end::Actions-->
    </div>
@endsection
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
                                            <th rowspan="2">No</th>
                                            <th rowspan="2">Nama</th>
                                            <th colspan="6">Absensi</th>
                                            <th rowspan="2">Rekap Gaji</th>
                                        </tr>
                                        <tr class="fw-bolder fs-6 text-gray-800">
                                            <td>Unit</td>
                                            <td>Hadir</td>
                                            <td>Sakit</td>
                                            <td>Izin</td>
                                            <td>Tidak Ceklok Masuk</td>
                                            <td>Tidak Ceklok Pulang</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <div class="tanggal-proide">Pilih Tanggal Priode</div>
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

        $(".kt_datepicker_7").flatpickr({
            altInput: true,
            altFormat: "d-m-Y",
            dateFormat: "d-m-Y",
            mode: "range",
            onClose: function(selectedDates, dateStr, instance) {
                // Tangkap perubahan tanggal dan kirimkan data ke server
                $('.tanggal-proide').empty();
                sendDataToServer(dateStr);
            }
        });

        function sendDataToServer(selectedDateStr) {
            let columns = [{
                data: null,
                className: 'text-center',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            }, {
                data: null,
                className: 'text-center',
                render: function(data, type, row) {
                    // Periksa apakah jam_absen null atau tidak
                    if (row.name !== 0) {
                        return row.name;
                    } else {
                        // Tampilkan garis mendatar atau elemen lain jika jam_absen null
                        return '-'; // Anda dapat mengganti ini dengan elemen atau tata letak lainnya
                    }
                }
            }, {
                data: null,
                className: 'text-center',
                render: function(data, type, row) {
                    // Periksa apakah jam_absen null atau tidak
                    if (row.unit !== 0) {
                        return row.unit;
                    } else {
                        // Tampilkan garis mendatar atau elemen lain jika jam_absen null
                        return '-'; // Anda dapat mengganti ini dengan elemen atau tata letak lainnya
                    }
                }
            }, {
                data: null,
                className: 'text-center',
                render: function(data, type, row) {
                    // Periksa apakah jam_absen null atau tidak
                    if (row.jumlahHadir !== 0) {
                        return row.jumlahHadir;
                    } else {
                        // Tampilkan garis mendatar atau elemen lain jika jam_absen null
                        return '-'; // Anda dapat mengganti ini dengan elemen atau tata letak lainnya
                    }
                }
            }, {
                data: null,
                className: 'text-center',
                render: function(data, type, row) {
                    // Periksa apakah jam_absen null atau tidak
                    if (row.jumlahSakit !== 0) {
                        return row.jumlahSakit;
                    } else {
                        // Tampilkan garis mendatar atau elemen lain jika jam_absen null
                        return '-'; // Anda dapat mengganti ini dengan elemen atau tata letak lainnya
                    }
                }
            }, {
                data: null,
                className: 'text-center',
                render: function(data, type, row) {
                    // Periksa apakah jam_absen null atau tidak
                    if (row.jumlahIzin !== 0) {
                        return row.jumlahIzin;
                    } else {
                        // Tampilkan garis mendatar atau elemen lain jika jam_absen null
                        return '-'; // Anda dapat mengganti ini dengan elemen atau tata letak lainnya
                    }
                }
            }, {
                data: null,
                className: 'text-center',
                render: function(data, type, row) {
                    // Periksa apakah jam_absen null atau tidak
                    if (row.jumlahTidakCeklokMasuk !== 0) {
                        return row.jumlahTidakCeklokMasuk;
                    } else {
                        // Tampilkan garis mendatar atau elemen lain jika jam_absen null
                        return '-'; // Anda dapat mengganti ini dengan elemen atau tata letak lainnya
                    }
                }
            }, {
                data: null,
                className: 'text-center',
                render: function(data, type, row) {
                    // Periksa apakah jam_absen null atau tidak
                    if (row.jumlahTidakCeklokPulang !== 0) {
                        return row.jumlahTidakCeklokPulang;
                    } else {
                        // Tampilkan garis mendatar atau elemen lain jika jam_absen null
                        return '-'; // Anda dapat mengganti ini dengan elemen atau tata letak lainnya
                    }
                }
            }, {
                data: null,
                className: 'text-center',
                render: function(data, type, row) {
                    // Periksa apakah jam_absen null atau tidak
                    if (row.gaji !== 0) {
                        const value = numeral(row.gaji).format('0,0'); // Format to rupiah
                        return 'Rp ' + value;
                    } else {
                        // Tampilkan garis mendatar atau elemen lain jika jam_absen null
                        return '-'; // Anda dapat mengganti ini dengan elemen atau tata letak lainnya
                    }
                }
            }];

            $(function() {
                control.initDatatable(`/admin/get-rekap/${selectedDateStr}`, columns);
            })
        }

        $(document).on('keyup', '#search_', function(e) {
            e.preventDefault();
            control.searchTable(this.value);
        });

        $('#export-excel, #export-pdf').click(function(e) {
            e.preventDefault();
            let val = $('#tanggal').val();
            let type = $(this).attr('data-type');

            if (!val) {
                swal
                    .fire({
                        text: `Pilih tanggal priode terlebih dahulu`,
                        icon: "warning",
                        showConfirmButton: false,
                        timer: 1500,
                    })
                return;
            }

            if (type == 'excel') {
                window.open(`/admin/export-excel/${val}`, "_blank");
            } else {
                window.open(`/admin/export-pdf/${val}`, "_blank");
            }
        });
    </script>
@endsection
