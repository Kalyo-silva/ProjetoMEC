<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mantenedor;
use Illuminate\Support\Facades\Validator;

class MantenedorController extends Controller
{
    public function index()
    {
        $listaMantenedores = mantenedor::with('instituicao')->orderBy('nome', 'asc')->paginate(10);
        return view('mantenedor.index', compact('listaMantenedores'));
    }

    public function create()
    {
        $mode = 'create';
        return view('mantenedor.create', compact('mode'));
    }

    public function store(Request $request)
    {
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

        if ($mantenedor->save()) {
            return redirect()->route('mantenedores.index')->with('success', 'Mantenedor Cadastrado com sucesso!');
        }

        return redirect()->route('mantenedores.index')->with('error', 'Erro ao cadastrar o Mantenedor');
        ;
    }

    public function edit(int $id)
    {
        $mantenedor = mantenedor::findOrFail($id);
        $mode = 'edit';

        return view('mantenedor.create', compact('mantenedor', 'mode'));
    }

    public function update(Request $request, int $id)
    {       
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

        $mantenedor = mantenedor::findOrFail($id);

        $mantenedor->nome = $request->input('nome');
        $mantenedor->uf = $request->input('uf');
        $mantenedor->cidade = $request->input('cidade');
        $mantenedor->bairro = $request->input('bairro');
        $mantenedor->logradouro = $request->input('logradouro');
        $mantenedor->cep = $request->input('cep');

        if ($mantenedor->save()) {
            return redirect()->route('mantenedores.index')->with('success', 'Mantenedor Alterado com sucesso!');
        }

        return redirect()->route('mantenedores.index')->with('error', 'Erro ao Alterar o Mantenedor.');
    }


    public function show(int $id){
        $mantenedor = mantenedor::findOrFail($id);

        if ($mantenedor){
            $listaInstituicoes = $mantenedor->instituicao;

            if (!$listaInstituicoes->isEmpty()) {
                return redirect()->route('mantenedores.index')->with('error', 'O mantenedor possui instituições vinculadas, não é possível deletar o registro.');
            };

            return view('mantenedor.show', compact('mantenedor', 'listaInstituicoes'));
        }
        
        return redirect()->route('mantenedores.index')->with('error', 'Erro ao Encontrar o Mantenedor.');  
    }

    public function destroy(int $id)
    {
        $mantenedor = mantenedor::findOrFail($id);

        if ($mantenedor->delete()){
            return redirect()->route('mantenedores.index')->with('success', 'Mantenedor removido com sucesso!');
        }

        return redirect()->route('mantenedores.index')->with('error', 'Erro ao remover o Mantenedor.');
    }
}
