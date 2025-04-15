<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cria a tabela 'orcamentos' no banco de dados.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('orcamentos', function (Blueprint $table) {
            $table->id();
            $table->string('cliente');
            $table->dateTime('data_hora');
            $table->string('vendedor');
            $table->text('descricao');
            $table->decimal('valor', 8, 2); 
            $table->timestamps();
        });
    }

    /**
     * Remove a tabela 'orcamentos' do banco de dados.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('orcamentos');
    }
};

