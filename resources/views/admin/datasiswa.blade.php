@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h4 class="mb-4 mt-2">Data Siswa
                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#standard-modal">Add Siswa</button>
            </h4>
        </div> <!-- end col -->
    </div>
    <!-- end row -->

    <div class="row">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Data Siswa Kelas <i>{{ $kelas->nama_kelas }}</i></h4>
                        <p class="text-muted mb-0">

                        </p>
                    </div>
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nis</th>
                                    <th>Nama Siswa</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>


                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($student as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->nomor_induk }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->jenis_kelamin }}</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-info btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#updateModal{{ $data->id }}"><i
                                                    class="bi bi-pencil-square"></i></button>
                                            <div id="updateModal{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog"
                                                aria-labelledby="standard-modalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5>Form Tambah Kelas</h5>
                                                            <p></p>
                                                            <hr>
                                                            <form action="{{ route('admin.updateStudentPost') }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group mb-2">
                                                                    <label for="nama">Nama Siswa</label>
                                                                    <input type="text" name="nama" id="nama"
                                                                        required class="form-control"
                                                                        placeholder="Ex : Muhamad Fauzan" value="{{ $data->nama }}">
                                                                    <input type="hidden" name="id" id="id"
                                                                        required class="form-control"
                                                                        value="{{ $data->id }}">
                                                                    <input type="hidden" name="kelas_id" id="kelas_id"
                                                                        required class="form-control"
                                                                        value="{{ $kelas->id }}">
                                                                </div>
                                                                <div class="form-group mb-2">
                                                                    <label for="nomor_induk">Nomor Induk Siswa</label>
                                                                    <input type="number" name="nomor_induk"
                                                                        id="nomor_induk" required class="form-control"
                                                                        placeholder="Ex : 2020" value="{{ $data->nomor_induk }}">
                                                                </div>
                                                                <div class="form-group mb-2">
                                                                    <label for="jenis kelamin">Jenis Kelamin</label>
                                                                    <select name="jenis_kelamin" id="jenis_kelamin"
                                                                        class="form-control" required>
                                                                        <option value="Laki-Laki">Laki-Laki</option>
                                                                        <option value="Perempuan">Perempuan</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group mb-2">
                                                                    <button type="submit"
                                                                        class="btn btn-primary btn-sm">Save changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light"
                                                                data-bs-dismiss="modal">Close</button>

                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->


                                            {{-- Delete --}}
                                            <button type="button" class="btn btn-outline-danger btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $data->id }}"><i
                                                    class="bi bi-trash-fill"></i></button>
                                            <div id="deleteModal{{ $data->id }}" class="modal fade" tabindex="-1"
                                                role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content modal-filled bg-danger">
                                                        <div class="modal-body p-4">
                                                            <div class="text-center">
                                                                <i class="ri-close-circle-line h1"></i>
                                                                <h4 class="mt-2">Konfirmasi Hapus Data</h4>
                                                                <p class="mt-3">Apakah Anda Yakin Akan Menghapus Data Ini
                                                                    ?</p>
                                                                <a href="{{ route('admin.deleteStudent', ['id' => $data->id]) }}"
                                                                    class="btn btn-light my-2">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div> <!-- end row-->

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
                    <form action="{{ route('admin.addStudentPost') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="nama">Nama Siswa</label>
                            <input type="text" name="nama" id="nama" required class="form-control"
                                placeholder="Ex : Muhamad Fauzan">
                            <input type="hidden" name="kelas_id" id="kelas_id" required class="form-control"
                                value="{{ $kelas->id }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="nomor_induk">Nomor Induk Siswa</label>
                            <input type="number" name="nomor_induk" id="nomor_induk" required class="form-control"
                                placeholder="Ex : 2020">
                        </div>
                        <div class="form-group mb-2">
                            <label for="jenis kelamin">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
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
