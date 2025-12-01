<?php

namespace App\Http\Controllers;

use App\Models\criterio;
use App\Models\indicador;
use Illuminate\Http\Request;
use Validator;

class CriterioController extends Controller
{
    public function index()
    {
        $listaCriterios = criterio::orderBy('sequencia', 'asc')->paginate(10);
        return view('criterios.index', compact('listaCriterios'));
    }

    public function show(int $id)
    {
        $criterio = criterio::findOrFail($id);

        if ($criterio) {
            return view('criterios.show', compact('criterio'));
        }

        return redirect()->route('criterios.index')->with('error', 'Critério não encontrado...');
    }

    public function create()
    {
        $mode = 'create';

        // Select de indicadores
        $listaIndicadores = indicador::orderBy('sequencia', 'asc')->get();

        return view('criterios.create', compact(
            'mode',
            'listaIndicadores'
        ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_indicador' => 'required|integer',
            'sequencia'    => 'required|integer|min:1',
            'descricao'    => 'required|string|max:500'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('error', 'Dados inválidos, tente novamente.');
        }

        $criterio = new criterio($request->all());

        if ($criterio->save()) {
            return redirect()->route('criterios.index')->with('success', 'Critério cadastrado com sucesso!');
        }

        return redirect()->route('criterios.index')->with('error', 'Erro ao cadastrar o critério');
    }

    public function edit(int $id)
    {
        $mode = 'edit';
        $criterio = criterio::findOrFail($id);

        $listaIndicadores = indicador::orderBy('sequencia', 'asc')->get();

        return view('criterios.create', compact(
            'mode',
            'criterio',
            'listaIndicadores'
        ));
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'id_indicador' => 'required|integer',
            'sequencia'    => 'required|integer|min:1',
            'descricao'    => 'required|string|max:500'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('error', 'Dados inválidos, tente novamente.');
        }

        $criterio = criterio::findOrFail($id);
        $criterio->update($request->all());

        return redirect()->route('criterios.index')->with('success', 'Critério atualizado com sucesso!');
    }

    public function destroy(int $id)
    {
        $criterio = criterio::findOrFail($id);

        if ($criterio->delete()) {
            return redirect()->route('criterios.index')->with('success', 'Critério removido com sucesso!');
        }

        return redirect()->route('criterios.index')->with('error', 'Erro ao remover o critério');
    }
}
