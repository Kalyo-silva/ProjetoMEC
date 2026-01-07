<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-popup-message-handler/>

                    <div class="flex items-center">
                        <x-uni-university-o class="size-6 mr-2 text-gray-400"/>
                        <h2 class="text-lg border-b-2 border-indigo-400 w-fit">@if ($mode = 'edit' && isset($curso)) Alteração do Curso @else Cadastro de Curso @endif</h2>
                    </div>

                    @if ($mode == 'edit' && isset($curso))
                        <form method="POST" class="mt-4 border rounded p-6 shadow-lg" enctype="multipart/form-data" action="{{ route('cursos.update', $curso->id) }}">
                        @method("PUT")
                    @else
                        <form method="POST" class="mt-4 border rounded p-6 shadow-lg" enctype="multipart/form-data" action="{{ route('cursos.store') }}">
                    @endif
                        @csrf
                        <div class='labeledInput'>
                            <label for='nome'>Nome</label>
                            <input name='nome' required maxlength="200" id='nome' type='text' @if($mode == 'edit' && isset($curso)) value="{{$curso->nome}}" @endif>
                        </div>

                        <div class='flex justify-between gap-4'>
                            <div class='labeledInput w-2/4'>
                                <label for='id_instituicao'>Instituição</label>
                                <select name="id_instituicao" id="id_instituicao" class="rounded">
                                    @foreach ($listaInstituicoes as $inst)   
                                        <option value={{ $inst->id }} @if($mode == 'edit' && $inst->id == $curso->instituicao->id) selected @endif>{{$inst->nome}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class='labeledInput w-2/4'>
                                <label for='id_professor'>Professor</label>
                                <select name="id_professor" id="id_professor" class="rounded">
                                    @foreach ($listaProfessores as $prof)   
                                        <option value={{ $prof->id }} @if($mode == 'edit' && $prof->id == $curso->professor->id) selected @endif>{{$prof->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class='mt-8 flex gap-4 flex-row-reverse'>
                            <button type="submit" class='linkButton hover:text-green-700 hover:border-green-700'>Salvar</button>
                            @if ($mode == 'edit' && isset($curso))
                                <a href="{{route('cursos.index')}}" class='linkButton hover:text-red-700 hover:border-red-700'>Cancelar</a>
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

    @if ($mode == 'edit' && isset($curso))
        <x-confirm-remove :id="$curso->id" :nome="$curso->nome" :route="'cursos.destroy'"/>
    @endif
</x-app-layout>