@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h4 class="mb-4 mt-2">Data Absensi
            </h4>
        </div> <!-- end col -->
    </div>
    <!-- end row -->

    <div class="row">
        @foreach ($kelas as $data)
            <div class="col-md-4">
                <div class="card border-info border">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $data->nama_kelas }}</h5>
                        <p class="card-text">{{ $data->tahun_ajaran }} || Jumlah Siswa = 10</p>
                        <a href="{{ route('admin.absensiSiswa', ['id' => $data->id]) }}" class="btn btn-info btn-sm">Lihat
                            Semua</a>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        @endforeach

    </div>
    <!-- end row -->
@endsection
