<?php

namespace App\Http\Controllers;

use App\Models\criterio;
use App\Models\indicador;
use Illuminate\Http\Request;
use Validator;

class CriterioController extends Controller
{

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
            'descricao_criterio'    => 'required'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('error', 'Dados inválidos, tente novamente.');
        }

        $seq = criterio::max('sequencia')+1;

        $criterio = new criterio();
        $criterio->id_indicador = $request->input('id_indicador');
        $criterio->sequencia = $seq;
        $criterio->descricao = $request->input('descricao_criterio');

        $indicador = $criterio->id_indicador;

        if ($criterio->save()) {
            return redirect()->route('indicadores.show', $indicador)->with('success', 'Critério cadastrado com sucesso!');
        }

        return redirect()->route('indicadores.show', $indicador)->with('error', 'Erro ao cadastrar o critério');
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
            'descricao'    => 'required'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('error', 'Dados inválidos, tente novamente.');
        }

        $criterio = criterio::findOrFail($id);
        $criterio->descricao = $request->input('descricao');

        if ($criterio->save()) {
            return redirect()->route('indicadores.show', $criterio->indicador)->with('success', 'Critério alterado com sucesso!');
        }

        return redirect()->route('indicadores.show', $criterio->indicador)->with('error', 'Erro ao alterar o critério');
    }

    public function destroy(int $id)
    {
        $criterio = criterio::findOrFail($id);

        if ($criterio->delete()) {
            return redirect()->route('indicadores.show', $criterio->indicador)->with('success', 'Critério removido com sucesso!');
        }

        return redirect()->route('indicadores.show', $criterio->indicador)->with('error', 'Erro ao remover o critério');
    }




    public function up($id){
        $criterio = criterio::findOrFail($id);

        $criterioAnt = criterio::where('id_indicador', $criterio->id_indicador)
                               ->where('sequencia', $criterio->sequencia-1)
                               ->first();

        if ($criterioAnt){
            $criterio->sequencia = $criterio->sequencia-1;
            $criterioAnt->sequencia = $criterioAnt->sequencia+1;

            if ($criterio->save()){
                if ($criterioAnt->save()){
                    return redirect()->route('indicadores.show', $criterio->id_indicador);
                }

                return redirect()->route('indicadores.show', $criterio->id_indicador)->with('error', 'Erro ao alterar a dimensão');
            } 

            return redirect()->route('indicadores.show', $criterio->id_indicador)->with('error', 'Erro ao alterar a dimensão');
        }

        return redirect()->route('indicadores.show', $criterio->id_indicador)->with('error', 'Erro ao alterar a dimensão');
    }

    public function down($id){
        $criterio = criterio::findOrFail($id);

        $criterioNext = criterio::where('id_indicador', $criterio->id_indicador)
                               ->where('sequencia', $criterio->sequencia+1)
                               ->first();

        if ($criterioNext){
            $criterio->sequencia = $criterio->sequencia+1;
            $criterioNext->sequencia = $criterioNext->sequencia-1;

            if ($criterio->save()){
                if ($criterioNext->save()){
                    return redirect()->route('indicadores.show', $criterio->id_indicador);
                }

                return redirect()->route('indicadores.show', $criterio->id_indicador)->with('error', 'Erro ao alterar a dimensão');
            } 

            return redirect()->route('indicadores.show', $criterio->id_indicador)->with('error', 'Erro ao alterar a dimensão');
        }

        return redirect()->route('indicadores.show', $criterio->id_indicador)->with('error', 'Erro ao alterar a dimensão');

    }

}
