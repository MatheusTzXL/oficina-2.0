<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    /**
     * Atributos que podem ser atribuídos em massa.
     *
     * @var array<string>
     */
    protected $fillable = ['cliente', 'data_hora', 'vendedor', 'descricao', 'valor'];
}
