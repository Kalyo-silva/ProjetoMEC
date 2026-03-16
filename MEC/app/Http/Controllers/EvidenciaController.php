<?php

namespace App\Http\Controllers;

use App\Models\evidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Validator;

use App\View\Components\filemanager_files;
use App\View\Components\filemanager_links;
use App\View\Components\filemanager_texts;
use App\View\Components\filemanager_details;

class EvidenciaController extends Controller
{
    public function files(){
        $listaArquivos = evidencia::whereNotNull('file_path')->where('tipo', 6)->orderBy('titulo', 'desc')->paginate(10);
        $listaImagens = evidencia::whereNotNull('file_path')->where('tipo', 3)->orderBy('titulo', 'desc')->paginate(10);
        $listaAudios = evidencia::whereNotNull('file_path')->where('tipo', 4)->orderBy('titulo', 'desc')->paginate(10);
        $listaVideos = evidencia::whereNotNull('file_path')->where('tipo', 5)->orderBy('titulo', 'desc')->paginate(10);

        $arquivos = array(
            "arquivos" => $listaArquivos,
            "imagens" => $listaImagens,
            "audios" => $listaAudios,
            "videos" => $listaVideos
        );

        $obj = new filemanager_files($arquivos);

        return $obj->render()->with($obj->data());
    }

    public function links($size = 0){
        $newSize = $size + 5;

        $listaLinks = evidencia::whereNotNull('link')->orderBy('ano', 'desc')->take($newSize)->get();
        
        $obj = new filemanager_links($listaLinks, evidencia::whereNotNull('link')->count());

        return $obj->render()->with($obj->data());
    }

    public function Texts(){
        $listaTextos = evidencia::whereNotNull('texto')->orderBy('ano', 'desc')->paginate(10);

        $obj = new filemanager_texts($listaTextos);

        return $obj->render()->with($obj->data());
    }


    public function details(int $id){
        $evidencia = evidencia::findOrFail($id);

        if ($evidencia){
            $obj = new filemanager_details($evidencia);
            return $obj->render()->with($obj->data());
        }
        else{
            return back()->with('error', 'Evidência Não Encontrada, tente novamente.');
        }
    }

    public function store_file(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file_path' => 'required|file'
        ]);
        $evidencia = new evidencia();

        $file = $request->file('file_path');
        
        if ($file) {
            $evidencia->titulo = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $evidencia->ano = date('Y');
            $filename = date('YmdHis') . '_' . $file->getClientOriginalName();
            
            if (in_array(pathinfo($filename, PATHINFO_EXTENSION), ['png','jpg','jpeg'])){
                $evidencia->tipo = 3;
            }
            else if (in_array(pathinfo($filename, PATHINFO_EXTENSION), ['mp3'])){
                $evidencia->tipo = 4;
            }
            else if (in_array(pathinfo($filename, PATHINFO_EXTENSION), ['mp4', 'avi'])){
                $evidencia->tipo = 5;
            }
            else {
                $evidencia->tipo = 6;
            }

            $file->move(public_path('uploads_evidencias'), $filename);
            $evidencia->file_path = $filename;
        }

        if ($evidencia->save()) {
            return redirect()->back()->with('success', 'Evidência cadastrada com sucesso!');
        }

        return redirect()->back()->with('error', 'Erro ao cadastrar a evidência');
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
        $evidencia->textAvaliaçãoo = $request->input('texto');

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
            return redirect()->back()->with('success', 'Evidência removida com sucesso!');
        }

        return redirect()->back()->with('error', 'Erro ao remover a evidência');
    }
}
