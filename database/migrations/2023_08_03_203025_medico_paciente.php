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
        Schema::create('medico_paciente', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('medico_id');
            $table->unsignedBigInteger('paciente_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('medico_id')->references('id')->on('medico');
            $table->foreign('paciente_id')->references('id')->on('paciente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medico_paciente');
    }
};
