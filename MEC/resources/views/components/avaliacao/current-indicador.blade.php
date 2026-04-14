<div class="border rounded-lg mt-4 overflow-hidden border-indigo-400">
    <div class="flex items-center gap-1 px-4 py-2 bg-indigo-400">
        <x-eva-cube-outline class="size-5 text-white" />
        <p class=" text-white font-bold">
            {{$avaliacao->instrumento->dimensoes[$dimensao]->sequencia}}. 
            {{ $avaliacao->instrumento->dimensoes[$dimensao]->descricao}}
        </p>
    </div>
    <div class="px-10 py-2 flex items-center gap-1 border-b border-indigo-400">
        <x-eva-checkmark-circle-outline class="size-5 text-indigo-400" />
        <p class=" text-gray-700 font-bold">
            {{ $avaliacao->instrumento->dimensoes[$dimensao]->indicadores[$indicador]->sequencia }}.
            {{ $avaliacao->instrumento->dimensoes[$dimensao]->indicadores[$indicador]->descricao}}
        </p>
    </div>
    <div class="flex flex-col">
        @foreach ($avaliacao->instrumento->dimensoes[$dimensao]->indicadores[$indicador]->criterios as $criterio)
            <p class="text-gray-600 border-b px-20 py-2">
                {{$criterio->sequencia}}.
                {{$criterio->descricao}}
            </p>
        @endforeach
    </div>
</div>