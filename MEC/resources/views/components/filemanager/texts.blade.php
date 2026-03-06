<div id='textGrid' class="w-full h-full grid grid-cols-3 max-2xl:grid-cols-2 p-4 gap-2 content-start">
    @if ($listaTexto->count() == 0)
        <div class="flex items-center justify-center w-full h-full">
            <p class="text-gray-500">Nenhum Texto Encontrado...</p>
        </div>
    @else
        @foreach ($listaTexto as $text)
        <div class="flex flex-col border rounded-lg shadow-lg bg-white max-h-96 overflow-y-scroll cursor-pointer">
            <p class="font-bold border-b px-4 py-2">{{$text->titulo}}</p>
            <pre class="text-justify px-4 py-2 whitespace-pre-line font-sans">{{$text->texto}}</pre>      
        </div>
        @endforeach
    @endif
</div>