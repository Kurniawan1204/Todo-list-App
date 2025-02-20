<?php

use Illuminate\Database\Migrations\Migration; // Mengimpor kelas Migration
use Illuminate\Database\Schema\Blueprint; // Mengimpor kelas Blueprint untuk membuat tabel
use Illuminate\Support\Facades\Schema; // Mengimpor Schema untuk manipulasi database

return new class extends Migration
{
    /**
     * Menjalankan migrasi untuk membuat tabel task_lists.
     */
    public function up(): void
    {
        Schema::create('task_lists', function (Blueprint $table) {
            $table->id(); // Membuat kolom id sebagai primary key (auto-increment)
            $table->string('name')->unique(); // Membuat kolom name yang bersifat unik
            $table->timestamps(); // Membuat kolom created_at dan updated_at secara otomatis
        });
    }

    /**
     * Membatalkan migrasi dan menghapus tabel task_lists.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_listis'); // Menghapus tabel jika migrasi dibatalkan
    }
};
