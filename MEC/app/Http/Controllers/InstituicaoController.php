<?php

namespace App\Http\Controllers;

use App\Models\instituicao;
use App\Models\mantenedor;
use Illuminate\Http\Request;
use Validator;

class InstituicaoController extends Controller
{
    public function index()
    {
        $listaInstituicoes = instituicao::orderBy('nome', 'asc')->paginate(10);
        return view('instituicoes.index', compact('listaInstituicoes'));
    }

    public function show()
    {

    }

    public function create()
    {
        $mode = 'create';

        $listaMantenedores = mantenedor::all();

        return view('instituicoes.create', compact('mode', 'listaMantenedores'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'uf' => 'nullable|string|max:2',
            'cidade' => 'nullable|string|max:200',
            'bairro' => 'nullable|string|max:200',
            'logradouro' => 'nullable|string|max:200',
            'cep' => 'nullable|string|max:8',
            'id_mantenedor' => 'integer',
            'sigla' => 'string|max:50',
            'logo' => 'image'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->with('error', 'Dados inválidos, Tente novamente.');
        }

        $instituicao = new instituicao();

        $instituicao->nome = $request->input('nome');
        $instituicao->uf = $request->input('uf');
        $instituicao->cidade = $request->input('cidade');
        $instituicao->bairro = $request->input('bairro');
        $instituicao->logradouro = $request->input('logradouro');
        $instituicao->cep = $request->input('cep');
        $instituicao->id_mantenedor = $request->input('id_mantenedor');
        $instituicao->sigla = $request->input('sigla');

        if ($foto = $request->file('logo')) {
            $filename = date('YmdHis') . $foto->getClientOriginalName();
            $foto->move(public_path('img_instituicoes'), $filename);
            $instituicao->logo = $filename;
        }

        if ($instituicao->save()) {
            return redirect()->route('instituicoes.index')->with('success', 'instituicao Cadastrado com sucesso!');
        }

        return redirect()->route('instituicoes.index')->with('error', 'Erro ao cadastrar o instituicao');
        ;

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
