<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('ime', 60); // NOT varchar
            $table->string('prezime', 80); // NOT varchar
            $table->enum('status', ['redovni', 'izvanredni']);
            $table->integer('godiste');
            $table->decimal('prosjek', 3, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

