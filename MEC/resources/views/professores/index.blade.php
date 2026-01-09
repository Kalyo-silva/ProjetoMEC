<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <x-popup-message-handler/>

                    <div class="flex justify-between items-center mb-4">

                        <div class="flex gap-1 items-center">
                            <x-eva-person-outline class="size-6 text-gray-400" />
                            <h2 class='text-xl border-b-2 border-indigo-400 font-bold'>Lista de Professores</h2>
                        </div>
                        <a href="{{route('professores.create')}}" class="linkButton">
                            <x-fas-plus class="size-6"/>
                            <p>Novo</p>
                        </a>
                    </div>

                    @if($listaProfessores->isEmpty())
                        <p>Nenhuma profituição Encontrado.</p>
                    @else
                        <div id="container_prof" class="grid grid-cols-2 gap-4">
                            @foreach ($listaProfessores as $prof)
                                <div id="prof_{{$prof->id}}" class="border transition-all rounded p-4 flex items-center gap-4 mb-2 justify-between">
                                    <div class="flex flex-col w-full">
                                        <div class="flex justify-between w-full">
                                            <div class="flex items-center gap-4">
                                                <div>
                                                    <div>
                                                        <p class="text-indigo-400 font-bold label hidden">Nome</p>
                                                        <h2 class="font-bold">{{$prof->nome}}</h2>
                                                        <p class="text-indigo-400 font-bold label hidden">Data de Admissão</p>
                                                        <p class="italic text-gray-500">{{$prof->data_admissao}}</p>
                                                    </div>
                                                    <div class="hidden info">
                                                        <p class="text-indigo-400 font-bold label">Titulação</p>
                                                        <p>{{$prof->titulacao}}</p>
                                                    </div>
                                                    <div class="hidden info">
                                                        <p class="text-indigo-400 font-bold label">Regime</p>
                                                        <p>{{$prof->regime}}</p>
                                                    </div>
                                                    <div class="hidden info">
                                                        <p class="text-indigo-400 font-bold label">Vínculo</p>
                                                        <p>{{$prof->vinculo}}</p>
                                                    </div>
                                                    <div class="hidden info">
                                                        <p class="text-indigo-400 font-bold label">Currículo Lattes</p>
                                                        <a href='{{$prof->lattes}}'>{{$prof->lattes}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex gap-2 items-start  ">
                                                <div class="hidden options">
                                                    <a href="{{ route('professores.edit', $prof->id) }}">
                                                        <x-eva-edit-outline class="size-6 text-gray-300 hover:text-gray-700 hover:cursor-pointer" />
                                                    </a>
                                                </div>

                                                <x-eva-expand onclick="detail({{$prof->id}})" class="size-6 text-gray-300 hover:text-gray-700 hover:cursor-pointer"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-4">
                        {{$listaProfessores->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function detail(id){
        const container = document.getElementById('prof_'+id);
        const labels = container.querySelectorAll('p.label');
        const info = container.querySelectorAll('div.info');
        const options = container.querySelectorAll('div.options');

        if (container.className.includes(' row-span-3 ')){
            container.className = container.className.replace(' row-span-3 ', '')

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
            container.className += ' row-span-3 '

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
