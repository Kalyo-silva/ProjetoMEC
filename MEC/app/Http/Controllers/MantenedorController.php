<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mantenedor;
use Illuminate\Support\Facades\Validator;

class MantenedorController extends Controller
{
    public function index(){
        $listaMantenedores = mantenedor::orderBy('nome', 'asc')->paginate(10);
        return view('mantenedor.index', compact('listaMantenedores'));
    }

    public function create(){
        $mode = 'create'; 
        return view('mantenedor.create', compact('mode'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'uf' => 'nullable|string|max:2',
            'cidade' => 'nullable|string|max:200',
            'bairro' => 'nullable|string|max:200',
            'logradouro' => 'nullable|string|max:200',
            'cep' => 'nullable|string|max:8'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->with('error', 'Dados inválidos, Tente novamente.');
        }

        $mantenedor = new mantenedor();

        $mantenedor->nome = $request->input('nome');
        $mantenedor->uf = $request->input('uf');
        $mantenedor->cidade = $request->input('cidade');
        $mantenedor->bairro = $request->input('bairro');
        $mantenedor->logradouro = $request->input('logradouro');
        $mantenedor->cep = $request->input('cep');

        if ($mantenedor->save()){
            return redirect()->route('mantenedores.index')->with('success', 'Mantenedor Cadastrado com sucesso!');
        }

        return redirect()->route('mantenedores.index')->with('error', 'Erro ao cadastrar o Mantenedor');;
    }

    public function edit(int $id){
        $mantenedor = mantenedor::findOrFail($id);
        $mode = 'edit';

        return view('mantenedor.create', compact('mantenedor','mode'));   
    }

    public function update(Request $request, int $id){
   
    }

    public function destroy(){

    }    
}
