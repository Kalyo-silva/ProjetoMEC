<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <x-popup-message-handler/>

                    <div class="flex justify-between items-center">

                        <div class="flex gap-1 items-center">
                            <x-uni-university-o class="size-6 text-gray-400" />
                            <h2 class='text-xl border-b-2 border-indigo-400 font-bold'>Lista de Mantenedores</h2>
                        </div>
                        <div class="flex gap-4">
                            <form method='GET' action="{{ route('mantenedores.index') }}" class="pl-2 flex gap-2 items-center border rounded border-gray-500 overflow-hidden">
                                <x-eva-search-outline class="size-6 text-indigo-400 hover:text-gray-700 hover:cursor-pointer" onclick="this.parentElement.submit()"/>
                                <input type="text" id='search' name='search' class="border-0" placeholder="Nome do Mantenedor..." value="{{$search}}">
                            </form>

                            <a href="{{ route('mantenedores.create') }}" class="linkButton">
                                <x-fas-plus class="size-6" />
                                <p>Novo</p>
                            </a>
                        </div>
                    </div>

                    @if ($listaMantenedores->isEmpty())
                        <p>Nenhum Mantenedor Encontrado.</p>
                    @else
                        @foreach ($listaMantenedores as $mantenedor)
                            <x-dropdown-section :id="$mantenedor->id" :title="$mantenedor->nome" :mode="'mantenedores'"> 
                                <div class="flex gap-4">
                                    <div class="shadow-lg border rounded p-4 w-1/2 h-full">
                                        <h2 class="font-bold border-b-2 w-fit border-indigo-400 mb-2">Endereço</h2>

                                        <div class="flex justify-between items-center mb-2">
                                            <div class='labeledInput w-10/12 mr-4'>
                                                <label for='cidade'>Cidade</label>
                                                <input name='cidade' id='cidade' type='text'
                                                    value="{{ $mantenedor->cidade }}" readonly>
                                            </div>

                                            <div class='labeledInput w-2/12'>
                                                <label for='uf'>UF</label>
                                                <input name='uf' id='uf' type='text'
                                                    value="{{ $mantenedor->uf }}" readonly>
                                            </div>
                                        </div>

                                        <div class="flex justify-between items-center mb-2">
                                            <div class='labeledInput w-1/2 mr-4'>
                                                <label for='bairro'>Bairro</label>
                                                <input name='bairro' id='bairro' type='text'
                                                    value="{{ $mantenedor->bairro }}" readonly>
                                            </div>

                                            <div class='labeledInput w-1/2'>
                                                <label for='cep'>CEP</label>
                                                <input name='cep' id='cep' type='text'
                                                    value="{{ $mantenedor->cep }}" readonly>
                                            </div>
                                        </div>
                                        <div class='labeledInput'>
                                            <label for='logradouro'>Logradouro</label>
                                            <input name='logradouro' id='logradouro' type='text'
                                                value="{{ $mantenedor->logradouro }}" readonly>
                                        </div>

                                    </div>
                                    <div class="shadow-lg border rounded p-4 w-1/2">
                                        <h2 class="font-bold border-b-2 w-fit border-indigo-400 mb-2">Instituições
                                            Vinculadas</h2>

                                        @if (count($mantenedor->instituicao) != 0)
                                            <div class="max-h-64 overflow-y-scroll">
                                                @foreach ($mantenedor->instituicao as $inst)
                                                    <div
                                                        class="flex gap-4 items-center mb-2 py-2 px-4 border rounded justify-between">
                                                        <div class="flex gap-4 items-center">
                                                            <div>
                                                                <img class='size-12 rounded object-cover border shadow-lg'
                                                                    src="{{ asset('img_instituicoes/' . $inst->logo) }}"
                                                                    alt="logo">
                                                            </div>
                                                            <div>
                                                                <h2 class="font-bold">{{ $inst->nome }}</h2>
                                                                <p class="text-sm">{{ $inst->sigla }}</p>
                                                            </div>
                                                        </div>
                                                        <a href="{{ route('instituicoes.show', $inst->id) }}">
                                                            <x-eva-search-outline
                                                                class="size-6 text-gray-300 hover:text-gray-700 hover:cursor-pointer" />
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="flex justify-center items-center h-5/6">
                                                <p class="text-gray-500">Nenhuma Instituição vinculada... 😕</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex mt-4 flex-row-reverse gap-4">
                                    <div class="linkButton hover:text-indigo-400 hover:border-indigo-400">
                                        <a href="{{ route('mantenedores.edit', $mantenedor->id) }}" class="flex">
                                            <x-eva-edit-outline class="size-6" />
                                            <p>Editar</p>
                                        </a>
                                    </div>
                                    <div class="linkButton hover:text-red-500 hover:border-red-500">
                                        <a href="{{ route('mantenedores.show', $mantenedor->id) }}" class="flex">
                                            <x-eva-trash-outline class="size-6" />
                                            <p>Excluir</p>
                                        </a>
                                    </div>
                                </div>
                            </x-dropdown-section>
                        @endforeach
                    @endif

                    <div class="mt-4">
                        {{ $listaMantenedores->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function OpenMenuDetalhes(button, id) {
        var menu = document.getElementById(id);

        if (menu.style.display != 'none' && menu.style.display != '') {
            menu.style.display = 'none';
            button.style = 'transform : rotate(0deg);';
        } else {
            menu.style.display = 'block';
            button.style = 'transform : rotate(180deg);';
        }
    }
</script>
