<?php

namespace App\Http\Controllers;

use App\Models\professor;
use Illuminate\Http\Request;
use Validator;

class ProfessorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search){
            $listaProfessores = professor::where('nome', 'ILIKE', '%'.$search.'%')
                                            ->orderBy('nome', 'asc')
                                            ->paginate(10);
        }
        else{
            $listaProfessores = professor::orderBy('nome', 'asc')->paginate(10);    
        }

        return view('professores.index', compact('listaProfessores', 'search'));
    }

    public function create()
    {
        $mode = 'create';
        return view('professores.create', compact('mode'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome'           => 'required|string|max:255',
            'data_admissao'  => 'nullable|date',
            'titulacao'      => 'nullable|string|max:255',
            'regime'         => 'nullable|string|max:255',
            'vinculo'        => 'nullable|string|max:255',
            'lattes'         => 'nullable|url|max:500'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->with('error', 'Dados inválidos, tente novamente.');
        }

        $professor = new professor();

        $professor->nome = $request->input('nome');
        $professor->data_admissao = $request->input('data_admissao');
        $professor->titulacao = $request->input('titulacao');
        $professor->regime = $request->input('regime');
        $professor->vinculo = $request->input('vinculo');
        $professor->lattes = $request->input('lattes');

        if ($professor->save()) {
            return redirect()->route('professores.index')->with('success', 'Professor cadastrado com sucesso!');
        }

        return redirect()->route('professores.index')->with('error', 'Erro ao cadastrar o professor');
    }

    public function edit(int $id)
    {
        $mode = 'edit';
        $professor = professor::findOrFail($id);

        return view('professores.create', compact('mode', 'professor'));
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'nome'           => 'required|string|max:255',
            'data_admissao'  => 'nullable|date',
            'titulacao'      => 'nullable|string|max:255',
            'regime'         => 'nullable|string|max:255',
            'vinculo'        => 'nullable|string|max:255',
            'lattes'         => 'nullable|url|max:500'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->with('error', 'Dados inválidos, tente novamente.');
        }

        $professor = professor::findOrFail($id);

        $professor->nome = $request->input('nome');
        $professor->data_admissao = $request->input('data_admissao');
        $professor->titulacao = $request->input('titulacao');
        $professor->regime = $request->input('regime');
        $professor->vinculo = $request->input('vinculo');
        $professor->lattes = $request->input('lattes');

        if ($professor->save()) {
            return redirect()->route('professores.index')->with('success', 'Professor atualizado com sucesso!');
        }

        return redirect()->route('professores.index')->with('error', 'Erro ao atualizar o professor');
    }

    public function destroy(int $id)
    {
        $professor = professor::findOrFail($id);

        if ($professor->delete()) {
            return redirect()->route('professores.index')->with('success', 'Professor removido com sucesso!');
        }

        return redirect()->route('professores.index')->with('error', 'Erro ao remover o professor');
    }
}
