<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Kolom tingkatan selain kruna_andap boleh kosong (mis. saat import CSV).
    protected const KOLOM_OPSIONAL = ['kruna_asi', 'kruna_aso', 'kruna_ami', 'kruna_mider', 'kruna_kasar'];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('katas', function (Blueprint $table) {
            foreach (self::KOLOM_OPSIONAL as $kolom) {
                $table->string($kolom)->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('katas', function (Blueprint $table) {
            foreach (self::KOLOM_OPSIONAL as $kolom) {
                $table->string($kolom)->nullable(false)->change();
            }
        });
    }
};
