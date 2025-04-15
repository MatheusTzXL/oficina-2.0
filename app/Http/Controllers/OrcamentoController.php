<?php

namespace App\Http\Controllers;

use App\Models\Orcamento;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrcamentoRequest;
use App\Http\Requests\UpdateOrcamentoRequest;

class OrcamentoController extends Controller
{
    /**
     * Exibe a lista de orçamentos com filtros e paginação.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Orcamento::query();

        // Filtros de busca
        if ($request->filled('cliente')) {
            $query->where('cliente', 'like', '%' . $request->cliente . '%');
        }

        if ($request->filled('vendedor')) {
            $query->where('vendedor', 'like', '%' . $request->vendedor . '%');
        }

        if ($request->filled('data')) {
            $query->whereDate('data_hora', $request->data);
        }

        // Paginação
        $orcamentos = $query->orderBy('data_hora', 'desc')->paginate(10);

        return view('orcamentos.index', compact('orcamentos'));
    }

    /**
     * Exibe o formulário para criação de um novo orçamento.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('orcamentos.create');
    }

    /**
     * Armazena um novo orçamento no banco de dados.
     *
     * @param StoreOrcamentoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreOrcamentoRequest $request)
    {
        $dados = $request->validated();

        Orcamento::create($dados);

        return redirect()->back()->with('success', 'Orçamento criado com sucesso!');
    }

    /**
     * Exibe o orçamento especificado (ainda não implementado).
     *
     * @param Orcamento $orcamento
     * @return void
     */
    public function show(Orcamento $orcamento)
    {
        //
    }

    /**
     * Exibe o formulário de edição para o orçamento especificado.
     *
     * @param Orcamento $orcamento
     * @return \Illuminate\View\View
     */
    public function edit(Orcamento $orcamento)
    {
        return view('orcamentos.edit', compact('orcamento'));
    }

    /**
     * Atualiza o orçamento especificado no banco de dados.
     *
     * @param UpdateOrcamentoRequest $request
     * @param Orcamento $orcamento
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateOrcamentoRequest $request, Orcamento $orcamento)
    {
        $dados = $request->validated();

        $orcamento->update($dados);

        return redirect()->route('orcamentos.index')->with('success', 'Orçamento atualizado com sucesso!');
    }

    /**
     * Remove o orçamento especificado do banco de dados.
     *
     * @param Orcamento $orcamento
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Orcamento $orcamento)
    {
        $orcamento->delete();

        return redirect()->route('orcamentos.index')->with('success', 'Orçamento excluído com sucesso!');
    }
}


