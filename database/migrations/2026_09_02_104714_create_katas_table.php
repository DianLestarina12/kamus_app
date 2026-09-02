<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('katas', function (Blueprint $table) {
            $table->id();
             $table->string('kruna_andap');
        $table->string('kruna_asi');
        $table->string('kruna_aso');
        $table->string('kruna_ami');
        $table->string('kruna_mider'); 
        $table->string('kruna_kasar');
        $table->string('bahasa_Indonesia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('katas');
    }
};
