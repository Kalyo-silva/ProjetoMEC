<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <x-popup-message-handler/>

                    <div class="flex justify-between items-center">

                        <div class="flex gap-1 items-center">
                            <x-eva-award-outline class="size-6 text-gray-400" />
                            <h2 class='text-xl border-b-2 border-indigo-400 font-bold'>Nova Avaliação</h2>
                        </div>
                    </div>

                    @if ($mode == 'edit' && isset($instituicao))
                        <form method="POST" class="mt-4 border rounded p-6 shadow-lg" enctype="multipart/form-data" action="{{ route('avaliacoes.update', $instituicao->id) }}">
                        @method("PUT")
                    @else
                        <form method="POST" class="mt-4 border rounded p-6 shadow-lg" enctype="multipart/form-data" action="{{ route('avaliacoes.store') }}">
                    @endif
                        @csrf
                            <div class="flex gap-4">
                                <div class="labeledInput w-10/12">
                                    <label for="descricao">Descrição da Avaliação</label>
                                    <input type="text" id="descricao" name="descricao">    
                                </div>    
                                <div class="labeledInput w-2/12">
                                    <label for="ano">Ano Avaliação</label>
                                    <input type="number" id="ano" name="ano" min="1900" max="2100">    
                                </div>    
                            </div>
                            <div class="labeledInput">
                                <label for="id_curso">Curso</label>
                                <select name="id_curso" id="id_curso" class="rounded">
                                    <option value="">Selecione</option>
                                    @foreach ($listaCursos as $curso)
                                        <option value="{{ $curso->id }}">{{$curso->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="labeledInput">
                                <label for="id_instrumento">Instrumento de Avaliação</label>
                                <select name="id_instrumento" id="id_instrumento" class="rounded">
                                    <option value="">Selecione</option>
                                    @foreach ($listaInstrumentos as $instrumento)
                                        <option value="{{ $instrumento->id }}">{{$instrumento->titulo}} ({{ $instrumento->ano }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex gap-4">
                                <div class="labeledInput w-6/12">
                                    <label for="data_inicio">Data Inicial da Aplicação</label>
                                    <input type="date" id="data_inicio" name="data_inicio">    
                                </div>    
                                <div class="labeledInput w-6/12">
                                    <label for="data_fim">Data Final da Aplicação</label>
                                    <input type="date" id="data_fim" name="data_fim">    
                                </div>    
                            </div>
                            <div class='mt-8 flex gap-4 flex-row-reverse'>
                                <button type="submit" class='linkButton hover:text-green-700 hover:border-green-700'>Salvar</button>
                                @if ($mode == 'edit' && isset($mantenedor))
                                    <a href="{{route('avaliacoes.index')}}" class='linkButton hover:text-red-700 hover:border-red-700'>Cancelar</a>
                                @else
                                    <button type="reset" class='linkButton hover:text-red-700 hover:border-red-700'>Limpar</button>
                                @endif
                            </div>
                        </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>