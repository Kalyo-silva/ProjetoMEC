<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <x-popup-message-handler/>

                    <div class="flex justify-between items-center mb-4">

                        <div class="flex gap-1 items-center">
                            <x-eva-clipboard-outline class="size-6 text-indigo-400" />
                            <h2 class='text-xl border-b-2 border-indigo-400 font-bold'>Detalhes do Instrumento</h2>
                        </div>
                        <div class="flex gap-2">
                            <button class="border rounded px-2 py-1 border-red-500 text-red-500 flex gap-1 items-center" onclick="OpenModalDelete()">
                                <x-eva-trash-outline class="size-5 text-red-500"/>
                                Excluir
                            </button>
                            <button onclick="OpenModal('edit')" class="border rounded px-2 py-1 border-indigo-400 text-indigo-400 flex gap-1 items-center">
                                <x-eva-edit-outline class="size-5 text-indigo-400" />
                                Alterar
                                
                            </button>
                            <button class="border rounded px-2 py-1 border-indigo-400 text-indigo-400">
                                <a href="{{ route('instrumentos.index') }}" class="flex gap-1 items-center">
                                    <x-eva-undo-outline class="size-5 text-indigo-400" />
                                    voltar
                                </a>
                            </button>
                        </div>
                    </div>

                    <div class="mt-8">
                        <div class="flex gap-4 mb-4">
                            <div class="border rounded py-2 px-4 w-10/12">
                                <p class="text-indigo-400 font-light">Titulo do instrumento</p>
                                <p>{{$instrumento->titulo}}</p>
                            </div>
                            <div class="border rounded py-2 px-4 w-2/12">
                                <p class="text-indigo-400 font-light">Ano do instrumento</p>
                                <p>{{$instrumento->ano}}</p>
                            </div>
                        </div>
                        <div class="border rounded overflow-hidden">
                            <div class="flex items-center px-4 py-2 gap-1 border-b">
                                <x-eva-cube-outline class="size-5 text-indigo-400"/>
                                <p>Dimensões</p>
                            </div>
                            <div class="max-h-96 overflow-y-scroll">
                                <table class="w-full">
                                    <tbody>
                                        @if (count($instrumento->dimensoes) == 0)
                                            <tr class="border-b">
                                                <td class="px-4 py-2 text-center text-gray-500">Nenhuma dimensão cadastrada... 😕</td>
                                            </tr>
                                        @else
                                            @foreach ($instrumento->dimensoes as $dimensao)
                                                <tr class="item-dimensao border-b hover:border-b-2 hover:border-indigo-400 hover:cursor-pointer">
                                                    
                                                    <td class="px-4 py-2 border-r w-1/12 text-center text-indigo-400 font-bold">{{$dimensao->sequencia}}</td>
                                                    <td class="px-4 w-11/12">
                                                        <a class="w-full" href={{ route('dimensoes.show', $dimensao->id) }}>
                                                            <p class="w-full">{{$dimensao->descricao}}</p>
                                                        </a>
                                                    </td> 
                                                    <td class="px-4">
                                                        <div class="flex">
                                                            <form method="POST" action="{{ route('dimensoes.up', $dimensao->id)}}">
                                                                @method('POST')
                                                                @csrf
                                                                <x-eva-arrow-up-outline onclick="this.parentElement.submit()" class="dimensao-arrows hover:text-gray-600 size-6 text-gray-300"/>
                                                            </form>

                                                            <form method="POST" action="{{ route('dimensoes.down', $dimensao->id)}}">
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
                                <p>Nova Dimensão</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <x-popup-new-instrumento :title="'Alterar Instrumento'" :id="'edit'">
        <form method="POST" class="mt-4" enctype="multipart/form-data" action="{{ route('instrumentos.update', $instrumento->id) }}">
        @method('PUT')
        @csrf
            <div class='flex justify-between gap-4'>
                <div class='labeledInput w-10/12'>
                    <label for='titulo'>Titulo</label>
                    <input name='titulo' id='titulo' type='text' value="{{ $instrumento->titulo }}">
                </div>
                <div class='labeledInput w-2/12'>
                    <label for='ano'>Ano</label>
                    <input name='ano' id='ano' type='number' maxlength="4" value="{{ $instrumento->ano }}">
                </div>
            </div>
            <div class='flex items-center gap-4'>
                <button type="submit" class='linkButton w-full hover:text-green-700 hover:border-green-700 justify-center text-center'>Salvar</button>
            </div>
        </form>
    </x-popup-new-instrumento>


    <x-popup-new-instrumento :title="'Nova Dimensão'" :id="'create'">
        <form method="POST" class="mt-4" enctype="multipart/form-data" action="{{ route('dimensoes.store') }}">
        @csrf
            <div class='flex justify-between gap-4'>
                <input type="hidden" value="{{$instrumento->id}}" id="id_instrumento" name="id_instrumento">

                <div class='labeledInput w-full'>
                    <label for='descricao'>Descrição</label>
                    <input name='descricao' id='descricao' type='text'>
                </div>
            </div>
            <div class='flex items-center gap-4'>
                <button type="submit" class='linkButton w-full hover:text-green-700 hover:border-green-700 justify-center text-center'>Salvar</button>
            </div>
        </form>
    </x-popup-new-instrumento>

    <x-confirm-remove :id="$instrumento->id" :nome="$instrumento->titulo" :route="'instrumentos.destroy'"/>
</x-app-layout>