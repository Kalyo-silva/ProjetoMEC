<div class="w-full flex flex-col gap-4 justify-start items-start px-4 py-2">
    @if (!$Arquivos['arquivos'] && !$Arquivos['imagens'] && !$Arquivos['audios'] && !$Arquivos['videos'])
        <div class="flex items-center justify-center w-full h-full">
            <p class="text-gray-500">Nenhum Arquivo Encontrado...</p>
        </div>
    @else
        @if ($Arquivos['arquivos'])
        <div class="flex flex-col w-full">
            <div class="flex items-center gap-1 w-full mb-2">
                <x-eva-file-outline class="size-5 text-indigo-500"/>
                <p class="border-b-2 border-indigo-500">Documentos</p>
            </div>
            <div class="grid grid-cols-4 gap-2 w-full">
                @foreach ($Arquivos['arquivos'] as $file)
                    <div class="flex items-center gap-1 px-4 py-2 border rounded-lg bg-white overflow-hidden cursor-pointer hover:bg-gray-200" onclick="detail({{$file->id}})">
                        @if (str_contains($file->titulo, '.pdf'))
                            <x-far-file-pdf class="size-6 text-indigo-500 w-1/12"/>
                        @elseif (str_contains($file->titulo, '.zip') || str_contains($file->titulo, '.rar') || str_contains($file->titulo, '.7z'))
                            <x-far-file-archive class="size-6 text-indigo-500 w-1/12"/>
                        @else
                            <x-far-file-alt class="size-6 text-indigo-500 w-1/12"/>
                        @endif
                        <p class="truncate w-11/12">{{$file->titulo}}</p>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
        @if ($Arquivos['imagens'])
        <div class="flex flex-col w-full">
            <div class="flex items-center gap-1 w-full mb-2">
                <x-eva-image-outline class="size-5 text-indigo-500"/>
                <p class="border-b-2 border-indigo-500">Imagens</p>
            </div>
            <div class="grid grid-cols-4 gap-2  w-full">
                @foreach ($Arquivos['imagens'] as $file)
                    <div class="flex items-center gap-1 px-4 py-2 border rounded-lg bg-white overflow-hidden cursor-pointer hover:bg-gray-200" onclick="detail({{$file->id}})">
                        <x-far-file-image class="size-6 text-indigo-500 w-1/12"/>
                        <p class="truncate w-11/12">{{$file->titulo}}</p>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
        @if ($Arquivos['audios'])
        <div class="flex flex-col w-full">
            <div class="flex items-center gap-1 w-full mb-2">
                <x-eva-volume-up-outline class="size-5 text-indigo-500"/>
                <p class="border-b-2 border-indigo-500">Áudios</p>
            </div>
            <div class="grid grid-cols-4 gap-2  w-full">
                @foreach ($Arquivos['audios'] as $file)
                    <div class="flex items-center gap-1 px-4 py-2 border rounded-lg bg-white overflow-hidden cursor-pointer hover:bg-gray-200" onclick="detail({{$file->id}})">
                        <x-far-file-audio class="size-6 text-indigo-500 w-1/12"/>
                        <p class="truncate w-11/12">{{$file->titulo}}</p>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
        @if ($Arquivos['videos'])
        <div class="flex flex-col w-full">
            <div class="flex items-center gap-1 w-full mb-2">
                <x-eva-video-outline class="size-5 text-indigo-500"/>
                <p class="border-b-2 border-indigo-500">Vídeos</p>
            </div>
            <div class="grid grid-cols-4 gap-2  w-full">
                @foreach ($Arquivos['videos'] as $file)
                    <div class="flex items-center gap-1 px-4 py-2 border rounded-lg bg-white overflow-hidden cursor-pointer hover:bg-gray-200" onclick="detail({{$file->id}})">
                        <x-far-file-video class="size-6 text-indigo-500 w-1/12"/>
                        <p class="truncate w-11/12">{{$file->titulo}}</p>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    @endif
</div>
