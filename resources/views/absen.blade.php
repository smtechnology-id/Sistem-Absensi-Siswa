<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Sistem Presensi Siswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Theme Config Js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- App css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg">

    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-8 col-lg-10">
                    <div class="card overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-6 d-none d-lg-block p-2">
                                <img src="assets/images/auth-img.jpg" alt="" class="img-fluid rounded h-100">
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex flex-column h-100">
                                    <div class="p-4 my-auto">
                                        <!-- Bagian untuk menampilkan pesan flash sukses -->
                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif

                                        <!-- Bagian untuk menampilkan pesan flash error -->
                                        @if (session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <h4 class="fs-20">Form Absensi Siswa</h4>
                                        <p class="text-muted mb-3">Silahkan Masukkan NISN Anda dan Juga Bukti Kehadiran
                                            berupa Foto Selfie (Gambar Akan Diperiksa Oleh Admin)
                                        </p>

                                        <!-- form -->
                                        <form action="{{ route('loginPost') }}" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="nomor_induk" class="form-label">Nomor Induk Siswa</label>
                                                <input class="form-control" type="text" name="nomor_induk"
                                                    id="nomor_induk" required="" placeholder="Ex : 123456">
                                            </div>
                                            <div class="mb-3">
                                                <select name="status_absen" id="status_absen" required
                                                    class="form-control">
                                                    <option value="Masuk">Masuk</option>
                                                    <option value="Ijin">Ijin</option>
                                                    <option value="Sakit">Sakit</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status_absen" class="form-label">Keterangan <i>(Bila
                                                        Perlu)</i></label>
                                                <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="3"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="photo_selfie" class="form-label">Keterangan <i>(Bila
                                                        Perlu)</i></label>
                                                <input type="button" id="openCameraBtn" class="btn btn-primary" value="Buka Kamera">
                                                <video id="cameraFeed" width="320" height="240"
                                                    style="display:none;"></video>
                                                <canvas id="canvas" style="display:none;"></canvas>
                                            </div>

                                            <div class="mb-0 text-start">
                                                <button class="btn btn-soft-primary w-100" type="submit"><i
                                                        class="ri-login-circle-fill me-1"></i> <span class="fw-bold">Log
                                                        In</span> </button>
                                            </div>
                                        </form>
                                        <!-- end form-->
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-dark-emphasis">Back To <a href="{{ route('login') }}"
                            class="text-dark fw-bold ms-1 link-offset-3 text-decoration-underline"><b>Log In</b></a></p>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt fw-medium">
        <span class="text-dark-emphasis">
            <script>
                document.write(new Date().getFullYear())
            </script> © Velonic - Theme by Techzaa
        </span>
    </footer>
    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

    <script>
        // Mengakses elemen tombol, video, dan canvas dari DOM
        const openCameraBtn = document.getElementById('openCameraBtn');
        const cameraFeed = document.getElementById('cameraFeed');
        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');

        // Menambahkan event listener pada tombol
        openCameraBtn.addEventListener('click', async () => {
            try {
                // Minta izin untuk menggunakan kamera
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: true
                });

                // Menampilkan stream video dari kamera di elemen video
                cameraFeed.srcObject = stream;
                cameraFeed.style.display = 'block';

                // Ketika video feed sudah dimuat
                cameraFeed.onloadedmetadata = () => {
                    // Membuat canvas yang memiliki dimensi sama dengan video
                    canvas.width = cameraFeed.videoWidth;
                    canvas.height = cameraFeed.videoHeight;
                };
            } catch (err) {
                console.error('Tidak dapat mengakses kamera:', err);
            }
        });

        // Fungsi untuk mengambil foto selfie
        function takeSelfie() {
            // Menggambar feed video ke dalam canvas
            ctx.drawImage(cameraFeed, 0, 0, canvas.width, canvas.height);

            // Mengambil gambar dari canvas dan mengkonversinya ke dalam format data URL
            const dataURL = canvas.toDataURL('image/jpeg');

            // Lakukan sesuatu dengan gambar, seperti menampilkan atau menyimpannya
            console.log(dataURL);
        }
    </script>
</body>

</html>
