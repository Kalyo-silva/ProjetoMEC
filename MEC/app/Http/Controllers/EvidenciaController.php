<?php

namespace App\Http\Controllers;

use App\Models\evidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Validator;

class EvidenciaController extends Controller
{
    public function index()
    {
        $listaArquivos = evidencia::whereNotNull('file_path')->orderBy('ano', 'desc')->paginate(10);
        $listaTextos = evidencia::whereNotNull('texto')->orderBy('ano', 'desc')->paginate(10);
        return view('evidencias.index', compact('listaArquivos', 'listaTextos'));
    }

    public function show(int $id)
    {
        $evidencia = evidencia::findOrFail($id);

        if ($evidencia) {
            return view('evidencias.show', compact('evidencia'));
        }

        return redirect()->route('evidencias.index')->with('error', 'Evidência não encontrada...');
    }

    public function create()
    {
        $mode = 'create';
        return view('evidencias.create', compact('mode'));
    }

    public function store_file(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file_path' => 'required|file'
        ]);
        $evidencia = new evidencia();

        $file = $request->file('file_path');
        
        if ($file) {
            $evidencia->titulo = $file->getClientOriginalName();
            $evidencia->ano = date('Y');
            $evidencia->tipo = 2;
            $filename = date('YmdHis') . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads_evidencias'), $filename);
            $evidencia->file_path = $filename;
        }

        if ($evidencia->save()) {
            return redirect()->route('avaliacoes.show', 1)->with('success', 'Evidência cadastrada com sucesso!');
        }

        return redirect()->route('avaliacoes.index')->with('error', 'Erro ao cadastrar a evidência');
    }

    public function store_link(Request $request){
        $validator = Validator::make($request->all(), [
            'link'      => 'required|url',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('error', 'Link inválido, tente novamente.');
        }

        $evidencia = new evidencia();
        $evidencia->titulo = $request->input('link');
        $evidencia->ano = date('Y');
        $evidencia->tipo = 1;
        $evidencia->link = $request->input('link');

        if ($evidencia->save()) {
            return redirect()->route('avaliacoes.show', 1)->with('success', 'Evidência cadastrada com sucesso!');
        }

        return redirect()->route('avaliacoes.index')->with('error', 'Erro ao cadastrar a evidência');

    }

    public function store_text(Request $request){
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'texto'   => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('error', 'Link inválido, tente novamente.');
        }

        $evidencia = new evidencia();
        $evidencia->titulo = $request->input('titulo');
        $evidencia->ano = date('Y');
        $evidencia->tipo = 2;
        $evidencia->texto = $request->input('texto');

        if ($evidencia->save()) {
            return redirect()->route('avaliacoes.show', 1)->with('success', 'Evidência cadastrada com sucesso!');
        }

        return redirect()->route('avaliacoes.index')->with('error', 'Erro ao cadastrar a evidência');

    }

    public function edit(int $id)
    {
        $mode = 'edit';
        $evidencia = evidencia::findOrFail($id);

        return view('evidencias.create', compact('mode', 'evidencia'));
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'titulo'    => 'required|string|max:255',
            'ano'       => 'required|integer|min:1900|max:2100',
            'tipo'      => 'required|string|max:50',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,jpg,png',
            'link'      => 'nullable|url',
            'texto'     => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with('error', 'Dados inválidos, tente novamente.');
        }

        $evidencia = evidencia::findOrFail($id);

        $evidencia->titulo = $request->input('titulo');
        $evidencia->ano = $request->input('ano');
        $evidencia->tipo = $request->input('tipo');
        $evidencia->link = $request->input('link');
        $evidencia->texto = $request->input('texto');

        if ($file = $request->file('file_path')) {
            // Remove arquivo antigo se existir
            if ($evidencia->file_path) {
                File::delete(public_path('uploads_evidencias/' . $evidencia->file_path));
            }

            $filename = date('YmdHis') . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads_evidencias'), $filename);
            $evidencia->file_path = $filename;
        }

        if ($evidencia->save()) {
            return redirect()->route('evidencias.index')->with('success', 'Evidência atualizada com sucesso!');
        }

        return redirect()->route('evidencias.index')->with('error', 'Erro ao atualizar a evidência');
    }

    public function destroy(int $id)
    {
        $evidencia = evidencia::findOrFail($id);

        // Remove arquivo se existir
        if ($evidencia->file_path) {
            File::delete(public_path('uploads_evidencias/' . $evidencia->file_path));
        }

        if ($evidencia->delete()) {
            return redirect()->route('evidencias.index')->with('success', 'Evidência removida com sucesso!');
        }

        return redirect()->route('evidencias.index')->with('error', 'Erro ao remover a evidência');
    }
}
