<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <x-popup-message-handler/>

                    <div class="flex justify-between items-center mb-4">

                        <div class="flex gap-1 items-center">
                            <x-eva-cube-outline class="size-6 text-indigo-400" />
                            <h2 class='text-xl border-b-2 border-indigo-400 font-bold'>Detalhes da Dimensão</h2>
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
                                <a href="{{ route('instrumentos.show', $dimensao->instrumento->id) }}" class="flex gap-1 items-center">
                                    <x-eva-undo-outline class="size-5 text-indigo-400" />
                                    voltar
                                </a>
                            </button>
                        </div>
                    </div>


                    <div class="mt-8">
                        <div class="flex gap-4 mb-4">
                            <div class="border rounded py-2 px-4 w-6/12">
                                <a href="{{ route('instrumentos.show', $dimensao->instrumento->id) }}">
                                    <p class="text-indigo-400 font-light flex items-center gap-1">
                                        <x-eva-clipboard-outline class="size-5 text-indigo-400"/>
                                        Instrumento
                                    </p>
                                    <p>{{$dimensao->instrumento->titulo}} ({{$dimensao->instrumento->ano}})</p>
                                </a>
                            </div>
                            <div class="border rounded py-2 px-4 w-6/12">
                                <p class="text-indigo-400 font-light flex items-center gap-1">
                                    <x-eva-cube-outline class="size-5 text-indigo-400" />
                                    Dimensão
                                </p>
                                <p>{{$dimensao->sequencia}}. {{$dimensao->descricao}}</p>
                            </div>
                        </div>

                        <div class="border rounded overflow-hidden">
                            <div class="flex items-center px-4 py-2 gap-1 border-b">
                                <x-eva-checkmark-circle-outline class="size-5 text-indigo-400"/>
                                <p>Indicadores</p>
                            </div>
                            <div class="max-h-96 overflow-y-scroll">
                                <table class="w-full">
                                    <tbody>
                                        @if (count($dimensao->indicadores) == 0)
                                            <tr class="border-b">
                                                <td class="px-4 py-2 text-center text-gray-500">Nenhum indicador cadastrado... 😕</td>
                                            </tr>
                                        @else
                                            @foreach ($dimensao->indicadores as $indicador)
                                                <tr class="item-dimensao border-b hover:border-b-2 hover:border-indigo-400 hover:cursor-pointer">
                                                    
                                                    <td class="px-4 py-2 border-r w-1/12 text-center text-indigo-400 font-bold">{{$indicador->sequencia}}</td>
                                                    <td class="px-4 w-11/12">
                                                        <a class="w-full" href={{ route('indicadores.show', $indicador->id) }}>
                                                            <p class="w-full">{{$indicador->descricao}}</p>
                                                        </a>
                                                    </td> 
                                                    <td class="px-4">
                                                        <div class="flex">
                                                            <form method="POST" action="{{ route('indicadores.up', $indicador->id)}}">
                                                                @method('POST')
                                                                @csrf
                                                                <x-eva-arrow-up-outline onclick="this.parentElement.submit()" class="dimensao-arrows hover:text-gray-600 size-6 text-gray-300"/>
                                                            </form>

                                                            <form method="POST" action="{{ route('indicadores.down', $indicador->id)}}">
                                                                @method('POST')
                                                                @csrf
                                                                <x-eva-arrow-down-outline onclick="this.parentElement.submit()" class="dimensao-arrows hover:text-gray-600 size-6 text-gray-300"/>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div onclick="OpenModal('create')" class="flex items-center px-4 py-2 gap-1 justify-center text-indigo-400 hover:cursor-pointer hover:bg-indigo-400 hover:text-white hover:fill-white ">
                                <x-eva-plus-outline class="size-5"/>
                                <p>Novo Indicador</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <x-popup-new-instrumento :title="'Alterar Dimensao'" :id="'edit'">
        <form method="POST" class="mt-4" enctype="multipart/form-data" action="{{ route('dimensoes.update', $dimensao->id) }}">
        @method('PUT')
        @csrf
            <div class='flex justify-between gap-4'>
                <div class='labeledInput w-full'>
                    <label for='descricao'>Descrição</label>
                    <input class="w-full" name='descricao' id='descricao' type='text' value="{{ $dimensao->descricao }}">
                </div>
            </div>
            <div class='flex items-center gap-4'>
                <button type="submit" class='linkButton w-full hover:text-green-700 hover:border-green-700 justify-center text-center'>Salvar</button>
            </div>
        </form>
    </x-popup-new-instrumento>


    <x-popup-new-instrumento :title="'Novo indicador'" :id="'create'">
        <form method="POST" class="mt-4" enctype="multipart/form-data" action="{{ route('indicadores.store') }}">
        @csrf
            <div class='flex justify-between gap-4'>
                <input type="hidden" value="{{$dimensao->id}}" id="id_dimensao" name="id_dimensao">
                <div class='labeledInput w-full'>
                    <label for='descricao_indicador'>Descrição</label>
                    <input name='descricao_indicador' id='descricao_indicador' type='text'>
                </div>
            </div>
            <div class='flex items-center gap-4'>
                <button type="submit" class='linkButton w-full hover:text-green-700 hover:border-green-700 justify-center text-center'>Salvar</button>
            </div>
        </form>
    </x-popup-new-instrumento>

    <x-confirm-remove :id="$dimensao->id" :nome="$dimensao->descricao" :route="'dimensoes.destroy'"/>
</x-app-layout>