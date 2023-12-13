@extends('layouts.layout')
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container">
            <div class="row">
                <div class="card">
                    <div class="card-body p-5">
                        <form class="form-data">
                            <input type="hidden" name="id" value="{{ $akun->id }}">
                            <input type="hidden" name="uuid" value="{{ $akun->uuid }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="fw-bolder fs-4 mb-5">Detail Akun</div>
                                    <div class="card">
                                        <div class="mb-10">
                                            <label class="form-label">Nama</label>
                                            <input type="text" id="name" class="form-control" name="name"
                                                value="{{ $akun->name }}">
                                            <small class="text-danger name_error"></small>
                                        </div>

                                        <div class="mb-10">
                                            <label class="form-label">NIP</label>
                                            <input type="text" id="nip" class="form-control"
                                                value="{{ $akun->nip }}" name="nip">
                                            <small class="text-danger nip_error"></small>
                                        </div>

                                        <div class="mb-10">
                                            <label class="form-label">Email</label>
                                            <input type="email" id="email" class="form-control"
                                                value="{{ $akun->email }}" name="email">
                                            <small class="text-danger email_error"></small>
                                        </div>

                                        <div class="mb-10">
                                            <label class="form-label">Foto</label>
                                            <input type="file" accept="image/*" id="foto" class="form-control"
                                                name="foto">
                                            <small class="text-danger foto_error"></small>

                                            <div class="mt-3" id="logoInfoContainer">
                                                <img id="img-foto" src="{{ asset('/storage/foto/' . $akun->foto) }}"
                                                    alt="no foto" style="max-width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="fw-bolder fs-4 mb-5">Ganti Password Akun</div>
                                    <div class="card">
                                        <div class="mb-10" data-kt-password-meter="true">
                                            <label class="form-label">Password Lama</label>
                                            <div class="position-relative">
                                                <input class="form-control bg-transparent" id="password_lama"
                                                    type="password" name="password_lama" autocomplete="off" />
                                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50"
                                                    style="right: -15px;" data-kt-password-meter-control="visibility">
                                                    <i class="bi bi-eye-slash fs-2"></i>
                                                    <i class="bi bi-eye fs-2 d-none"></i>
                                                </span>
                                                <small class="text-danger password_lama_error"></small>
                                            </div>
                                        </div>
                                        <div class="mb-10" data-kt-password-meter="true">
                                            <label class="form-label">Password Baru</label>
                                            <div class="position-relative">
                                                <input class="form-control bg-transparent" id="password" type="password"
                                                    name="password" autocomplete="off" />
                                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50"
                                                    style="right: -15px;" data-kt-password-meter-control="visibility">
                                                    <i class="bi bi-eye-slash fs-2"></i>
                                                    <i class="bi bi-eye fs-2 d-none"></i>
                                                </span>
                                                <small class="text-danger password_error"></small>
                                            </div>
                                        </div>
                                        <div class="mb-10" data-kt-password-meter="true">
                                            <label class="form-label">Password Baru Ulang</label>
                                            <div class="position-relative">
                                                <input class="form-control bg-transparent" id="password_confirmation"
                                                    type="password" name="password_confirmation" autocomplete="off" />
                                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50"
                                                    style="right: -15px;" data-kt-password-meter-control="visibility">
                                                    <i class="bi bi-eye-slash fs-2"></i>
                                                    <i class="bi bi-eye fs-2 d-none"></i>
                                                </span>
                                                <small class="text-danger password_confirmation_error"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="separator separator-dashed mb-5"></div>
                            <div class="d-flex gap-5 justify-content-end">
                                <button type="submit"
                                    class="btn btn-primary btn-sm btn-submit d-flex align-items-center"><i
                                        class="bi bi-file-earmark-diff"></i> Simpan</button>
                            </div>
                        </form>
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
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                // Tampilkan pesan error jika file tidak valid
                logoError.text('Pilih file gambar yang valid.');
                logoInfoContainer.html('');
            }
        }

        $(document).on('submit', ".form-data", function(e) {
            e.preventDefault();
            let uuid = $("input[name='uuid']").val();
            control.submitFormMultipartData('/admin/update-password/' + uuid, 'Update',
                'Data Akun', 'POST');
        });
    </script>
@endsection
