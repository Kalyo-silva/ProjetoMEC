<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <x-popup-message-handler/>

                    <div class="flex justify-between items-center mb-4">

                        <div class="flex gap-1 items-center">
                            <x-eva-cube-outline class="size-6 text-indigo-400" />
                            <h2 class='text-xl border-b-2 border-indigo-400 font-bold'>Detalhes do Critério</h2>
                        </div>
                        <div class="flex gap-2">
                            <button class="border rounded px-2 py-1 border-red-500 text-red-500 flex gap-1 items-center" onclick="OpenModalDelete()">
                                <x-eva-trash-outline class="size-5 text-red-500" />
                                Excluir
                            </button>
                            <button onclick="OpenModal('edit')" class="border rounded px-2 py-1 border-indigo-400 text-indigo-400 flex gap-1 items-center">
                                <x-eva-edit-outline class="size-5 text-indigo-400" />
                                Alterar
                                
                            </button>
                            <button class="border rounded px-2 py-1 border-indigo-400 text-indigo-400">
                                <a href="{{ route('dimensoes.show', $criterio->indicador->dimensao->id) }}" class="flex gap-1 items-center">
                                    <x-eva-undo-outline class="size-5 text-indigo-400" />
                                    voltar
                                </a>
                            </button>
                        </div>
                    </div>


                    <div class="mt-8">
                        <div class="flex gap-4 mb-4">
                            <div class="border rounded py-2 px-4 w-6/12">
                                <a href="{{ route('instrumentos.show', $criterio->indicador->dimensao->instrumento->id) }}">
                                    <p class="text-indigo-400 font-light flex items-center gap-1">
                                        <x-eva-clipboard-outline class="size-5 text-indigo-400"/>
                                        Instrumento
                                    </p>
                                    <p>{{$criterio->indicador->dimensao->instrumento->titulo}} ({{$criterio->indicador->dimensao->instrumento->ano}})</p>
                                </a>
                            </div>
                            <div class="border rounded py-2 px-4 w-6/12">
                                <a href="{{ route('dimensoes.show', $criterio->indicador->dimensao->id) }}">
                                    <p class="text-indigo-400 font-light flex items-center gap-1">
                                        <x-eva-cube-outline class="size-5 text-indigo-400" />
                                        Dimensão
                                    </p>
                                    <p>{{$criterio->indicador->dimensao->sequencia}}. {{$criterio->indicador->dimensao->descricao}}</p>
                                </a>
                            </div>
                        </div>
                        <div class="flex gap-4 mb-4">
                            <div class="border rounded py-2 px-4 w-full">
                                <a href="{{ route('indicadores.show', $criterio->indicador->id) }}">
                                    <p class="text-indigo-400 font-light flex items-center gap-1">
                                        <x-eva-checkmark-circle-outline class="size-5 text-indigo-400"/>
                                        Indicador
                                    </p>
                                    <p>{{$criterio->indicador->sequencia}}. {{$criterio->indicador->descricao}}</p>
                                </a>
                            </div>
                        </div>
                        <div class="flex gap-4 mb-4">
                            <div class="border rounded py-2 px-4 w-full">
                                <p class="text-indigo-400 font-light flex items-center gap-1">
                                    <x-eva-alert-triangle-outline class="size-5 text-indigo-400"/>
                                    Critério
                                </p>
                                <p>{{$criterio->sequencia}}. {{$criterio->descricao}}</p>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-popup-new-instrumento :title="'Alterar Critério'" :id="'edit'">
        <form method="POST" class="mt-4" enctype="multipart/form-data" action="{{ route('criterios.update', $criterio->id) }}">
        @method('PUT')
        @csrf
            <div class='flex justify-between gap-4'>
                <div class='labeledInput w-full'>
                    <label for='descricao'>Descrição</label>
                    <textarea name='descricao' id='descricao' class='rounded' rows="20" cols="100">{{ $criterio->descricao }}</textarea>
                </div>
            </div>
            <div class='flex items-center gap-4'>
                <button type="submit" class='linkButton w-full hover:text-green-700 hover:border-green-700 justify-center text-center'>Salvar</button>
            </div>
        </form>
    </x-popup-new-instrumento>

    <x-confirm-remove :id="$criterio->id" :nome="$criterio->descricao" :route="'criterios.destroy'"/>
</x-app-layout>