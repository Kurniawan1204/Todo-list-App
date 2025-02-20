<?php

namespace App\Http\Controllers; // Menentukan namespace untuk controller

use App\Models\TaskList; // Mengimpor model TaskList
use Illuminate\Http\Request; // Mengimpor Request untuk menangani input dari pengguna

class TaskListController extends Controller
{
    // Method untuk menyimpan data TaskList ke database
    public function store(Request $request) {
        // Validasi input, memastikan name tidak kosong dan maksimal 100 karakter
        $request->validate([
            'name' => 'required|max:100'        
        ]);

        // Membuat data TaskList baru dengan nama yang diberikan dari request
        TaskList::create([
            'name' => $request->name
        ]);

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'List berhasil ditambahkan!');
    }

    // Method untuk menghapus data TaskList berdasarkan ID
    public function destroy($id) {
        // Mencari TaskList berdasarkan ID, jika tidak ditemukan akan menampilkan error 404
        TaskList::findOrFail($id)->delete();

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('delete', 'List berhasil dihapus!');
    }
}
