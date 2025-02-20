<!-- Modal Tambah List -->
<div class="modal fade" id="addListModal" tabindex="-1" aria-labelledby="addListModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('lists.store') }}" method="POST" class="modal-content rounded-3 shadow">
            @method('POST')
            @csrf
            <div class="modal-header bg-primary text-white">
                <h1 class="modal-title fs-5" id="addListModalLabel">Tambah List</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nama List</label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Masukkan nama list..." required>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Tambah Task -->
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('tasks.store') }}" method="POST" class="modal-content rounded-3 shadow">
            @method('POST')
            @csrf
            <div class="modal-header bg-primary text-white">
                <h1 class="modal-title fs-5" id="addTaskModalLabel">Tambah Task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="taskListId" name="list_id">

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nama Task</label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Masukkan nama task..." required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description"
                        placeholder="Masukkan deskripsi tugas..." rows="3" required></textarea>
                </div>
                <div class="mb-3">
                        <label for="deadline" class="form-label">Deadline</label>
                        <input type="date" class="form-control" id="deadline" name="deadline" required>
                    </div>
                <div class="mb-3">
                    <label for="priority" class="form-label fw-semibold">Prioritas</label>
                    <select name="priority" id="priority" class="form-select">
                        <option value="low" class="text-success">Low</option>
                        <option value="medium" class="text-warning">Medium</option>
                        <option value="high" class="text-danger">High</option>  
                    </select>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>
</div>

             
      </div>
    </div>
  </div>
