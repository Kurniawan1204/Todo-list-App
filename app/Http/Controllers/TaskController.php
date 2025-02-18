<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
    
        if ($query) {
            $tasks = Task::where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->latest()
                ->get();
    
            $lists = TaskList::where('name', 'like', "%{$query}%")
                ->orWhereHas('tasks', function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                })
                ->with(['tasks' => function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                }])
                ->get();
        } else {
            // Ambil semua data jika query kosong
            $tasks = Task::latest()->get();
            $lists = TaskList::with('tasks')->get();
        }
    
        return view('pages.home', [
            'title' => 'Home',
            'lists' => $lists,
            'tasks' => $tasks,
            'priorities' => Task::PRIORITIES
        ]);
    }
    public function todayTasks()
{
    $today = now()->toDateString();
    $tasks = Task::whereDate('deadline', $today)->get();

    return response()->json($tasks);
}


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'max:255',
            'deadline' => 'required|date',
            'priority' => 'required|in:low,medium,high',
            'list_id' => 'required'
        ]);

        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'priority' => $request->priority,
            'list_id' => $request->list_id
        ]);

// Redirect kembali ke halaman sebelumnya dengan pesan sukses.
return redirect()->back()->with('success', 'Tugas berhasil ditambahkan!');    }

    public function complete($id)
    {
        Task::findOrFail($id)->update([
            'is_completed' => true
        ]);

        return redirect()->back()->with('success', 'Tugas telah diselesaikan!');
    }

    public function destroy($id)
    {
        Task::findOrFail($id)->delete();


        return redirect()->route('home')->with('delete', 'Tugas berhasil dihapus!');
    }

    public function show($id)
    {
        $data = [
            'title' => 'Task',
            'lists' => TaskList::all(),
            'task' => Task::findOrFail($id),
        ];

        return view('pages.details', $data);
    }

    public function changeList(Request $request, Task $task)
    {
        $request->validate([
            'list_id' => 'required|exists:task_lists,id',
        ]);

        Task::findOrFail($task->id)->update([
            'list_id' => $request->list_id
        ]);

        return redirect()->back()->with('success', 'List berhasil diperbarui!');
    }

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
}