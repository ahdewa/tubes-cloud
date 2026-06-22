<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController; // Menggunakan base controller bawaan framework

class MahasiswaController extends BaseController
{
    // Menampilkan semua data
    public function index()
    {
        $mahasiswa = mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    // Menampilkan form tambah data
    public function create()
    {
        return view('mahasiswa.create');
    }

    // Menyimpan data baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim|max:15',
            'nama' => 'required|max:100',
            'prodi' => 'required|max:50',
            'angkatan' => 'required|numeric',
        ]);

        mahasiswa::create($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil ditambahkan!');
    }

    // Menampilkan form edit data
    public function edit(mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    // Memperbarui data di database
    public function update(Request $request, mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required|max:15|unique:mahasiswas,nim,' . $mahasiswa->id,
            'nama' => 'required|max:100',
            'prodi' => 'required|max:50',
            'angkatan' => 'required|numeric',
        ]);

        $mahasiswa->update($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil diperbarui!');
    }

    // Menghapus data
    public function destroy(mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil dihapus!');
    }
}