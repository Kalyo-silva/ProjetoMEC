<div class="w-full flex flex-col overflow-y-scroll">
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
        </div>
    @endif
</div>