<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Kolom dibuat sebagai "bahasa_Indonesia", sedangkan model & view memakai "bahasa_indonesia".
    // Diganti lewat nama sementara karena SQLite tidak menganggap beda huruf besar/kecil sebagai nama baru.

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->ganti('bahasa_Indonesia', 'bahasa_indonesia');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->ganti('bahasa_indonesia', 'bahasa_Indonesia');
    }

    protected function ganti(string $dari, string $ke): void
    {
        Schema::table('katas', fn (Blueprint $table) => $table->renameColumn($dari, 'bahasa_indonesia_tmp'));
        Schema::table('katas', fn (Blueprint $table) => $table->renameColumn('bahasa_indonesia_tmp', $ke));
    }
};
