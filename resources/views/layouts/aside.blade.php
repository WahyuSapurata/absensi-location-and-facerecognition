@php
    $path = explode('/', Request::path());
    $role = auth()->user()->role;

    $dashboardRoutes = [
        'admin' => 'admin.dashboard-admin',
        'guru' => 'guru.dashboard-guru',
    ];

    $isActive = in_array($role, array_keys($dashboardRoutes)) && $path[1] === 'dashboard-' . $role;
    $activeColor = $isActive ? 'color: #F4BE2A' : 'color: #FFFFFF';
@endphp
{{-- @dd($isActive) --}}
{{-- @dd($path) --}}
<div class="aside-menu bg-primary flex-column-fluid">
    <!--begin::Aside Menu-->
    <div class="hover-scroll-overlay-y mb-5 mb-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
        data-kt-scroll-offset="0">
        <!--begin::Menu-->
        <div class="menu menu-column mt-2 menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
            id="kt_aside_menu" data-kt-menu="true" style="gap: 3px;">

            <div class="menu-item">
                <a class="menu-link {{ $isActive ? 'active' : '' }}" href="{{ route($dashboardRoutes[$role]) }}">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <img src="{{ $isActive ? url('admin/assets/media/icons/aside/dashboardact.svg') : url('admin/assets/media/icons/aside/dashboarddef.svg') }}"
                                alt="">
                        </span>
                    </span>
                    <span class="menu-title" style="{{ $activeColor }}">Dashboard</span>
                </a>
            </div>

            @if ($role === 'admin')
                <div class="menu-item">
                    <a class="menu-link  {{ $path[1] === 'dataguru' ? 'active' : '' }}"
                        href="{{ route('admin.dataguru') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <img src="{{ $path[1] === 'dataguru' ? url('admin/assets/media/icons/aside/dataguruact.svg') : url('/admin/assets/media/icons/aside/datagurudef.svg') }}"
                                    alt="">
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ $path[1] === 'dataguru' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Data
                            Pegawai</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link  {{ $path[1] === 'jamkerja' ? 'active' : '' }}"
                        href="{{ route('admin.jamkerja') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <img src="{{ $path[1] === 'jamkerja' ? url('admin/assets/media/icons/aside/jamkerjaact.svg') : url('/admin/assets/media/icons/aside/jamkerjadef.svg') }}"
                                    alt="">
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ $path[1] === 'jamkerja' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Jam
                            Kerja</span>
                    </a>
                </div>
            @endif

            @if ($role === 'admin')
                <div class="menu-item">
                    <a class="menu-link  {{ $path[1] === 'absensi' ? 'active' : '' }}"
                        href="{{ route('admin.absensi') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <img src="{{ $path[1] === 'absensi' ? url('admin/assets/media/icons/aside/absenact.svg') : url('/admin/assets/media/icons/aside/absendef.svg') }}"
                                    alt="">
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ $path[1] === 'absensi' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Absensi</span>
                    </a>
                </div>
            @endif

            @if ($role === 'admin')
                <div class="menu-item">
                    <a class="menu-link  {{ $path[1] === 'gaji' ? 'active' : '' }}" href="{{ route('admin.gaji') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <img src="{{ $path[1] === 'gaji' ? url('admin/assets/media/icons/aside/gajiact.svg') : url('/admin/assets/media/icons/aside/gajidef.svg') }}"
                                    alt="">
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ $path[1] === 'gaji' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Gaji</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link  {{ $path[1] === 'rekap' ? 'active' : '' }}"
                        href="{{ route('admin.rekap') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <img src="{{ $path[1] === 'rekap' ? url('admin/assets/media/icons/aside/rekapact.svg') : url('/admin/assets/media/icons/aside/rekapdef.svg') }}"
                                    alt="">
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ $path[1] === 'rekap' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Rekap</span>
                    </a>
                </div>
            @endif

            @if ($role === 'guru')
                <div class="menu-item">
                    <a class="menu-link  {{ $path[1] === 'absen' ? 'active' : '' }}" href="{{ route('guru.absen') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <img src="{{ $path[1] === 'absen' ? url('admin/assets/media/icons/aside/absenact.svg') : url('/admin/assets/media/icons/aside/absendef.svg') }}"
                                    alt="">
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ $path[1] === 'absen' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Absensi</span>
                    </a>
                </div>
            @endif

            <div class="menu-item">
                <a class="menu-link  {{ $path[1] === 'ubahpassword' ? 'active' : '' }}"
                    href="{{ route('admin.ubahpassword') }}">
                    <span class="menu-icon">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                        <span class="svg-icon svg-icon-2">
                            <img src="{{ $path[1] === 'ubahpassword' ? url('admin/assets/media/icons/aside/ubahpasswordact.svg') : url('/admin/assets/media/icons/aside/ubahpassworddef.svg') }}"
                                alt="">
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-title"
                        style="{{ $path[1] === 'ubahpassword' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Profil</span>
                </a>
            </div>

        </div>
        <!--end::Menu-->
    </div>
</div>

@section('scripts')
    <script>
        $(document).ready(function() {
            // $(".menu-link").hover(function(){
            //     $(this).css("background", "#282EAD");
            // }, function(){
            //     $(this).css("background", "none");
            // });
        });
    </script>
@endsection
