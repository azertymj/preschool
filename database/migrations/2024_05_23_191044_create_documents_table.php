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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->date('publie_le');
            $table->string('publie_par');
            $table->enum('extension', ['pdf', 'doc', 'xlxs', 'png', 'jpg']);
            $table->string('type_document');
            $table->boolean('etat');
            $table->text('description');
            $table->integer('nombre_vue')->default(0);
            $table->string('fichier')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
