<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-4">
                        <h2 class='text-xl border-b-2 border-indigo-400 font-bold'>Lista de Instituições</h2>
                        <div class="linkButton">
                            <x-fas-plus class="size-6"/>
                            <a href="{{route('instituicoes.create')}}">Novo</a>
                        </div>
                    </div>

                    @if($listaInstituicoes->isEmpty())
                        <p>Nenhuma Instituição Encontrado.</p>
                    @else
                        @foreach ($listaInstituicoes as $inst)
                            <div class="border rounded p-4 flex items-center gap-4 mb-2">
                                <div>
                                    <img class="size-16 object-contain" src="{{asset('img_instituicoes/'.$inst->logo)}}" alt="logo">
                                </div>
                                <div>
                                    <h2 class="font-bold">{{$inst->nome}}</h2>
                                    <p class="italic text-gray-500">{{$inst->sigla}}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <div class="mt-4">
                        {{$listaInstituicoes->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
