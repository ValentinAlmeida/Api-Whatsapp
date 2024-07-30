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
        Schema::create('mensagem', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('telefone')->nullable();
            $table->string('mensagem')->nullable();
            $table->string('tipo')->nullable();
            $table->unsignedBigInteger('contato_id')->nullable();
            $table->foreign('contato_id')->references('id')->on('contatos')->onDelete('set null');
            $table->timestamp('data_envio')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mensagem', function (Blueprint $table) {
            $table->dropForeign(['contato_id']);
        });

        Schema::dropIfExists('mensagem');
    }
};