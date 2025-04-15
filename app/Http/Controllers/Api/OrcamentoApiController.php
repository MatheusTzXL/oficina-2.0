<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Orcamento;
use Illuminate\Http\Request;

class OrcamentoApiController extends Controller
{
    /**
     * Exibe uma lista de orçamentos com filtros e paginação.
     *
     * Este método permite a filtragem de orçamentos por cliente, vendedor, intervalo de datas,
     * e ordenação por data. A resposta será paginada com 10 resultados por página.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = Orcamento::query();

        if ($request->filled('cliente')) {
            $query->where('cliente', 'like', '%' . $request->cliente . '%');
        }

        if ($request->filled('vendedor')) {
            $query->where('vendedor', 'like', '%' . $request->vendedor . '%');
        }

        if ($request->filled('data_inicio')) {
            $query->whereDate('data_hora', '>=', $request->data_inicio);
        }

        if ($request->filled('data_fim')) {
            $query->whereDate('data_hora', '<=', $request->data_fim);
        }

        $orcamentos = $query->orderBy('data_hora', 'desc')->paginate(10);
        
        return response()->json($orcamentos);
    }

    /**
     * Cria um novo orçamento.
     *
     * Este método recebe os dados do orçamento, valida as informações e armazena no banco de dados.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cliente' => 'required|string',
            'data_hora' => 'required|date',
            'vendedor' => 'required|string',
            'descricao' => 'required|string',
            'valor' => 'required|numeric',
        ]);

        $orcamento = Orcamento::create($validated);
        return response()->json($orcamento, 201);
    }

    /**
     * Exibe um orçamento específico.
     *
     * Este método retorna um orçamento específico com base no ID fornecido.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // Retorna o orçamento com o ID fornecido ou gera erro 404 caso não encontrado
        return response()->json(Orcamento::findOrFail($id));
    }

    /**
     * Atualiza um orçamento existente.
     *
     * Este método valida os dados recebidos e atualiza o orçamento com o ID fornecido.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'cliente' => 'required|string',
            'data_hora' => 'required|date',
            'vendedor' => 'required|string',
            'descricao' => 'required|string',
            'valor' => 'required|numeric',
        ]);

        $orcamento = Orcamento::findOrFail($id);
        $orcamento->update($validated);
        return response()->json($orcamento);
    }

    /**
     * Remove um orçamento do banco de dados.
     *
     * Este método apaga o orçamento com o ID fornecido.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Orcamento::destroy($id);
        return response()->json(null, 204);
    }
}


