@extends('layouts.layout')
@vite('resources/js/face-api.js')
@section('button')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
            data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
            class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <a href="{{ url()->previous() }}" class="btn btn-info btn-sm"><i class="fa fa-arrow-left" style="color:#ffffff"
                    aria-hidden="true"></i>
                Kembali</a>
            <!--end::Title-->
        </div>
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
                            <div class="py-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex justify-content-center mb-3"
                                            style="border: 3px solid #41b64a; border-radius: 5px; width: max-content">
                                            <img id="capturedImage" style="width: 250px; border-radius: 5px"
                                                src="/admin/assets/media/avatars/blank.png" alt="">
                                        </div>
                                        <button class="btn btn-success p-2 px-4" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_1">Buka Kamera</button>

                                        <div class="modal fade" tabindex="-1" id="kt_modal_1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title">Kamera</h3>

                                                        <!--begin::Close-->
                                                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            <span class="svg-icon svg-icon-1"></span>
                                                        </div>
                                                        <!--end::Close-->
                                                    </div>

                                                    <div class="modal-body">
                                                        <video id="video" style="width: 100%" autoplay></video>
                                                        <canvas id="canvas" style="display: none;"></canvas>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="button" id="captureButton"
                                                            class="btn btn-primary">Ambil
                                                            Gambar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-10">
                                            <label class="form-label">Jam Absen</label>
                                            <input type="text" id="jam_absen" class="form-control kt_datepicker_8"
                                                disabled name="jam_absen">
                                            <small class="text-danger jam_absen_error"></small>
                                        </div>

                                        <div class="mb-10">
                                            <label class="form-label">Tanggal Absen</label>
                                            <input type="text" id="tanggal_absen" class="form-control kt_datepicker_8"
                                                disabled name="tanggal_absen">
                                            <small class="text-danger tanggal_absen_error"></small>
                                        </div>

                                        <div class="mb-10">
                                            <label class="form-label">Lokasi</label>
                                            <input type="text" id="lokasi" class="form-control kt_datepicker_8"
                                                disabled name="lokasi">
                                            <small class="text-danger lokasi_error"></small>
                                        </div>

                                        <div class="separator separator-dashed mt-8 mb-5"></div>
                                        <div class="d-flex gap-5">
                                            <button type="submit" id="kirim" data-url="/guru/absen" data-absen="pulang"
                                                class="btn btn-primary btn-sm btn-submit d-flex align-items-center"><i
                                                    class="bi bi-file-earmark-diff"></i> Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
    </div>
@endsection
