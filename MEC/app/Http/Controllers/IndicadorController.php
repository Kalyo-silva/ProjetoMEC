<?php

namespace App\Http\Controllers;

use App\Models\indicador;
use App\Models\dimensao;
use Illuminate\Http\Request;
use Validator;

class IndicadorController extends Controller
{
    public function index()
    {
        $listaIndicadores = indicador::orderBy('sequencia', 'asc')->paginate(10);
        return view('indicadores.index', compact('listaIndicadores'));
    }

    public function show(int $id)
    {
        $indicador = indicador::findOrFail($id);

        if ($indicador) {
            return view('indicadores.show', compact('indicador'));
        }

        return redirect()->route('indicadores.index')->with('error', 'Indicador não encontrado...');
    }

    public function create()
    {
        $mode = 'create';

        // Select de dimensões
        $listaDimensoes = dimensao::orderBy('sequencia', 'asc')->get();

        return view('indicadores.create', compact(
            'mode',
            'listaDimensoes'
        ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_dimensao' => 'required|integer',
            'sequencia_indicador'   => 'required|integer|min:1',
            'descricao_indicador'   => 'required|string|max:500'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('error', 'Dados inválidos, tente novamente.');
        }

        $indicador = new indicador();

        $indicador->id_dimensao = $request->input('id_dimensao');
        $indicador->sequencia = $request->input('sequencia_indicador');
        $indicador->descricao = $request->input('descricao_indicador');

        if ($indicador->save()) {
            return redirect()->route('instrumentos.index')->with('success', 'Indicador cadastrado com sucesso!');
        }

        return redirect()->route('instrumentos.index')->with('error', 'Erro ao cadastrar o indicador');
    }

    public function edit(int $id)
    {
        $mode = 'edit';
        $indicador = indicador::findOrFail($id);

        $listaDimensoes = dimensao::orderBy('sequencia', 'asc')->get();

        return view('indicadores.create', compact(
            'mode',
            'indicador',
            'listaDimensoes'
        ));
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'id_dimensao' => 'required|integer',
            'sequencia'   => 'required|integer|min:1',
            'descricao'   => 'required|string|max:500'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('error', 'Dados inválidos, tente novamente.');
        }

        $indicador = indicador::findOrFail($id);
        $indicador->update($request->all());

        return redirect()->route('indicadores.index')->with('success', 'Indicador atualizado com sucesso!');
    }

    public function destroy(int $id)
    {
        $indicador = indicador::findOrFail($id);

        if ($indicador->delete()) {
            return redirect()->route('indicadores.index')->with('success', 'Indicador removido com sucesso!');
        }

        return redirect()->route('indicadores.index')->with('error', 'Erro ao remover o indicador');
    }
}
