@extends('layouts.app')

@section('content')
    {{-- Menampilkan notifikasi jika ada session delete atau success --}}
    @if (session('delete'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('delete') }}",
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                });
            });
        </script>
    @elseif (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                });
            });
        </script>
    @endif

    @include('partials.count')

    <div id="content" class="overflow-y-hidden overflow-x-hidden fade-in">
        @if (request()->query('query'))
            @if ($tasks->isEmpty() && $lists->isEmpty())
                <div class="alert alert-warning text-center mt-3">
                    <strong>Data tidak ditemukan!</strong> Tidak ada tugas atau list yang sesuai dengan pencarian
                    "{{ request()->query('query') }}".
                </div>
            @endif
        @endif
        
        @if ($listis->count() == 0)
            <div class="d-flex flex-column align-items-center">
                <p class="fw-bold text-center">Belum ada tugas yang ditambahkan</p>
                {{-- START TAMBAH LIST --}}
                <button type="button" class="btn btn-outline-primary btn-sm flex-shrink-0  ms-3 mb-3"
                    style="height: fit-content;" data-bs-toggle="modal" data-bs-target="#addListModal">
                    <span class="d-flex align-items-center justify-content-center">
                        <i class="bi bi-plus fs-5"></i>
                        Tambah
                    </span>
                </button>
                {{-- END TAMBAH LIST --}}
            </div>
        @else
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3 mt-2">
                {{-- START TAMBAH LIST --}}
                <button type="button" class="btn btn-outline-primary btn-sm flex-shrink-0 ms-3"
                    style="height: fit-content;" data-bs-toggle="modal" data-bs-target="#addListModal">
                    <span class="d-flex align-items-center justify-content-center">
                        <i class="bi bi-plus fs-5"></i>
                        Tambah
                    </span>
                </button>
            </div>
            {{-- END TAMBAH LIST --}}
        @endif

         {{-- @foreach adalah salah satu struktur perulangan (looping) dalam Blade yang digunakan untuk menampilkan data dalam array atau koleksi.  --}}
        <div class="d-flex gap-3 px-3 flex-nowrap  overflow-x-scroll overflow-y-hidden" style="height: 100vh;">
            @foreach ($listis as $list)
             {{-- Di sini, @foreanch dari kode di atas  berarti setiap elemen dalam $lists akan diulang dan disimpan dalam variabel $list.Digunakan untuk menampilkan setiap daftar tugas (list) dalam bentuk kartu. --}}
                <div class="card flex-shrink-0" style="width: 20rem; max-height: 60vh;">
                    
                    {{-- START LIST --}}
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="card-title">{{ $list->name }}</h4>
                        <form action="{{ route('lists.destroy', $list->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm p-0">
                                <i class="bi bi-trash fs-5 text-danger"></i>
                            </button>
                        </form>
                    </div>
                    {{-- End List --}}

                    <div class="card-body d-flex flex-column gap-2 overflow-x-hidden">
                        @foreach ($list->tasks as $task)
                            {{-- Ketika task sudah selesai maka background akan berubah menjadi abu-abu --}}
                            <div class="card {{ $task->is_completed ? 'bg-secondary-subtle' : '' }}">
                                <div class="card-header">
                                    {{-- Start Task --}}
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex justify-content-center gap-2">
                                            @if ($task->priority == 'high' && !$task->is_completed)
                                                <div class="spinner-grow spinner-grow-sm text-{{ $task->priorityClass }}"
                                                    role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                            @endif
                                            <a href="{{ route('tasks.show', $task->id) }}"
                                                class="fw-bold lh-1 m-0 text-decoration-none fs-5 text-{{ $task->priorityClass }} {{ $task->is_completed ? 'text-decoration-line-through' : '' }}">
                                                {{ $task->name }}
                                            </a>
                                        </div>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm p-0">
                                                <i class="bi bi-x-circle text-danger fs-5"></i>
                                            </button>
                                        </form>
                                    </div>
                                    {{-- Carbon adalah sebuah library PHP yang digunakan untuk memanipulasi tanggal dan waktu.  
                                    Carbon digunakan untuk memformat tanggal deadline dari sebuah task.
                                    --}}
                                    <span class="badge bg-warning text-dark">
                                        Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('d/m/Y') }}
                                    </span>
                                </div>
                                <div class="card-body">
                                    <p
                                        class="card-text text-truncate {{ $task->is_completed ? 'text-decoration-line-through' : '' }}">
                                        {{ $task->description }}
                                    </p>
                                </div>
                                @if (!$task->is_completed)
                                    <div class="card-footer">
                                        <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-primary w-100">
                                                <span class="d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-check fs-5"></i>
                                                    Selesai
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#addTaskModal" data-list="{{ $list->id }}">
                            <span class="d-flex align-items-center justify-content-center">
                                <i class="bi bi-plus fs-5"></i>
                                Tambah
                            </span>
                        </button>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <p class="card-text">{{ $list->tasks->count() }} Tugas</p>
                    </div>
                </div>
                {{-- END Task --}}
            @endforeach
        </div>
    </div>
@endsection
