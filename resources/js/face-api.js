// resources/js/face-api.js
import * as faceapi from 'face-api.js';

let control = new Control();

// Deklarasikan variabel formData di luar fungsi
let formData = new FormData();

// Fungsi untuk mengirim formData ke server
$(document).on('click', "#kirim", function (e) {
    e.preventDefault();
    formData.append('jenis_absen', $(this).attr('data-absen'));
    control.submitFormMultipartDataAbsen('/guru/add-absen', 'Tambah',
        'Absen',
        'POST', formData);
    // Menggunakan window.location.href untuk memindahkan ke URL yang ditentukan
    window.location.href = $(this).attr('data-url');
});

// $(document).ready(async function () {
//     try {
//         const res = await $.ajax({
//             url: '/admin/get-jamkerja',
//             method: "GET"
//         });

//         if (res.success === true) {
//             const now = new Date();
//             // Mendapatkan nama hari
//             const options = {
//                 weekday: 'long'
//             }; // pilihannya bisa 'short', 'long', atau 'narrow'
//             const namaHari = new Intl.DateTimeFormat('id-ID', options).format(now);

//             // Format jam menjadi HH:mm
//             const jam = String(now.getHours()).padStart(2, '0');
//             const menit = String(now.getMinutes()).padStart(2, '0');
//             const jamFormatted = `${jam}:${menit}`;

//             $.each(res.data, function (x, y) {
//                 if (y.hari.toLowerCase() === namaHari.toLowerCase()) {
//                     if (jamFormatted > y.jam_masuk) {
//                         formData.append('jenis_absen', 'telat absen masuk');
//                         control.submitFormMultipartDataAbsen('/guru/add-absen', 'Tambah',
//                             'Absen',
//                             'POST', formData);
//                     }
//                 }
//             });
//         } else {
//             console.error('Gagal mengambil data:', res.message);
//         }
//     } catch (error) {
//         console.error('Gagal melakukan permintaan AJAX:', error.statusText);
//     }
// })

