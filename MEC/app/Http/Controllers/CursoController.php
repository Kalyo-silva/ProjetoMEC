<?php

namespace App\Http\Controllers;

use App\Models\curso;
use App\Models\instituicao;
use App\Models\professor;
use Illuminate\Http\Request;
use Validator;

class CursoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search){
            $listaCursos = curso::where('nome', 'ILIKE', '%'.$search.'%')
                                ->orderBy('nome', 'asc')
                                ->paginate(10);
        }
        else{
            $listaCursos = curso::orderBy('nome', 'asc')->paginate(10);
        }

        return view('cursos.index', compact('listaCursos', 'search'));
    }
    
    public function create()
    {
        $mode = 'create';

        // Carrega listas para selects (se existirem)
        $listaInstituicoes = instituicao::orderBy('nome')->get();
        $listaProfessores = professor::orderBy('nome')->get();

        return view('cursos.create', compact(
            'mode',
            'listaInstituicoes',
            'listaProfessores'
        ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'id_instituicao' => 'nullable|integer',
            'id_professor' => 'nullable|integer'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->with('error', 'Dados inválidos, tente novamente.');
        }

        $curso = new curso();

        $curso->nome = $request->input('nome');
        $curso->id_instituicao = $request->input('id_instituicao');
        $curso->id_professor = $request->input('id_professor');

        if ($curso->save()) {
            return redirect()->route('cursos.index')->with('success', 'Curso cadastrado com sucesso!');
        }

        return redirect()->route('cursos.index')->with('error', 'Erro ao cadastrar o curso');
    }

    public function edit(int $id)
    {
        $mode = 'edit';
        $curso = curso::findOrFail($id);

        $listaInstituicoes = instituicao::orderBy('nome')->get();
        $listaProfessores = professor::orderBy('nome')->get();

        return view('cursos.create', compact(
            'mode',
            'curso',
            'listaInstituicoes',
            'listaProfessores'
        ));
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'id_instituicao' => 'nullable|integer',
            'id_professor' => 'nullable|integer'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->with('error', 'Dados inválidos, tente novamente.');
        }

        $curso = curso::findOrFail($id);

        $curso->nome = $request->input('nome');
        $curso->id_instituicao = $request->input('id_instituicao');
        $curso->id_professor = $request->input('id_professor');

        if ($curso->save()) {
            return redirect()->route('cursos.index')->with('success', 'Curso atualizado com sucesso!');
        }

        return redirect()->route('cursos.index')->with('error', 'Erro ao atualizar o curso');
    }

    public function destroy(int $id)
    {
        $curso = curso::findOrFail($id);

        if ($curso->delete()) {
            return redirect()->route('cursos.index')->with('success', 'Curso removido com sucesso!');
        }

        return redirect()->route('cursos.index')->with('error', 'Erro ao remover o curso');
    }
}
