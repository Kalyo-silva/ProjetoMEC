<div class="w-full h-full flex flex-col">
    @if ($listaTexto->count() == 0)
        <div class="flex items-center justify-center w-full h-full">
            <p class="text-gray-500">Nenhum Texto Encontrado...</p>
        </div>
    @else
        @foreach ($listaTexto as $text)
            
        @endforeach
    @endif
</div>