<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function () {

    Route::get('/', 'Dashboard@index')->name('home.index');

    Route::group(['prefix' => 'login', 'middleware' => ['guest'], 'as' => 'login.'], function () {
        Route::get('/login-akun', 'Auth@show')->name('login-akun');
        Route::post('/login-proses', 'Auth@login_proses')->name('login-proses');
    });

    Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function () {
        Route::get('/dashboard-admin', 'Dashboard@dashboard_admin')->name('dashboard-admin');

        Route::get('/dataguru', 'DataGuruController@index')->name('dataguru');
        Route::get('/get-dataguru', 'DataGuruController@get')->name('get-dataguru');
        Route::post('/add-dataguru', 'DataGuruController@store')->name('add-dataguru');
        Route::get('/show-dataguru/{params}', 'DataGuruController@show')->name('show-dataguru');
        Route::post('/update-dataguru/{params}', 'DataGuruController@update')->name('update-dataguru');
        Route::delete('/delete-dataguru/{params}', 'DataGuruController@delete')->name('delete-dataguru');

        Route::get('/jamkerja', 'JamKerjaController@index')->name('jamkerja');
        Route::get('/get-jamkerja', 'JamKerjaController@get')->name('get-jamkerja');
        Route::post('/add-jamkerja', 'JamKerjaController@store')->name('add-jamkerja');
        Route::get('/show-jamkerja/{params}', 'JamKerjaController@show')->name('show-jamkerja');
        Route::post('/update-jamkerja/{params}', 'JamKerjaController@update')->name('update-jamkerja');
        Route::delete('/delete-jamkerja/{params}', 'JamKerjaController@delete')->name('delete-jamkerja');

        Route::get('/absensi', 'AbsenController@get_absensi')->name('absensi');
        Route::get('/absensi-data', 'AbsenController@getDataAbsen')->name('absensi-data');

        Route::get('/show-absensi/{params}', 'AbsenController@show')->name('show-absensi');
        Route::post('/update-absensi/{params}', 'AbsenController@update')->name('update-absensi');

        Route::get('/gaji', 'GajiController@index')->name('gaji');
        Route::get('/get-gaji', 'GajiController@get')->name('get-gaji');
        Route::post('/add-gaji', 'GajiController@store')->name('add-gaji');
        Route::get('/show-gaji/{params}', 'GajiController@show')->name('show-gaji');
        Route::post('/update-gaji/{params}', 'GajiController@update')->name('update-gaji');
        Route::delete('/delete-gaji/{params}', 'GajiController@delete')->name('delete-gaji');

        Route::get('/rekap', 'Rekap@index')->name('rekap');
        Route::get('/get-rekap/{params}', 'Rekap@get')->name('get-rekap');
        Route::get('/export-excel/{params}', 'Rekap@exportToExcel')->name('export-excel');
        Route::get('/export-pdf/{params}', 'Rekap@exportToPDF')->name('export-pdf');

        Route::get('/ubahpassword', 'UbahPassword@index')->name('ubahpassword');
        Route::post('/update-password/{params}', 'UbahPassword@update')->name('update-password');
    });

    Route::group(['prefix' => 'kepsek', 'middleware' => ['auth'], 'as' => 'kepsek.'], function () {
        Route::get('/dashboard-kepsek', 'Dashboard@dashboard_kepsek')->name('dashboard-kepsek');

        Route::get('/dataguru', 'DataGuruController@index')->name('dataguru');
        Route::get('/get-dataguru', 'DataGuruController@get')->name('get-dataguru');
        Route::post('/add-dataguru', 'DataGuruController@store')->name('add-dataguru');
        Route::get('/show-dataguru/{params}', 'DataGuruController@show')->name('show-dataguru');
        Route::post('/update-dataguru/{params}', 'DataGuruController@update')->name('update-dataguru');
        Route::delete('/delete-dataguru/{params}', 'DataGuruController@delete')->name('delete-dataguru');

        Route::get('/jamkerja', 'JamKerjaController@index')->name('jamkerja');
        Route::get('/get-jamkerja', 'JamKerjaController@get')->name('get-jamkerja');
        Route::post('/add-jamkerja', 'JamKerjaController@store')->name('add-jamkerja');
        Route::get('/show-jamkerja/{params}', 'JamKerjaController@show')->name('show-jamkerja');
        Route::post('/update-jamkerja/{params}', 'JamKerjaController@update')->name('update-jamkerja');
        Route::delete('/delete-jamkerja/{params}', 'JamKerjaController@delete')->name('delete-jamkerja');

        Route::get('/absensi', 'AbsenController@get_absensi')->name('absensi');
        Route::get('/absensi-data', 'AbsenController@getDataAbsen')->name('absensi-data');

        Route::get('/show-absensi/{params}', 'AbsenController@show')->name('show-absensi');
        Route::post('/update-absensi/{params}', 'AbsenController@update')->name('update-absensi');

        Route::get('/rekap', 'Rekap@index')->name('rekap');
        Route::get('/get-rekap/{params}', 'Rekap@get')->name('get-rekap');
        Route::get('/export-excel/{params}', 'Rekap@exportToExcel')->name('export-excel');
        Route::get('/export-pdf/{params}', 'Rekap@exportToPDF')->name('export-pdf');

        Route::get('/ubahpassword', 'UbahPassword@index')->name('ubahpassword');
        Route::post('/update-password/{params}', 'UbahPassword@update')->name('update-password');
    });

    Route::group(['prefix' => 'guru', 'middleware' => ['auth'], 'as' => 'guru.'], function () {
        Route::get('/dashboard-guru', 'Dashboard@dashboard_guru')->name('dashboard-guru');

        Route::get('/absen', 'AbsenController@index')->name('absen');
        Route::get('/absen-masuk', 'AbsenController@absen_masuk')->name('absen-masuk');
        Route::get('/absen-pulang', 'AbsenController@absen_pulang')->name('absen-pulang');

        Route::get('/get-user', 'AbsenController@get_user')->name('get-user');

        Route::post('/add-absen', 'AbsenController@absensi')->name('add-absen');

        Route::get('/get-absen', 'AbsenController@get')->name('get-absen');
    });

    Route::get('/logout', 'Auth@logout')->name('logout');
});
