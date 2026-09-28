<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kata_relasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kata_id')->constrained('katas')->cascadeOnDelete();
            $table->foreignId('kata_terkait_id')->constrained('katas')->cascadeOnDelete();
            $table->enum('tipe', ['sinonim', 'homonim']);
            $table->string('tingkatan')->nullable();
            $table->timestamps();
 
            $table->unique(['kata_id', 'kata_terkait_id', 'tipe']);
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('kata_relasi');
    }
};
