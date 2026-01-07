<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-8">
                        <div class="flex gap-1 items-center">
                            <x-lucide-university class="size-6 text-gray-400"/>
                            <h2 class='text-xl border-b-2 border-indigo-400 font-bold'>Detalhes da Instituição</h2>
                        </div>

                        <div class="flex flex-row-reverse gap-4">
                            <div class="linkButton hover:text-indigo-400 hover:border-indigo-400">
                                <a href="{{route('instituicoes.edit',$inst->id)}}" class="flex">
                                    <x-eva-edit-outline class="size-6"/>
                                    <p>Editar</p>
                                </a>
                            </div>
                            <div class="linkButton hover:text-red-500 hover:border-red-500">
                                <a onclick='OpenModal()' class="flex">
                                    <x-eva-trash-outline class="size-6"/>
                                    <p>Excluir</p>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="flex mb-4">
                        <img class="size-52 rounded border-2 border-indigo-400 object-cover shadow-lg" src="{{asset('img_instituicoes/'.$inst->logo)}}" alt="Logo">

                        <div class="w-full px-8">
                            <div class="flex gap-4 items-center justify-between mb-4">
                                <div>
                                    <p class="text-indigo-400 font-bold">Nome</p>
                                    <h2 class="text-xl">{{$inst->nome}}</h2>
                                </div>
                                <div>
                                    <p class="text-indigo-400 font-bold">Sigla</p>
                                    <p class="text-xl">{{$inst->sigla}}</p>
                                </div>
                            </div>
                            <div class="mb-4">
                                <p class="text-indigo-400 font-bold">Endereço</p>
                                <p class="text-xl">{{$inst->logradouro}} - {{$inst->bairro}}, {{$inst->cidade}} - {{$inst->uf}} - {{substr_replace($inst->cep, '-', 5, 0)}}</p>
                            </div>
                            <div>
                                <p class="text-indigo-400 font-bold">Mantenedor</p>

                                <a href="{{route('mantenedores.index')}}" class="flex items-center gap-1 border rounded w-fit px-4 py-2 cursor-pointer">
                                    <x-uni-university-o class="size-6 text-indigo-400"/>
                                    <p class="text-xl">{{$inst->mantenedor->nome}}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <x-confirm-remove :id="$inst->id" :nome="$inst->nome" $route="'instituicoes.destroy'"/>
</x-app-layout>