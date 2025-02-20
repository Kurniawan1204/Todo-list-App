<?php

namespace App\Models; // Menentukan namespace model

use Illuminate\Database\Eloquent\Model; // Mengimpor base model dari Laravel
use App\Models\TaskList; // Mengimpor model TaskList untuk relasi

class Task extends Model
{
    
    // Menentukan atribut yang bisa diisi
    protected $fillable = [
        'name',         // Nama tugas
        'description',  // Deskripsi tugas
        'is_completed', // Status apakah tugas selesai atau tidak
        'deadline',     // Tenggat waktu tugas
        'priority',     // Prioritas tugas (low, medium, high)
        'list_id',      // ID daftar tugas terkait
    ];
    
    // Menentukan atribut yang tidak boleh diisi secara massal
    protected $guarded = [
        'id',          // ID tugas
        'created_at',  // Waktu pembuatan tugas
        'updated_at'   // Waktu terakhir tugas diperbarui
    ];

    // Konstanta untuk daftar prioritas yang tersedia
    const PRIORITIES = [
        'low',    // Prioritas rendah
        'medium', // Prioritas sedang
        'high'    // Prioritas tinggi
    ];

    // Getter untuk mendapatkan kelas CSS berdasarkan prioritas
    public function getPriorityClassAttribute() {
        return match($this->attributes['priority']) {
            'low' => 'success',   // Jika prioritas rendah, gunakan kelas CSS 'success'
            'medium' => 'warning', // Jika prioritas sedang, gunakan kelas CSS 'warning'
            'high' => 'danger',   // Jika prioritas tinggi, gunakan kelas CSS 'danger'
            default => 'secondary' // Jika tidak ada yang cocok, gunakan kelas 'secondary'
        };
    }

    // Relasi ke model TaskList (Setiap tugas milik satu daftar tugas)
    public function list() {
        return $this->belongsTo(TaskList::class, 'list_id');
    }
}
