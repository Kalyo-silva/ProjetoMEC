<div id='textGrid' class="w-full h-fit grid grid-cols-3 max-2xl:grid-cols-2 p-4 gap-2 content-start">
    @if ($listaTexto->count() == 0)
        <div class="flex items-center justify-center w-full h-full">
            <p class="text-gray-500">Nenhum Texto Encontrado...</p>
        </div>
    @else
        @foreach ($listaTexto as $text)
        <div class="flex flex-col border rounded-lg shadow-lg bg-white max-h-96 overflow-y-scroll cursor-pointer" onclick="detail({{$text->id}})">
            <p class="font-bold border-b px-4 py-2 max-2xl:text-sm">{{$text->titulo}}</p>
            <pre class="text-justify px-4 py-2 whitespace-pre-line font-sans max-2xl:text-sm">{{$text->texto}}</pre>      
        </div>
        @endforeach

        @if ($listaTexto->count() < $totalTextos)
            <div class="flex gap-1 col-span-2 cursor-pointer w-full justify-center" onclick="loadTexts({{$listaTexto->count()}})">
                <x-eva-plus class="size-5 text-indigo-500"/>
                <p class="text-sm text-gray-500 underline">Carregar mais</p>
            </div>
        @endif
    @endif
</div>