<?php

namespace App\Http\Controllers;

use App\Models\dimensao;
use App\Models\instrumento;
use Illuminate\Http\Request;
use Validator;

class DimensaoController extends Controller
{
    public function index()
    {
        $listaDimensoes = dimensao::orderBy('sequencia', 'asc')->paginate(10);
        return view('dimensoes.index', compact('listaDimensoes'));
    }

    public function show(int $id)
    {
        $dimensao = dimensao::findOrFail($id);

        if ($dimensao) {
            return view('dimensoes.show', compact('dimensao'));
        }

        return redirect()->route('dimensoes.index')->with('error', 'Dimensão não encontrada...');
    }

    public function create()
    {
        $mode = 'create';

        // Select de instrumentos
        $listaInstrumentos = instrumento::orderBy('ano', 'desc')->get();

        return view('dimensoes.create', compact(
            'mode',
            'listaInstrumentos'
        ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_instrumento' => 'required|integer',
            'sequencia'      => 'required|integer|min:1',
            'descricao'      => 'required|string|max:500'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('error', 'Dados inválidos, tente novamente.');
        }

        $dimensao = new dimensao($request->all());

        if ($dimensao->save()) {
            return redirect()->route('dimensoes.index')->with('success', 'Dimensão cadastrada com sucesso!');
        }

        return redirect()->route('dimensoes.index')->with('error', 'Erro ao cadastrar a dimensão');
    }

    public function edit(int $id)
    {
        $mode = 'edit';
        $dimensao = dimensao::findOrFail($id);

        $listaInstrumentos = instrumento::orderBy('ano', 'desc')->get();

        return view('dimensoes.create', compact(
            'mode',
            'dimensao',
            'listaInstrumentos'
        ));
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'id_instrumento' => 'required|integer',
            'sequencia'      => 'required|integer|min:1',
            'descricao'      => 'required|string|max:500'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('error', 'Dados inválidos, tente novamente.');
        }

        $dimensao = dimensao::findOrFail($id);
        $dimensao->update($request->all());

        return redirect()->route('dimensoes.index')->with('success', 'Dimensão atualizada com sucesso!');
    }

    public function destroy(int $id)
    {
        $dimensao = dimensao::findOrFail($id);

        if ($dimensao->delete()) {
            return redirect()->route('dimensoes.index')->with('success', 'Dimensão removida com sucesso!');
        }

        return redirect()->route('dimensoes.index')->with('error', 'Erro ao remover a dimensão');
    }
}
