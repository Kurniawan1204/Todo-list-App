<?php

use Illuminate\Database\Migrations\Migration; // Mengimpor kelas Migration
use Illuminate\Database\Schema\Blueprint; // Mengimpor kelas Blueprint untuk membuat tabel
use Illuminate\Support\Facades\Schema; // Mengimpor Schema untuk manipulasi database

return new class extends Migration
{
    /**
     * Menjalankan migrasi untuk membuat tabel tasks.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // Primary Key (Auto Increment)
           
            $table->string('name'); // Nama tugas
            $table->string('description')->nullable(); // Deskripsi tugas (opsional)
            $table->date('deadline'); // Tenggat waktu tugas (opsional)
            $table->boolean('is_completed')->default(false); // Status tugas, default tidak selesai
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium'); // Prioritas tugas
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at

             $table->foreignId('list_id') // Foreign Key yang merujuk ke tabel task_lists
                ->constrained('task_lists') // Menetapkan relasi dengan tabel task_lists
                ->onDelete('cascade'); // Jika task_list dihapus, semua task terkait ikut dihapus
        });
    }

    /**
     * Membatalkan migrasi dan menghapus tabel tasks.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks'); // Menghapus tabel jika migrasi dibatalkan
    }
};