$(document).ready(async function () {
    let video;
    let canvas;
    let capturedImage;
    let labeledFaceDescriptors = []; // Array untuk menyimpan deskripsi wajah yang sudah ada

    // Fungsi untuk menambahkan wajah yang sudah ada
    const addKnownFace = async (label, imageSrc) => {
        try {
            // Pastikan model deteksi wajah dan landmark sudah dimuat
            await faceapi.nets.tinyFaceDetector.loadFromUri('/models');
            await faceapi.nets.faceLandmark68Net.loadFromUri('/models');
            await faceapi.nets.faceRecognitionNet.loadFromUri('/models');

            const img = await faceapi.fetchImage(imageSrc);

            const fullFaceDescription = await faceapi.detectSingleFace(img, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceDescriptor();

            if (fullFaceDescription) {
                labeledFaceDescriptors.push(new faceapi.LabeledFaceDescriptors(label, [fullFaceDescription.descriptor]));
            } else {
                console.error(`Error: Tidak dapat mendeteksi wajah pada gambar ${label}.`);
            }
        } catch (error) {
            console.error(`Error saat menambahkan wajah ${label}:`, error);
        }
    };

    const initModalElements = async () => {
        video = $('#video')[0];
        canvas = $('#canvas')[0];
        capturedImage = $('#capturedImage')[0];

        if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
            console.error('Error: getUserMedia is not supported in this browser');
            return;
        }

        // Memuat model deteksi wajah, landmark, dan pengenalan wajah sebelum inferensi
        await faceapi.nets.tinyFaceDetector.loadFromUri('/models');
        await faceapi.nets.faceLandmark68Net.loadFromUri('/models');
        await faceapi.nets.faceRecognitionNet.loadFromUri('/models');

        // Memuat model deteksi objek (SsdMobilenetv1) sebelum inferensi
        await faceapi.nets.ssdMobilenetv1.loadFromUri('/models');

        navigator.mediaDevices.getUserMedia({ video: true })
            .then((stream) => {
                video.srcObject = stream;
            })
            .catch((error) => {
                console.error('Error accessing camera:', error);
            });
    };

    const captureImage = () => {
        const context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        // Mengonversi gambar menjadi blob
        canvas.toBlob(async (blob) => {
            formData.append('foto_absen', blob, 'gambar_user.png');

            // Tampilkan hasil gambar di elemen <img>
            capturedImage.src = URL.createObjectURL(blob);
            capturedImage.style.display = 'block';

            // Deteksi wajah menggunakan face-api.js
            const result = await faceapi.detectSingleFace(capturedImage, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceDescriptor();

            if (result) {

                if (labeledFaceDescriptors.length > 0) {
                    // Membandingkan wajah terdeteksi dengan wajah yang sudah ada
                    const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors);
                    const bestMatch = faceMatcher.findBestMatch(result.descriptor);

                    if (bestMatch._label !== 'unknown') {
                        swal.fire({
                            title: 'Berhasil mendapatkan data wajah',
                            text: 'Wajah dikenali sebagai ' + bestMatch._label,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        // Lakukan sesuatu jika wajah dikenali
                    } else {
                        swal.fire({
                            title: 'Wajah tidak dikenali',
                            text: 'Coba lagi?',
                            icon: "warning",  // Mengganti ikon menjadi "warning"
                            showConfirmButton: true,
                            showCancelButton: true,  // Menampilkan tombol Cancel
                            cancelButtonText: 'Tutup',  // Mengganti teks tombol Cancel
                            allowOutsideClick: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Kode yang ingin dijalankan jika tombol OK ditekan
                                // Misalnya, membuka kembali modal
                                $('#kt_modal_1').modal('show');
                            } else {
                                $('#kt_modal_1').modal('hide');
                            }
                        });
                        // Lakukan sesuatu jika wajah tidak dikenali
                    }
                } else {
                    console.error('Error: Tidak ada data wajah yang sudah ada.');
                }
            } else {
                swal.fire({
                    title: 'Tidak ada wajah terdeteksi',
                    text: 'Coba lagi?',
                    icon: "warning",  // Mengganti ikon menjadi "warning"
                    showConfirmButton: true,
                    showCancelButton: true,  // Menampilkan tombol Cancel
                    cancelButtonText: 'Tutup',  // Mengganti teks tombol Cancel
                    allowOutsideClick: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kode yang ingin dijalankan jika tombol OK ditekan
                        // Misalnya, membuka kembali modal
                        $('#kt_modal_1').modal('show');
                    } else {
                        $('#kt_modal_1').modal('hide');
                    }
                });
            }

            $('#kt_modal_1').modal('hide');

            // Hentikan kamera setelah gambar diambil
            stopCamera();
        }, 'image/png');
    };

    const stopCamera = () => {
        if (video && video.srcObject) {
            const tracks = video.srcObject.getTracks();
            tracks.forEach(track => track.stop());
            video.srcObject = null;
        }
    };

    $('#kt_modal_1').on('show.bs.modal', async function (e) {
        try {
            const res = await $.ajax({
                url: '/guru/get-user',
                method: "GET"
            });

            if (res.success === true) {
                // Contoh menambahkan wajah pengguna yang sedang diotentikasi
                await addKnownFace(res.data.name, '/foto/' + res.data.foto);
            } else {
                console.error('Gagal mengambil data:', res.message);
            }
        } catch (error) {
            console.error('Gagal melakukan permintaan AJAX:', error.statusText);
        }

        // Inisialisasi elemen-elemen ketika modal ditampilkan
        await initModalElements();
    });

    // Event yang dijalankan ketika modal disembunyikan
    $('#kt_modal_1').on('hide.bs.modal', function (e) {
        // Hentikan video ketika modal disembunyikan
        stopCamera();
    });

    $('#captureButton').on('click', captureImage);

    // Fungsi untuk mendapatkan jam dan tanggal saat ini
    function updateDateTime() {
        const now = new Date();

        const jamAbsenInput = $('#jam_absen');
        const tanggalAbsenInput = $('#tanggal_absen');

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
    $(document).ready(function () {
        updateDateTime();

        // Set interval untuk menjalankan fungsi updateDateTime setiap detik (1000 milidetik)
        setInterval(updateDateTime, 1000);
    });

    // Fungsi untuk menangani pemanggilan sukses mendapatkan lokasi
    function showPosition(position) {
        const { latitude, longitude } = position.coords;

        // Bulatkan nilai latitude dan longitude menjadi 5 angka di belakang koma
        const roundedLatitude = latitude.toFixed(5);
        const roundedLongitude = longitude.toFixed(5);

        const locationText = `${roundedLatitude}, ${roundedLongitude}`;
        $('#lokasi').val(locationText);
        formData.append('lokasi', locationText);

        // Validasi apakah lokasi berada dalam radius 500 meter
        const targetLatitude = -5.129443349224177; // Ganti dengan nilai target latitude
        const targetLongitude = 119.42974442311417; // Ganti dengan nilai target longitude
        // const targetLatitude = -5.1511296; // Ganti dengan nilai target latitude
        // const targetLongitude = 119.4295296; // Ganti dengan nilai target longitude
        // -5.210197195030083, 119.50257905284002
        const roundedTargetLatitude = targetLatitude.toFixed(5);
        const roundedTargetLongitude = targetLongitude.toFixed(5);

        // Validasi apakah lokasi berada dalam radius 1 kilometer
        if (isWithinRadius(roundedLatitude, roundedLongitude, roundedTargetLatitude, roundedTargetLongitude, 10)) {
            console.log('Lokasi berada dalam radius 1 kilometer.');
            // Lakukan sesuatu jika lokasi berada dalam radius yang diinginkan
        } else {
            console.log('Lokasi tidak berada dalam radius 1 kilometer.');
            swal.fire({
                title: 'Lokasi tidak sesuai',
                text: 'Harap berada dalam lokasi yang telah ditentukan',
                icon: "warning",  // Mengganti ikon menjadi "warning"
                showConfirmButton: true,
                allowOutsideClick: false,  // Mencegah SweetAlert ditutup dengan mengklik di luar area SweetAlert
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kode yang ingin dijalankan jika tombol OK ditekan
                    window.history.back();
                }
            });
            // Lakukan sesuatu jika lokasi tidak berada dalam radius yang diinginkan
        }
    }


    // Fungsi untuk menangani pemanggilan gagal mendapatkan lokasi
    function showError(error) {
        let errorMessage = 'Unknown error occurred.';

        switch (error.code) {
            case error.PERMISSION_DENIED:
                errorMessage = 'User denied the request for Geolocation.';
                break;
            case error.POSITION_UNAVAILABLE:
                errorMessage = 'Location information is unavailable.';
                break;
            case error.TIMEOUT:
                errorMessage = 'The request to get user location timed out.';
                break;
            case error.UNKNOWN_ERROR:
                errorMessage = 'An unknown error occurred.';
                break;
        }

        $('.lokasi_error').text(`Error: ${errorMessage}`);
    }

    // Meminta izin dan mendapatkan lokasi saat halaman dimuat
    $(document).ready(function () {
        const geolocationSupported = navigator.geolocation && typeof navigator.geolocation.getCurrentPosition === 'function';

        if (geolocationSupported) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            $('.lokasi_error').text('Geolocation is not supported by this browser.');
        }
    });

    // Fungsi untuk memeriksa apakah lokasi berada dalam radius tertentu (dalam meter)
    function isWithinRadius(lat1, lon1, lat2, lon2, radius) {
        const R = 6371; // Radius Bumi dalam kilometer
        const dLat = toRadians(lat2 - lat1);
        const dLon = toRadians(lon2 - lon1);
        const a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(toRadians(lat1)) * Math.cos(toRadians(lat2)) * Math.sin(dLon / 2) * Math.sin(dLon / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        const distance = R * c; // Dalam kilometer, bukan meter

        return distance <= radius;
    }

    // Fungsi untuk mengonversi sudut ke radian
    function toRadians(degrees) {
        return degrees * (Math.PI / 180);
    }

});
