<div class="flex flex-col w-full">
    <div class="flex items-center gap-1 w-full mb-2">
        <x-eva-file-outline class="size-5 text-indigo-500"/>
        <p class="border-b-2 border-indigo-500">{{$titulo}}</p>
    </div>
    <div class="grid grid-cols-4 gap-2 w-full">
        @foreach ($arquivos as $file)
            <div class="flex items-center gap-1 px-4 py-2 border rounded-lg bg-white overflow-hidden cursor-pointer hover:bg-gray-200" onclick="detail({{$file->id}})">
                @if($tipo == 6)
                    @if (str_contains($file->titulo, '.pdf'))
                        <x-far-file-pdf class="size-6 text-indigo-500 w-1/12"/>
                    @elseif (str_contains($file->titulo, '.zip') || str_contains($file->titulo, '.rar') || str_contains($file->titulo, '.7z'))
                        <x-far-file-archive class="size-6 text-indigo-500 w-1/12"/>
                    @else
                        <x-far-file-alt class="size-6 text-indigo-500 w-1/12"/>
                    @endif
                @elseif($tipo == 5)
                    <x-far-file-video class="size-6 text-indigo-500 w-1/12"/>
                @elseif ($tipo == 4)
                    <x-far-file-audio class="size-6 text-indigo-500 w-1/12"/>
                @elseif ($tipo == 3)
                    <x-far-file-image class="size-6 text-indigo-500 w-1/12"/>
                @endif
                    
                <p class="truncate w-11/12">{{$file->titulo}}</p>
            </div>
        @endforeach
    </div>
    @if ($arquivos->count() < $total)
        <div class="flex gap-1 cursor-pointer w-full justify-center mt-2">
            <x-eva-plus class="size-5 text-indigo-500"/>
            <p class="text-sm text-gray-500 underline">Carregar mais</p>
        </div>
    @endif
</div>