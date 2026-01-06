<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    
                    <div class="flex items-center">
                        <x-eva-person-outline class="size-6 mr-2 text-gray-400"/>
                        <h2 class="text-lg border-b-2 border-indigo-400 w-fit">@if ($mode = 'edit' && isset($professor)) Alteração do professor @else Cadastro de Professores @endif</h2>
                    </div>

                    @if ($mode == 'edit' && isset($professor))
                        <form method="POST" class="mt-4 border rounded p-6 shadow-lg" enctype="multipart/form-data" action="{{ route('professores.update', $professor->id) }}">
                        @method("PUT")
                    @else
                        <form method="POST" class="mt-4 border rounded p-6 shadow-lg" enctype="multipart/form-data" action="{{ route('professores.store') }}">
                    @endif
                        @csrf
                        <div>
                            <div class='labeledInput'>
                                <label for='nome'>Nome</label>
                                <input name='nome' required maxlength="200" id='nome' type='text' @if($mode == 'edit' && isset($professor)) value="{{$professor->nome}}" @endif>
                            </div>

                            <div class='flex justify-between gap-4'>
                                <div class='labeledInput w-4/12'>
                                    <label for='data_admissao'>Data de admissão</label>
                                    <input name='data_admissao' id='data_admissao' maxlength="200" type='date' @if($mode == 'edit' && isset($professor)) value="{{$professor->data_admissao}}" @endif>
                                </div>
                                <div class='labeledInput w-8/12'>
                                    <label for='titulacao'>Titulação</label>
                                    <select name="titulacao" id="titulacao" class="rounded">
                                        <option value="especializacao" @if($mode == 'edit' && isset($professor) && $professor->titulacao == 'especializacao') selected @endif>Especialização</option>
                                        <option value="mestrado" @if($mode == 'edit' && isset($professor) && $professor->titulacao == 'mestrado') selected @endif>Mestrado</option>
                                        <option value="doutorado" @if($mode == 'edit' && isset($professor) && $professor->titulacao == 'doutorado') selected @endif>Doutorado</option>
                                        <option value="pos_doutorado" @if($mode == 'edit' && isset($professor) && $professor->titulacao == 'pos_doutorado') selected @endif>Pós-doutorado</option>
                                    </select>

                                </div>
                            </div>
                            <div class='flex justify-between gap-4'>
                                <div class='labeledInput w-full'>
                                    <label for='regime'>Regime</label>
                                    <select name="regime" id="regime" class="rounded">
                                        <option value="CLT" @if($mode == 'edit' && isset($professor) && $professor->regime == 'CLT') selected @endif>CLT</option>
                                        <option value="Estagio" @if($mode == 'edit' && isset($professor) && $professor->regime == 'Estagio') selected @endif>Estágio</option>
                                        <option value="PJ" @if($mode == 'edit' && isset($professor) && $professor->regime == 'PJ') selected @endif>Pessoa Jurídica</option>
                                        <option value="Terceirizacao" @if($mode == 'edit' && isset($professor) && $professor->regime == 'Terceirizacao') selected @endif>Terceirização</option>
                                    </select>
                                </div>
                                <div class='labeledInput w-full'>
                                    <label for='vinculo'>Tipo de vínculo</label>
                                    <input name='vinculo' id='vinculo' type='text' @if($mode == 'edit' && isset($professor)) value={{$professor->vinculo}} @endif>
                                </div>
                            </div>
                            <div class='labeledInput'>
                                <label for='lattes'>Currículo Lattes</label>
                                <input name='lattes' maxlength="200" id='lattes' type='text' @if($mode == 'edit' && isset($professor)) value="{{$professor->lattes}}" @endif>
                            </div>
                        </div>

                        <div class='mt-8 flex gap-4 flex-row-reverse'>
                            <button type="submit" class='linkButton hover:text-green-700 hover:border-green-700'>Salvar</button>
                            @if ($mode == 'edit' && isset($professor))
                                <a href="{{route('professores.index')}}" class='linkButton hover:text-indigo-400 hover:border-indigo-400'>Cancelar</a>
                                <a onclick='OpenModal()' class='linkButton hover:text-red-700 hover:border-red-700'>Deletar</a>
                            @else
                                <button type="reset" class='linkButton hover:text-red-700 hover:border-red-700'>Limpar</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($mode == 'edit' && isset($professor))
        <x-confirm-remove-professor :id="$professor->id" :nome="$professor->nome"/>
    @endif
</x-app-layout>