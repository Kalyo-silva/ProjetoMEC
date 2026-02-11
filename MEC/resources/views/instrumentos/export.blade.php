<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <x-popup-message-handler/>

                    <div class="flex justify-between items-center mb-4">

                        <div class="flex gap-1 items-center">
                            <x-eva-clipboard-outline class="size-6 text-indigo-400" />
                            <h2 class='text-xl border-b-2 border-indigo-400 font-bold'>Relatório do Instrumento</h2>
                        </div>
                        <div class="flex gap-2">
                            <button class="border rounded px-2 py-1 border-indigo-400 text-indigo-400">
                                <a href="{{ route('instrumentos.index') }}" class="flex gap-1 items-center">
                                    <x-eva-undo-outline class="size-5 text-indigo-400" />
                                    Voltar
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
                            @foreach ($instrumento->dimensoes as $dimensao)
                                <div>
                                    <div class="bg-indigo-400 border-b px-4 py-2 flex items-center gap-1">
                                        <x-eva-cube-outline class="size-5 text-white"/>
                                        <p class="text-white">{{ $dimensao->sequencia }}. {{$dimensao->descricao}}</p>
                                    </div>
                                    <div>
                                        @foreach ($dimensao->indicadores as $indicador)
                                            <div>
                                                <div class="border-b px-8 py-2 flex items-center gap-1">
                                                    <x-eva-checkmark-circle-outline class="size-5 text-indigo-400"/>
                                                    <p class="text-indigo-400">{{ $indicador->sequencia }}. {{$indicador->descricao}}</p>
                                                </div>
                                                @foreach ($indicador->criterios as $criterio)
                                                    <p class="px-16 py-2 text-gray-500 border-b text-justify">{{$criterio->sequencia}}. {{$criterio->descricao}}</p>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>                                    
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>