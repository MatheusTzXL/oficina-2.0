<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrcamentoRequest extends FormRequest
{
    /**
     * Determina se o usuário tem permissão para realizar esta requisição.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Obtém as regras de validação que se aplicam à requisição.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cliente' => 'required|string|max:255',
            'data_hora' => 'required|date',
            'vendedor' => 'required|string|max:255',
            'descricao' => 'required|string',
            'valor' => 'required|numeric|min:0',
        ];
    }
}

