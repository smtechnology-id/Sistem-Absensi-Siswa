@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h4 class="mb-4 mt-2">Data Kelas
                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#standard-modal">Add Kelas</button>
            </h4>
        </div> <!-- end col -->
    </div>
    <!-- end row -->

    <div class="row">
        @foreach ($kelas as $data)
            <div class="col-md-4">
                <div class="card border-primary border">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $data->nama_kelas }}</h5>
                        <p class="card-text">{{ $data->tahun_ajaran }} || Jumlah Siswa = 10</p>
                        <a href="{{ route('admin.dataSiswa', ['id' => $data->id]) }}" class="btn btn-primary btn-sm">Lihat
                            Semua</a>
                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#update-modal{{ $data->id }}"> <i class="bi bi-pencil-square"></i></button>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

            {{-- Modal Update --}}
            <div id="update-modal{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="standard-modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5>Form Edit Data Kelas</h5>
                            <p></p>
                            <hr>
                            <form action="{{ route('admin.updateKelasPost') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-2">
                                    <label for="nama_kelas">Nama Kelas</label>
                                    <input type="text" name="nama_kelas" id="nama_kelas" required class="form-control"
                                        placeholder="Ex : X Akutansi" value="{{ $data->nama_kelas }}">
                                    <input type="hidden" name="id" id="id" required class="form-control"
                                        placeholder="" value="{{ $data->id }}">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="tahun_ajaran">Nama Kelas</label>
                                    <input type="number" name="tahun_ajaran" id="tahun_ajaran" required
                                        class="form-control" placeholder="Ex : 2020" value="{{ $data->tahun_ajaran }}">
                                </div>
                                <div class="form-group mb-2">
                                    <button type="submit" class="btn btn-secondary btn-sm">Save changes</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>

                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        @endforeach

    </div>
    <!-- end row -->
    <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Form Tambah Kelas</h5>
                    <p></p>
                    <hr>
                    <form action="{{ route('admin.addKelasPost') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="nama_kelas">Nama Kelas</label>
                            <input type="text" name="nama_kelas" id="nama_kelas" required class="form-control"
                                placeholder="Ex : X Akutansi">
                        </div>
                        <div class="form-group mb-2">
                            <label for="tahun_ajaran">Nama Kelas</label>
                            <input type="number" name="tahun_ajaran" id="tahun_ajaran" required class="form-control"
                                placeholder="Ex : 2020">
                        </div>
                        <div class="form-group mb-2">
                            <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
