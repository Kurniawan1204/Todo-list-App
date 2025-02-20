<?php

namespace App\Models; // Menentukan namespace model

use Illuminate\Database\Eloquent\Model; // Mengimpor base model dari Laravel

class TaskList extends Model
{
    
    // Menentukan atribut yang bisa diisi secara massal (mass assignment)
    protected $fillable = ['name'];

    // Menentukan atribut yang tidak boleh diisi secara massal
    protected $guarded = [
        'id',          // ID daftar tugas
        'created_at',  // Waktu pembuatan daftar tugas
        'updated_at'   // Waktu pembaruan daftar tugas
    ];

    // Relasi ke model Task (Satu TaskList memiliki banyak Task)
    public function tasks() {
        return $this->hasMany(Task::class, 'list_id'); // Relasi one-to-many ke Task
    }
}
