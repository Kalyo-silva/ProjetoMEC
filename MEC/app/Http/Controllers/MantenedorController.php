<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mantenedor;

class MantenedorController extends Controller
{
    public function index(){
        $listaMantenedores = mantenedor::orderBy('nome', 'asc')->paginate(10);
        
        return view('mantenedor.index', compact('listaMantenedores'));
    }

    public function show(){

    }

    public function create(){
        $mode = 'create';

        return view('mantenedor.create', compact('mode'));
    }

    public function store(Request $request){
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

    public function edit(){
        $mode = 'edit';

        return view('mantenedor.create', compact('mode'));   
    }

    public function update(){
   
    }

    public function destroy(){

    }    
}
