<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        $data = [
            'title' => 'Home',
            'lists' => TaskList::all(),
            'tasks' => Task::orderBy('created_at', 'desc')->get(),
            'priorities' => Task::PRIORITIES
        ];

        return view('pages.home', $data);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'required|max:255',
            'list_id' => 'required'
        ]);

        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'list_id' => $request->list_id
        ]);


        return redirect()->back();
    }

    public function complete($id) {
        Task::findOrFail($id)->update([
            'is_completed' => true
        ]);

        return redirect()->back();
    }
     // Fungsi show untuk menampilkan detail tugas berdasarkan ID.
     public function show($id){
        // Mencari tugas berdasarkan ID, jika tidak ditemukan akan menampilkan error 404.
        $task = Task::findOrFail($id);
    
        // Menyiapkan data untuk dikirim ke tampilan.
        $data = [
            'title' => 'Details',   // Menentukan judul halaman.
            'task' => $task,        // Mengirim data tugas ke tampilan.
        ];
    
        // Menampilkan tampilan 'pages.details' dengan data tugas.
        return view('pages.details',  $data);
    }    


    public function destroy($id) {
        Task::findOrFail($id)->delete();

        return redirect()->back();
    }
}
