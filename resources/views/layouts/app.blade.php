<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Menentukan karakter encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Agar responsif di berbagai perangkat -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> <!-- Untuk kompatibilitas dengan Internet Explorer -->
    <title> {{$title }}</title> <!-- Menampilkan judul halaman yang dinamis -->

    <!-- Import Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/font/bootstrap-icons.min.css') }}">

    <!-- Import CSS kustom -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    
    @include('partials.navbar') <!-- Mengambil component navbar -->

    @yield('content') <!-- Render konten utama halaman -->
    
    @include('partials.modal') <!-- Mengambil component modal -->

    <!-- Import JavaScript -->
    <script src="{{ asset('js/script.js') }}"></script> <!-- Script kustom -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert untuk notifikasi -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script> <!-- Bootstrap JS -->
</body>
</html>
