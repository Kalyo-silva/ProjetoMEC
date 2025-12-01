<?php

namespace App\Http\Controllers;

use App\Models\avaliacao;
use App\Models\curso;
use App\Models\User; // Se estiver usando o modelo padrão do Laravel
use Illuminate\Http\Request;
use Validator;

class AvaliacaoController extends Controller
{
    public function index()
    {
        $listaAvaliacoes = avaliacao::orderBy('ano', 'desc')->paginate(10);
        return view('avaliacoes.index', compact('listaAvaliacoes'));
    }

    public function show(int $id)
    {
        $avaliacao = avaliacao::findOrFail($id);

        if ($avaliacao) {
            return view('avaliacoes.show', compact('avaliacao'));
        }

        return redirect()->route('avaliacoes.index')->with('error', 'Avaliação não encontrada...');
    }

    public function create()
    {
        $mode = 'create';

        // Carrega relacionamentos para selects
        $listaCursos = curso::orderBy('nome')->get();
        $listaUsuarios = User::orderBy('name')->get();

        return view('avaliacoes.create', compact(
            'mode',
            'listaCursos',
            'listaUsuarios'
        ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_curso'    => 'required|integer',
            'ano'         => 'required|integer|min:1900|max:2100',
            'descricao'   => 'nullable|string|max:500',
            'data_inicio' => 'required|date',
            'data_fim'    => 'required|date|after_or_equal:data_inicio',
            'id_usuario'  => 'required|integer'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('error', 'Dados inválidos, tente novamente.');
        }

        $avaliacao = new avaliacao($request->all());

        if ($avaliacao->save()) {
            return redirect()->route('avaliacoes.index')->with('success', 'Avaliação cadastrada com sucesso!');
        }

        return redirect()->route('avaliacoes.index')->with('error', 'Erro ao cadastrar a avaliação');
    }

    public function edit(int $id)
    {
        $mode = 'edit';
        $avaliacao = avaliacao::findOrFail($id);

        $listaCursos = curso::orderBy('nome')->get();
        $listaUsuarios = User::orderBy('name')->get();

        return view('avaliacoes.create', compact(
            'mode',
            'avaliacao',
            'listaCursos',
            'listaUsuarios'
        ));
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'id_curso'    => 'required|integer',
            'ano'         => 'required|integer|min:1900|max:2100',
            'descricao'   => 'nullable|string|max:500',
            'data_inicio' => 'required|date',
            'data_fim'    => 'required|date|after_or_equal:data_inicio',
            'id_usuario'  => 'required|integer'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('error', 'Dados inválidos, tente novamente.');
        }

        $avaliacao = avaliacao::findOrFail($id);
        $avaliacao->update($request->all());

        return redirect()->route('avaliacoes.index')->with('success', 'Avaliação atualizada com sucesso!');
    }

    public function destroy(int $id)
    {
        $avaliacao = avaliacao::findOrFail($id);

        if ($avaliacao->delete()) {
            return redirect()->route('avaliacoes.index')->with('success', 'Avaliação removida com sucesso!');
        }

        return redirect()->route('avaliacoes.index')->with('error', 'Erro ao remover a avaliação');
    }
}
