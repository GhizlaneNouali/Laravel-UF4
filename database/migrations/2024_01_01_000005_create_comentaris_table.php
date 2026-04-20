<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comentaris', function (Blueprint $table) {
            $table->id();
            $table->text('descripcio');
            $table->foreignId('cotxe_id')
                  ->constrained('cotxes')
                  ->onDelete('cascade');
            $table->foreignId('usuari_id')
                  ->constrained('usuaris')
                  ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comentaris');
    }
};
