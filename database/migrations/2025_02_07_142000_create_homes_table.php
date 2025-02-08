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
        Schema::create('homes', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->enum('type', ['Tetap', 'Kontrak']);
            $table->enum('status', ['Dihuni', 'Tidak Dihuni']);
            $table->timestamps();
        });
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('foto');
            $table->string('number_phone');
            $table->enum('status', ['Kontrak', 'Tetap']);
            $table->boolean('pernikahan');
            $table->foreignId('home_id')->constrained('homes')->onDelete('cascade')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homes');
    }
};
