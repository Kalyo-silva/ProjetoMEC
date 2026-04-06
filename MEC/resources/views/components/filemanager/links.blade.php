<div class="w-full flex flex-col">
    @if ($listaLinks->count() == 0)
        <div class="flex items-center justify-center w-full h-full">
            <p class="text-gray-500">Nenhum Link Encontrado...</p>
        </div>
    @else
        <div class="flex flex-col gap-2 p-2">
            @foreach ($listaLinks as $link)
                <div class="border rounded px-4 py-2 flex gap-1 items-center cursor-pointer bg-white shadow-sm" onclick="detail({{$link->id}})">
                    <x-eva-link-2-outline class="size-5 text-indigo-500"/>
                    <p class="truncate underline w-11/12">{{$link->link}}</p>
                </div>
            @endforeach
            @if ($listaLinks->count() < $totalLinks)
                <div class="flex gap-1 cursor-pointer w-full justify-center" onclick="loadLinks({{$listaLinks->count()}})">
                    <x-eva-plus class="size-5 text-indigo-500"/>
                    <p class="text-sm text-gray-500 underline">Carregar mais</p>
                </div>
            @endif
        </div>
    @endif
</div>