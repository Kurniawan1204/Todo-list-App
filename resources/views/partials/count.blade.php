{{-- Start Count --}}
<div id="content" class="mb-3 d-flex align-items-center justify-content-center gap-3 container">
    {{-- Daftar Tugas --}}
    <div class="card rounded shadow text-white bg-danger text-center" style="width: 160px; height: 160px;">
        <div class="card-body d-flex flex-column align-items-center justify-content-center">
            <i class="bi bi-list-task fs-2"></i>
            <h6 class="card-title mt-2">Total Tugas</h6>
            <p class="card-text fs-4 fw-bold m-0">{{ $tasks->count() }}</p>
        </div>
    </div>

    {{-- Daftar List --}}
    <div class="card rounded shadow text-white bg-primary text-center " style="width: 160px; height: 160px;">
        <div class="card-body d-flex flex-column align-items-center justify-content-center">
            <i class="bi bi-card-checklist fs-2"></i>
            <h6 class="card-title mt-2">Total List</h6>
            <p class="card-text fs-4 fw-bold m-0">{{ $lists->count() }}</p>
        </div>
    </div>

    {{-- Tugas Selesai --}}
    <div class="card rounded shadow text-white bg-success text-center" style="width: 160px; height: 160px;">
        <div class="card-body d-flex flex-column align-items-center justify-content-center">
            <i class="bi bi-check-circle fs-2"></i>
            <h6 class="card-title mt-2">Selesai</h6>
            <p class="card-text fs-4 fw-bold m-0">{{ $tasks->where('is_completed', true)->count() }}</p>
        </div>
    </div>

    {{-- Tugas Belum Selesai --}}
    <div class="card rounded shadow text-white bg-warning text-center" style="width: 160px; height: 160px;">
        <div class="card-body d-flex flex-column align-items-center justify-content-center">
            <i class="bi bi-exclamation-circle fs-2"></i>
            <h6 class="card-title mt-2">Belum Selesai</h6>
            <p class="card-text fs-4 fw-bold m-0">{{ $tasks->where('is_completed', false)->count() }}</p>
        </div>
    </div>
</div>
{{-- End Count --}}
