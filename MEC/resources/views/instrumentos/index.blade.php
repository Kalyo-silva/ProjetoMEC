<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <x-popup-message-handler/>

                    <div class="flex justify-between items-center mb-4">

                        <div class="flex gap-1 items-center">
                            <x-eva-clipboard-outline class="size-6 text-gray-400" />
                            <h2 class='text-xl border-b-2 border-indigo-400 font-bold'>Lista de Instrumentos</h2>
                        </div>
                        <a onclick="OpenModal('create')" class="linkButton">
                            <x-fas-plus class="size-6"/>
                            <p>Novo</p>
                        </a>
                    </div>
                    
                    <div>
                        @foreach ($listaInstrumentos as $instrumento)
                            <x-dropdown-section :id="$instrumento->id" :title="$instrumento->titulo" :mode="'instrumentos'">
                                <div class="flex gap-4">
                                    <div class='flex border rounded px-4 py-2 w-1/2 justify-between'>
                                        <div class="flex gap-4">
                                            <div class="py-2">
                                                <p class="text-indigo-400 font-bold label">Titulo da Avaliação</p>
                                                <p class="text-lg">{{$instrumento->titulo}}</p>
                                            </div>
                                        </div>
                                        <div class="items-center flex">
                                            <div class="px-4 py-2 mr-4">
                                                <p class="text-indigo-400 font-bold label">Ano</p>
                                                <p class="text-lg">{{$instrumento->ano}}</p>
                                            </div>
                                            <x-eva-edit-outline onclick="OpenModal('edit'), EditInstrumento({{$instrumento->id}}, '{{$instrumento->titulo}}', {{$instrumento->ano}})" class="size-6 text-gray-300 hover:text-gray-700 hover:cursor-pointer" />
                                        </div>
                                    </div>
                                    <div class="flex border rounded px-4 py-2 w-1/2">
                                    </div>
                                </div>
                                <div class="mt-4 rounded border px-4 py-2">
                                    <div class="flex justify-between">
                                        <p class="text-indigo-400 font-bold label">Dimensões da Avaliação</p>

                                        <a onclick="OpenModal('createDimensao'), CreateDimensao({{ $instrumento->id }})" class="flex items-center gap-1 text-indigo-400">
                                            <x-fas-plus class="size-4"/>
                                        </a>
                                    </div>
                                    <div>
                                        @foreach ($instrumento->dimensoes as $dimensao)
                                            <x-dropdown-section :id="'dime'.$dimensao->id" :title="$dimensao->descricao" :mode="'dimensoes'">
                                            </x-dropdown-section>
                                        @endforeach
                                    </div>
                                </div>
                            </x-dropdown-section>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        {{$listaInstrumentos->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-popup-new-instrumento :title="'Novo Instrumento'" :id="'create'">
        <form method="POST" class="mt-4" enctype="multipart/form-data" action="{{ route('instrumentos.store') }}">
        @csrf
            <div class='flex justify-between gap-4'>
                <div class='labeledInput w-10/12'>
                    <label for='titulo'>Titulo</label>
                    <input name='titulo' id='titulo' type='text'>
                </div>
                <div class='labeledInput w-2/12'>
                    <label for='ano'>Ano</label>
                    <input name='ano' id='ano' type='number' maxlength="4">
                </div>
            </div>
            <div class='flex items-center gap-4 flex-row-reverse'>
                <button type="submit" class='linkButton hover:text-green-700 hover:border-green-700 w-2/12 justify-center text-center'>Salvar</button>
            </div>
        </form>
    </x-popup-new-instrumento>

    <x-popup-new-instrumento :title="'Editar Instrumento'" :id="'edit'">
        <form id='formUpdate' method="POST" class="mt-4" enctype="multipart/form-data">
        @method('PUT')
        @csrf
            <div class='flex justify-between gap-4'>
                <div class='labeledInput w-10/12'>
                    <label for='titulo_update'>Titulo</label>
                    <input name='titulo_update' id='titulo_update' type='text'>
                </div>
                <div class='labeledInput w-2/12'>
                    <label for='ano_update'>Ano</label>
                    <input name='ano_update' id='ano_update' type='number' maxlength="4">
                </div>
            </div>
            <div class='flex items-center gap-4 flex-row-reverse'>
                <button type="submit" class='linkButton hover:text-green-700 hover:border-green-700 w-2/12 justify-center text-center'>Salvar</button>
            </div>
        </form>
    </x-popup-new-instrumento>

    <x-popup-new-instrumento :title="'Nova Dimensão'" :id="'createDimensao'">
        <form method="POST" class="mt-4" enctype="multipart/form-data" action="{{ route('dimensoes.store') }}">
        @csrf
            <div class='flex justify-between gap-4'>
                <input type="hidden" name="id_instrumento" id='id_instrumento'>
                <div class='labeledInput w-10/12'>
                    <label for='descricao'>Descrição da Dimensão</label>
                    <input name='descricao' id='descricao' type='text'>
                </div>
                <div class='labeledInput w-2/12'>
                    <label for='sequencia'>Sequência</label>
                    <input name='sequencia' id='sequencia' type='number' maxlength="4">
                </div>
            </div>
            <div class='flex items-center gap-4 flex-row-reverse'>
                <button type="submit" class='linkButton hover:text-green-700 hover:border-green-700 w-2/12 justify-center text-center'>Salvar</button>
            </div>
        </form>
    </x-popup-new-instrumento>
</x-app-layout>

<script>
    function EditInstrumento(id, titulo, ano){
        document.getElementById('formUpdate').action = '/instrumentos/'+id
        document.getElementById('titulo_update').value = titulo
        document.getElementById('ano_update').value = ano
    }

    function CreateDimensao(id){
        document.getElementById('id_instrumento').value = id
    }
</script>