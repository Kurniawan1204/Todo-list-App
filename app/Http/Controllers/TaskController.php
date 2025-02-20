<?php

namespace App\Http\Controllers;

// use Carbon\Carbon; // Digunakan untuk manipulasi tanggal dan waktu

use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Menampilkan daftar tugas
    public function index(Request $request)
    {
        // Mengambil input pencarian dari request (jika ada)
        $query = $request->input('query');

        if ($query) {
            // Jika ada kata kunci pencarian, cari tugas (tasks) yang sesuai dengan nama atau deskripsi
            $tasks = Task::where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->latest() // Urutkan berdasarkan waktu terbaru
                ->get();

            // Cari daftar tugas (TaskList) yang sesuai dengan nama atau memiliki tugas yang cocok dengan query
            $listis = TaskList::where('name', 'like', "%{$query}%")
                ->orWhereHas('tasks', function ($q) use ($query) {
                    // Cari dalam tabel tugas yang berelasi dengan TaskList
                    $q->where('name', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                })
                ->with(['tasks' => function ($q) use ($query) {
                    // Ambil hanya tugas yang cocok dengan pencarian dalam setiap daftar tugas
                    $q->where('name', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                }])
                ->get();
        } else {
            // Jika tidak ada pencarian, ambil semua data tugas dan daftar tugas
            $tasks = Task::latest()->get(); // Ambil semua tugas terbaru
            $listis = TaskList::with('tasks')->get(); // Ambil semua daftar tugas beserta tugasnya
        }

        // array
        // Mengembalikan data ke view 'pages.home' dengan struktur berikut
        return view('pages.home', [
            'title' => 'Home', // Judul halaman
            'listis' => $listis, // Data daftar tugas yang akan ditampilkan
            'tasks' => $tasks, // Data tugas yang akan ditampilkan
            'priorities' => Task::PRIORITIES // Mengirimkan daftar prioritas tugas
        ]);
    }


    // Mengambil daftar tugas yang memiliki deadline hari ini
    public function todayTasks()
    {
        $today = now()->toDateString(); // Mendapatkan tanggal hari ini
        $tasks = Task::whereDate('deadline', $today)->get(); // Mengambil tugas yang deadlinenya hari ini

        return response()->json($tasks); // Mengembalikan data dalam format JSON
    }

    // Menyimpan tugas baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100', // Nama tugas harus diisi dan maksimal 100 karakter
            'description' => 'max:255', // Deskripsi maksimal 255 karakter
            'deadline' => 'required|date', // Deadline harus berupa tanggal
            'priority' => 'required|in:low,medium,high', // Prioritas harus low, medium, atau high
            'list_id' => 'required' // ID daftar tugas harus diisi
        ]);

        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'priority' => $request->priority,
            'list_id' => $request->list_id
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil ditambahkan!'); // Redirect kembali dengan pesan sukses
    }

    // Menandai tugas sebagai selesai
    public function complete($id)
    {
        Task::findOrFail($id)->update([
            'is_completed' => true
        ]);

        return redirect()->back()->with('success', 'Tugas telah diselesaikan!');
    }

    // Menghapus tugas berdasarkan id
    public function destroy($id)
    {
        Task::findOrFail($id)->delete();

        return redirect()->route('home')->with('delete', 'Tugas berhasil dihapus!');
    }

    // Menampilkan detail tugas berdasarkan ID
    public function show($id)
    {
        $data = [
            'title' => 'Task',
            'lists' => TaskList::all(),
            'task' => Task::findOrFail($id),
        ];

        return view('pages.details', $data);
    }

    // Mengubah daftar tugas suatu task
    public function changeList(Request $request, Task $task)
    {
        $request->validate([
            'list_id' => 'required|exists:task_lists,id', // list_id harus ada dalam tabel task_lists
        ]);

        Task::findOrFail($task->id)->update([
            'list_id' => $request->list_id
        ]);

        return redirect()->back()->with('success', 'List berhasil diperbarui!');
    }

    // Memperbarui informasi tugas
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'list_id' => 'required',
            'name' => 'required|max:100',
            'description' => 'max:255',
            'priority' => 'required|in:low,medium,high'
        ]);

        Task::findOrFail($task->id)->update([
            'list_id' => $request->list_id,
            'name' => $request->name,
            'description' => $request->description,
            'priority' => $request->priority
        ]);

        return redirect()->back()->with('success', 'Task berhasil diperbarui!');
    }

    // Menampilkan halaman profil
    public function profil()
    {
        $data = [
            'title' => 'profil'
        ];

        return view('pages.profil', $data);
    }
}
