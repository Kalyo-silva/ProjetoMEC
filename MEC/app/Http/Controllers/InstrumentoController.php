<?php

namespace App\Http\Controllers;

use App\Models\instrumento;
use Illuminate\Http\Request;
use Validator;

class InstrumentoController extends Controller
{
    public function index()
    {
        $listaInstrumentos = instrumento::orderBy('ano', 'desc')->paginate(10);
        return view('instrumentos.index', compact('listaInstrumentos'));
    }

    public function show(int $id)
    {
        $instrumento = instrumento::findOrFail($id);

        if ($instrumento) {
            return view('instrumentos.show', compact('instrumento'));
        }

        return redirect()->route('instrumentos.index')->with('error', 'Instrumento não encontrado...');
    }

    public function create()
    {
        $mode = 'create';
        return view('instrumentos.create', compact('mode'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'ano'    => 'required|integer|min:1900|max:2100'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->with('error', 'Dados inválidos, tente novamente.');
        }

        $instrumento = new instrumento();

        $instrumento->titulo = $request->input('titulo');
        $instrumento->ano = $request->input('ano');

        if ($instrumento->save()) {
            return redirect()->route('instrumentos.index')->with('success', 'Instrumento cadastrado com sucesso!');
        }

        return redirect()->route('instrumentos.index')->with('error', 'Erro ao cadastrar o instrumento');
    }

    public function edit(int $id)
    {
        $mode = 'edit';
        $instrumento = instrumento::findOrFail($id);

        return view('instrumentos.create', compact('mode', 'instrumento'));
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'ano'    => 'required|integer|min:1900|max:2100'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->with('error', 'Dados inválidos, tente novamente.');
        }

        $instrumento = instrumento::findOrFail($id);

        $instrumento->titulo = $request->input('titulo');
        $instrumento->ano = $request->input('ano');

        if ($instrumento->save()) {
            return redirect()->route('instrumentos.index')->with('success', 'Instrumento atualizado com sucesso!');
        }

        return redirect()->route('instrumentos.index')->with('error', 'Erro ao atualizar o instrumento');
    }

    public function destroy(int $id)
    {
        $instrumento = instrumento::findOrFail($id);

        if ($instrumento->delete()) {
            return redirect()->route('instrumentos.index')->with('success', 'Instrumento removido com sucesso!');
        }

        return redirect()->route('instrumentos.index')->with('error', 'Erro ao remover o instrumento');
    }
}
