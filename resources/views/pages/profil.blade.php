@extends('layouts.app')
@section('content')
    <div class="container mt-4 pt-5  profil fade-in overflow-hidden">
        <div class=" d-flex justify-content-between align-items-center">
            <p>KURNIAWAN</p>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <h1>Selamat Datang</h1>
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">KEMBALI</a>
        </div>

        <div class="row mt-4 fade-in">
            <!-- Kartu Profil -->
            <div class="col-md-6">
                <div class="card mb-4 fade-in">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <img src="img/img-3.jpg" alt="Profile" class="object-cover rounded me-3 fade-in"
                                style="width: 250px; height: 250px;">
                            <div class="row">
                                <h5 class="card-title">KURNIAWAN</h5>
                                <div class="col-6">
                                    <strong class="text-primary">NISN:</strong>
                                    <p class="card-text mb-2">0075319656</p>
                                </div>
                                <div class="col-6">
                                    <strong class="text-primary">NIT:</strong>
                                    <p class="card-text mb-2"> 2223601</p>
                                </div>
                                <div class="col-6">
                                    <strong class="text-primary">Asal Sekolah:</strong>
                                    <p class="card-text mb-2">SMKN 2 SUBANG</p>
                                </div>
                                <div class="col-6">
                                    <strong class="text-primary">Jurusan: </strong>
                                    <p class="card-text mb-2">Pengembangan Perangkat Lunak dan Gim</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Biodata -->
            <div class="col-md-6">
                <div class="card mb-4 fade-in">
                    <div class="card-header">
                        BIODATA
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Biodata</h5>
                        <div class="row">
                            <div class="col-6">
                                <strong class="text-primary">Tanggal Lahir</strong>
                                <p class="card-text mb-2">12/04/2007</p>
                            </div>
                            <div class="col-6">
                                <strong class="text-primary">Jenis Kelamin</strong>
                                <p class="card-text mb-2">Laki-laki</p>
                            </div>
                            <div class="col-6">
                                <strong class="text-primary">Tempat Lahir</strong>
                                <p class="card-text mb-2">Subang</p>
                            </div>
                            <div class="col-6">
                                <strong class="text-primary">Agama</strong>
                                <p class="card-text mb-2">Islam</p>
                            </div>
                        </div>

                        <h5 class="card-title fw-bold mt-3">Alamat</h5>
                        <div class="row">
                            <div class="col-6">
                                <strong class="text-primary">Jalan</strong>
                                <p class="card-text mb-2">Karangcegak</p>
                            </div>
                            <div class="col-6">
                                <strong class="text-primary">Kode Pos</strong>
                                <p class="card-text mb-2">41252</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
