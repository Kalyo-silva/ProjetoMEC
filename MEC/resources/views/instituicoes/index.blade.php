<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-popup-message-handler/>
                    
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex gap-1 items-center">
                            <x-lucide-university class="size-6 text-gray-400"/>
                            <h2 class='text-xl border-b-2 border-indigo-400 font-bold'>Lista da Instituições</h2>
                        </div>
                        <a href="{{route('instituicoes.create')}}" class="linkButton">
                            <x-fas-plus class="size-6"/>
                            <p>Novo</p>
                        </a>
                    </div>

                    @if($listaInstituicoes->isEmpty())
                        <p>Nenhuma Instituição Encontrado.</p>
                    @else
                        <div id="container_inst" class="grid grid-cols-2 gap-4">
                            @foreach ($listaInstituicoes as $inst)
                                <div id="inst_{{$inst->id}}" class="border transition-all rounded p-4 flex items-center gap-4 mb-2 justify-between">
                                    <div class="flex flex-col w-full">
                                        <div class="flex justify-between w-full">
                                            <div class="flex items-center gap-4">
                                                <div>
                                                    <img class="size-16 transition-all object-cover border rounded" src="{{asset('img_instituicoes/'.$inst->logo)}}" alt="logo">
                                                </div>
                                                <div>
                                                    <div>
                                                        <p class="text-indigo-400 font-bold label hidden">Nome</p>
                                                        <h2 class="font-bold">{{$inst->nome}}</h2>
                                                        <p class="text-indigo-400 font-bold label hidden">Sigla</p>
                                                        <p class="italic text-gray-500">{{$inst->sigla}}</p>
                                                    </div>
                                                    <div class="hidden info">
                                                        <p class="text-indigo-400 font-bold">Endereço</p>
                                                        <p>{{$inst->logradouro}} - {{$inst->bairro}}, {{$inst->cidade}} - {{$inst->uf}} - {{substr_replace($inst->cep, '-', 5, 0)}}</p>
                                                    </div>
                                                    <div class="justify-between hidden info">
                                                        <div>
                                                        <p class="text-indigo-400 font-bold">Mantenedor</p>

                                                        <a href="{{route('mantenedores.index')}}" class="flex items-center gap-1 border rounded w-fit px-4 py-2 cursor-pointer">
                                                            <x-uni-university-o class="size-4 text-indigo-400"/>
                                                            <p class="">{{$inst->mantenedor->nome}}</p>
                                                        </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex gap-2 items-start  ">
                                                <div class="hidden options">
                                                    <a href="{{ route('instituicoes.show', $inst->id) }}">
                                                        <x-eva-search-outline
                                                            class="size-6 text-gray-300 hover:text-gray-700 hover:cursor-pointer" />
                                                    </a>
                                                </div>

                                                <x-eva-expand onclick="detail({{$inst->id}})" class="size-6 text-gray-300 hover:text-gray-700 hover:cursor-pointer"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-4">
                        {{$listaInstituicoes->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function detail(id){
        const container = document.getElementById('inst_'+id);
        const img = container.querySelectorAll("img");
        const labels = container.querySelectorAll('p.label');
        const info = container.querySelectorAll('div.info');
        const options = container.querySelectorAll('div.options');

        if (container.className.includes(' col-span-2 ')){
            container.className = container.className.replace(' col-span-2 ', '')
            img[0].className = img[0].className.replace('size-64', 'size-16')

            for (let i = 0; i < labels.length; i++) {
                labels[i].className += "hidden"
            }

            for (let i = 0; i < info.length; i++) {
                info[i].className = info[i].className.replace("flex flex-col", "hidden")
            }

            for (let i = 0; i < options.length; i++) {
                options[i].className = options[i].className.replace("flex gap-2","hidden")
            }
        }
        else{
            container.className += ' col-span-2 '
            img[0].className = img[0].className.replace('size-16', 'size-64')

            for (let i = 0; i < labels.length; i++) {
                labels[i].className = labels[i].className.replace("hidden", "")
            }

            for (let i = 0; i < info.length; i++) {
                info[i].className = info[i].className.replace("hidden", "flex flex-col")
            }

            for (let i = 0; i < options.length; i++) {
                options[i].className = options[i].className.replace("hidden", "flex gap-2")
            }
        }

    }
</script>
