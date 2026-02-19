<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <x-popup-message-handler/>

                    <div class="flex justify-between items-center">

                        <div class="flex gap-1 items-center">
                            <x-eva-award-outline class="size-6 text-gray-400" />
                            <h2 class='text-xl border-b-2 border-indigo-400 font-bold'>Lista de Avaliações</h2>
                        </div>
                        <div class="flex gap-4 mb-4">
                            <form method='GET' action="{{ route('avaliacoes.index') }}" class="pl-2 flex gap-2 items-center border rounded border-gray-500 overflow-hidden">
                                <x-eva-search-outline class="size-6 text-indigo-400 hover:text-gray-700 hover:cursor-pointer" onclick="this.parentElement.submit()"/>
                                <input type="text" id='search' name='search' class="border-0" placeholder="Titulo da Avaliação..." value="{{$search}}">
                            </form>

                            <a href="{{ route('avaliacoes.create') }}" class="linkButton">
                                <x-fas-plus class="size-6" />
                                <p>Novo</p>
                            </a>
                        </div>
                    </div>

                    @if($listaAvaliacoes->isEmpty())
                        <p>Nenhuma Avaliação Encontrada.</p>
                    @else
                        <div id="container_avaliacao" class="grid grid-cols-2 gap-4">
                            @foreach ($listaAvaliacoes as $avaliacao)
                                <div id="avaliacao_{{$avaliacao->id}}" class="border transition-all rounded p-4 flex items-center gap-4 mb-2 justify-between">
                                    <div class="flex flex-col w-full">
                                        <div class="flex justify-between w-full">
                                            <div class="flex items-center gap-4 w-full">
                                                <div class="w-full">
                                                    <div>
                                                        <p class="text-indigo-400 font-bold label hidden">Avaliação</p>
                                                        <h2 class="font-bold">{{$avaliacao->descricao}} ({{ $avaliacao->ano }})</h2>
                                                        <p class="text-indigo-400 font-bold label hidden">Curso</p>
                                                        <p class="italic text-gray-500">{{$avaliacao->curso->nome}}</p>
                                                    </div>
                                                    
                                                    <div class="hidden info gap-2 w-full mb-2 mt-2">
                                                            
                                                        <div class="hidden info border rounded px-4 py-2 items-center gap-2 w-1/2">
                                                            <x-eva-calendar-outline class="size-6 text-indigo-400" />
                                                            <div class="flex flex-col">
                                                                <p class="text-indigo-400 font-bold label">Início da Aplicação</p>
                                                                <p>{{$avaliacao->data_inicio}}</p>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="hidden info border rounded px-4 py-2 items-center gap-2 w-1/2">
                                                            <x-eva-calendar-outline class="size-6 text-indigo-400" />
                                                                <div class="flex flex-col">
                                                                <p class="text-indigo-400 font-bold label">Fim da Aplicação</p>
                                                                <p>{{$avaliacao->data_fim}}</p>
                                                            </div>
                                                        </div>
                                                    
                                                    </div>

                                                    <div onclick="window.location.href = '{{ route('instrumentos.show', $avaliacao->instrumento->id) }}'" class="hidden info mb-2 mt-2 border rounded cursor-pointer px-4 py-2 items-center gap-2">
                                                        <x-eva-clipboard-outline class="size-6 text-indigo-400" />
                                                        <div class="flex flex-col">
                                                            <p class="text-indigo-400 font-bold label">Instrumento Utilizado</p>
                                                            <p>{{$avaliacao->instrumento->titulo}} ({{ $avaliacao->instrumento->ano }})</p>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="hidden info border rounded px-4 py-2 items-center gap-2 mb-2 mt-2">
                                                        <x-eva-person-outline class="size-6 text-indigo-400" />
                                                        <div class="flex flex-col">
                                                            <p class="text-indigo-400 font-bold label">Usuário responsável</p>
                                                            <p>{{$avaliacao->usuario->name}}</p>
                                                        </div>
                                                    </div>

                                                    <div class="hidden info gap-2 w-full mb-2 mt-4 flex-row-reverse">
                                                        <div class="linkButton hover:text-green-500 hover:border-green-500">
                                                            <a href="{{ route('avaliacoes.show', $avaliacao->id) }}" class="flex">
                                                                <x-eva-play-circle-outline class="size-6" />
                                                                <p>Executar Avaliação</p>
                                                            </a>
                                                        </div>
                                                        <div class="linkButton hover:text-indigo-400 hover:border-indigo-400">
                                                            <a href="{{ route('avaliacoes.edit', $avaliacao->id) }}" class="flex">
                                                                <x-eva-edit-outline class="size-6" />
                                                                <p>Editar</p>
                                                            </a>
                                                        </div>
                                                        <div class="linkButton hover:text-red-500 hover:border-red-500">
                                                            <a href="{{ route('avaliacoes.show', $avaliacao->id) }}" class="flex">
                                                                <x-eva-trash-outline class="size-6" />
                                                                <p>Excluir</p>
                                                            </a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="flex gap-2 items-start  ">
                                                <x-eva-expand onclick="detail({{$avaliacao->id}})" class="size-6 text-gray-300 hover:text-gray-700 hover:cursor-pointer"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-4">
                        {{$listaAvaliacoes->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
    function detail(id){
        const container = document.getElementById('avaliacao_'+id);
        const labels = container.querySelectorAll('p.label');
        const info = container.querySelectorAll('div.info');
        const options = container.querySelectorAll('div.options');

        if (container.className.includes(' row-span-3 ')){
            container.className = container.className.replace(' row-span-3 ', '')

            for (let i = 0; i < labels.length; i++) {
                labels[i].className += "hidden"
            }

            for (let i = 0; i < info.length; i++) {
                info[i].className = info[i].className.replace("flex flex-row", "hidden")
            }

            for (let i = 0; i < options.length; i++) {
                options[i].className = options[i].className.replace("flex gap-2","hidden")
            }
        }
        else{
            container.className += ' row-span-3 '

            for (let i = 0; i < labels.length; i++) {
                labels[i].className = labels[i].className.replace("hidden", "")
            }

            for (let i = 0; i < info.length; i++) {
                info[i].className = info[i].className.replace("hidden", "flex flex-row")
            }

            for (let i = 0; i < options.length; i++) {
                options[i].className = options[i].className.replace("hidden", "flex gap-2")
            }
        }

    }
</script>
