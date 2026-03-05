<div class="w-full h-full flex flex-col justify-center items-center">
    @if ($listaArquivos->count() == 0)
        <div class="flex items-center justify-center w-full h-full">
            <p class="text-gray-500">Nenhum Arquivo Encontrado...</p>
        </div>
    @else
        @foreach ($listaArquivos as $file)
            
        @endforeach
    @endif
</div>
