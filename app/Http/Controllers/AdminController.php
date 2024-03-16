<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Student;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }



    // Kelas Method
    public function kelas()
    {
        $kelas = Kelas::all();
        return view('admin.kelas', compact('kelas'));
    }

    public function addKelasPost(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'tahun_ajaran' => 'required|integer',
        ]);

        // Simpan kelas baru ke dalam database
        $kelas = new Kelas();
        $kelas->nama_kelas = $request->input('nama_kelas');
        $kelas->tahun_ajaran = $request->input('tahun_ajaran');
        $kelas->save();

        // Redirect atau kembali ke halaman yang sesuai
        return redirect()->back()->with('success', 'Kelas berhasil ditambahkan!');
    }
    public function updateKelasPost(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'id' => 'required|integer',
            'nama_kelas' => 'required|string|max:255',
            'tahun_ajaran' => 'required|integer',
        ]);

        // Temukan kelas yang akan diperbarui
        $kelas = Kelas::findOrFail($request->id);

        // Update informasi kelas dengan data baru dari form
        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->tahun_ajaran = $request->tahun_ajaran;
        $kelas->save();

        // Redirect atau kembali ke halaman yang sesuai
        return redirect()->back()->with('success', 'Perubahan pada kelas berhasil disimpan!');
    }
    // END Kelas Method

    // Student Method
    public function dataSiswa($id)
    {
        $kelas = Kelas::where('id', $id)->first();
        $student = Student::where('kelas_id', $id)->get();
        return view('admin.datasiswa', compact('student', 'kelas'));
    }

    public function addStudentPost(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_induk' => 'required|integer',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
        ]);

        // Buat record baru dalam tabel siswa
        $student = new Student();
        $student->nama = $request->nama;
        $student->kelas_id = $request->kelas_id;
        $student->nomor_induk = $request->nomor_induk;
        $student->jenis_kelamin = $request->jenis_kelamin;
        // tambahkan logika untuk menangani atribut lainnya jika diperlukan
        $student->save();

        // Redirect atau kembali ke halaman yang sesuai
        return redirect()->back()->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function deleteStudent($id)
    {
        // Temukan siswa berdasarkan ID
        $student = Student::findOrFail($id);

        // Hapus siswa dari sistem
        $student->delete();

        // Redirect atau kembali ke halaman yang sesuai
        return redirect()->back()->with('error', 'Siswa berhasil dihapus!');
    }

    public function updateStudentPost(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'id' => 'required|integer',
            'nama' => 'required|string|max:255',
            'nomor_induk' => 'required|integer',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'kelas_id' => 'required|integer',
        ]);

        // Temukan siswa berdasarkan ID
        $student = Student::findOrFail($request->id);

        // Update data siswa
        $student->nama = $request->nama;
        $student->kelas_id = $request->kelas_id;
        $student->nomor_induk = $request->nomor_induk;
        $student->jenis_kelamin = $request->jenis_kelamin;
        // tambahkan logika untuk pembaruan atribut lainnya jika diperlukan
        $student->save();

        // Redirect atau kembali ke halaman yang sesuai
        return redirect()->back()->with('success', 'Data siswa berhasil diperbarui!');
    }


    // Absensi
    public function absensi() {
        $kelas = Kelas::all();
        return view('admin.dataabsensi', compact('kelas'));
    }
    
    public function absensiSiswa($id) {
        $kelas = Kelas::where('id', $id)->first();
        $student = Student::where('kelas_id', $id)->get();
        $absensi = Absensi::all();
        return view('admin.absensiSiswa', compact('kelas', 'student', 'absensi'));
    }
}
