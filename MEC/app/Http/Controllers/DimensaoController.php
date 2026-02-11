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

    public function up($id){
        $dimensao = dimensao::findOrFail($id);

        $dimensaoAnt = dimensao::where('id_instrumento', $dimensao->id_instrumento)
                               ->where('sequencia', $dimensao->sequencia-1)
                               ->first();

        if ($dimensaoAnt){
            $dimensao->sequencia = $dimensao->sequencia-1;
            $dimensaoAnt->sequencia = $dimensaoAnt->sequencia+1;

            if ($dimensao->save()){
                if ($dimensaoAnt->save()){
                    return redirect()->route('instrumentos.show', $dimensao->id_instrumento);
                }

                return redirect()->route('instrumentos.show', $dimensao->id_instrumento)->with('error', 'Erro ao alterar a dimensão');
            } 

            return redirect()->route('instrumentos.show', $dimensao->id_instrumento)->with('error', 'Erro ao alterar a dimensão');
        }

        return redirect()->route('instrumentos.show', $dimensao->id_instrumento)->with('error', 'Erro ao alterar a dimensão');
    }

    public function down($id){
        $dimensao = dimensao::findOrFail($id);

        $dimensaoNext = dimensao::where('id_instrumento', $dimensao->id_instrumento)
                               ->where('sequencia', $dimensao->sequencia+1)
                               ->first();

        if ($dimensaoNext){
            $dimensao->sequencia = $dimensao->sequencia+1;
            $dimensaoNext->sequencia = $dimensaoNext->sequencia-1;

            if ($dimensao->save()){
                if ($dimensaoNext->save()){
                    return redirect()->route('instrumentos.show', $dimensao->id_instrumento);
                }

                return redirect()->route('instrumentos.show', $dimensao->id_instrumento)->with('error', 'Erro ao alterar a dimensão');
            } 

            return redirect()->route('instrumentos.show', $dimensao->id_instrumento)->with('error', 'Erro ao alterar a dimensão');
        }

        return redirect()->route('instrumentos.show', $dimensao->id_instrumento)->with('error', 'Erro ao alterar a dimensão');

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_instrumento' => 'required|integer',
            'descricao'      => 'required|string|max:500'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('error', 'Dados inválidos, tente novamente.');
        }

        $dimensao = new dimensao();

        $sequencia = dimensao::where('id_instrumento', $request->input('id_instrumento'))->orderBy('sequencia', 'desc')->first();
        
        if ($sequencia == null){
            $sequencia = 0;
        } else{
            $sequencia = $sequencia->sequencia;
        }


        $dimensao->id_instrumento = $request->input('id_instrumento');
        $dimensao->sequencia = $sequencia+1;
        $dimensao->descricao = $request->input('descricao');

        if ($dimensao->save()) {
            return redirect()->route('instrumentos.show', $dimensao->id_instrumento)->with('success', 'Dimensão cadastrada com sucesso!');
        }

        return redirect()->route('instrumentos.show', $dimensao->id_instrumento)->with('error', 'Erro ao cadastrar a dimensão');
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

        $instrumento = $dimensao->id_instrumento;

        if (count($dimensao->indicadores) == 0){

            
            if ($dimensao->delete()) {
                return redirect()->route('instrumentos.show', $instrumento)->with('success', 'Dimensão removida com sucesso!');
            }

            return redirect()->route('instrumentos.show', $instrumento)->with('error', 'Erro ao remover a dimensão');
        }
        else {
            return redirect()->route('instrumentos.show', $instrumento)->with('error', 'Erro ao remover a dimensão, ainda existem indicadores vinculados');
        }
    }
}
