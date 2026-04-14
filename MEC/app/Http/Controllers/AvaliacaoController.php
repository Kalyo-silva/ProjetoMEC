<?php

namespace App\Http\Controllers;

use App\Models\avaliacao;
use App\Models\evidencia;
use App\Models\instrumento;
use App\Models\curso;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;

use App\View\Components\avaliacao_current_indicador;

class AvaliacaoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search){
            $listaAvaliacoes = avaliacao::where('descricao', 'ILIKE', '%'.$search.'%')->orderBy('ano', 'desc')->paginate(10);
        }
        else{   
            $listaAvaliacoes = avaliacao::orderBy('ano', 'desc')->paginate(10);
        }

        return view('avaliacoes.index', compact('listaAvaliacoes', 'search'));
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
        $listaInstrumentos = instrumento::orderBy('ano','desc')->get();

        return view('avaliacoes.create', compact(
            'mode',
            'listaCursos',
            'listaInstrumentos'
        ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_instrumento' => 'required|integer',
            'id_curso'       => 'required|integer',
            'ano'            => 'required|integer|min:1900|max:2100',
            'descricao'      => 'required|string|max:500',
            'data_inicio'    => 'required|date',
            'data_fim'       => 'required|date|after_or_equal:data_inicio',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('error', 'Dados inválidos, tente novamente.');
        }

        $avaliacao = new avaliacao();
        $avaliacao->id_instrumento = $request->input('id_instrumento');
        $avaliacao->id_curso = $request->input('id_curso');
        $avaliacao->ano = $request->input('ano');
        $avaliacao->descricao = $request->input('descricao');
        $avaliacao->data_inicio = $request->input('data_inicio');
        $avaliacao->data_fim = $request->input('data_fim');
        $avaliacao->id_usuario = Auth::user()->id;

        if ($avaliacao->save()) {
            return redirect()->route('avaliacoes.index')->with('success', 'Avaliação cadastrada com sucesso!');
        }

        return redirect()->route('avaliacoes.index')->with('error', 'Erro ao cadastrar a avaliação');
    }

    public function edit(int $id)
    {
        $mode = 'edit';
        $avaliacao = avaliacao::findOrFail($id);

        // Carrega relacionamentos para selects
        $listaCursos = curso::orderBy('nome')->get();
        $listaInstrumentos = instrumento::orderBy('ano','desc')->get();

        return view('avaliacoes.create', compact(
            'mode',
            'avaliacao',
            'listaCursos',
            'listaInstrumentos'
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

    public function indicador(int $id, int $dimensao, int $indicador){
        
        $avaliacao = avaliacao::findOrFail($id);

        if ($avaliacao) {    
            $obj = new avaliacao_current_indicador($avaliacao, $dimensao, $indicador);

            $result = [
                "maxDimension" => $avaliacao->instrumento->dimensoes->count(),
                "maxIndicador" => $avaliacao->instrumento->dimensoes[$dimensao]->indicadores->count(),
            ];
            
            return $obj->render()->with($obj->data());
        }

        return redirect()->back()->with('error', 'Erro ao encontrar avaliação');
    }
}
