<div class="w-full h-full flex flex-col justify-between">
    <div class="flex flex-col gap-4 p-4 h-full">
        @if ($file->tipo == 3)
        <div class="bg-gray-600 border rounded-lg shadow-lg overflow-hidden flex flex-col justify-center">
            <img src="{{ asset('uploads_evidencias/'.$file->file_path) }}">    
            <p class="w-full bg-white px-4 py-2 text-indigo-500 truncate">{{$file->titulo}}</p>
        </div>
        @elseif ($file->tipo == 4)
            <div class="bg-white border rounded-lg shadow-lg overflow-hidden">
                <audio class="w-full bg-transparent" controls src="{{ asset('uploads_evidencias/'.$file->file_path)}}"></audio>
                <p class="px-4 py-2 text-indigo-500 truncate">{{$file->titulo}}</p>
            </div>
        @elseif ($file->tipo == 5)
            <div class="bg-white border rounded-lg shadow-lg overflow-hidden">
                <video controls class='w-full' src="{{ asset('uploads_evidencias/'.$file->file_path) }}"></video>
                <p class="px-4 py-2 text-indigo-500 truncate">{{$file->titulo}}</p>
            </div>
        @elseif ($file->tipo == 6)
            <div class="px-4 py-2 bg-white border rounded-lg shadow-lg">
                <div class="flex gap-1">
                    <x-eva-file-outline class='size-6 text-indigo-500'/>
                    <p class="text-gray-500">Documento</p>
                </div>
                <p class="text-indigo-500 truncate">{{$file->titulo}}</p>
            </div>
        @elseif ($file->tipo == 1)
            <div class="px-4 py-2 bg-white border rounded-lg shadow-lg overflow-hidden">
                <div class="flex gap-1">
                    <x-eva-link-2-outline class='size-6 text-indigo-500'/>
                    <p class="text-gray-500">Link</p>
                </div>
                <a href="{{ $file->link }}" target="_blank"><p class="underline text-indigo-500 truncate text-ellipsis">{{$file->titulo}}</p></a>
            </div>
        @elseif ($file->tipo == 2)
            <div class="overflow-y-scroll bg-white border rounded-lg shadow-lg flex flex-col max-2xl:max-h-80 max-h-96">
                <p class="text-lg font-bold bg-white border-b px-4 py-2 max-2xl:text-sm">{{$file->titulo}}</p>
                <pre class="px-4 py-2 whitespace-pre-line font-sans text-justify h-full max-2xl:text-sm">{{$file->texto}}</pre>
            </div>
        @endif





        <div class="px-4 py-2 bg-white border rounded-lg shadow-lg">
            <div class="flex gap-1">
                <x-eva-calendar-outline class='size-6 text-indigo-500'/>
                <p class="text-gray-500">Data de Criação</p>
            </div>
            <p>{{$file->data_criacao}}</p>
        </div>
        @if ($file->tipo == 3 || $file->tipo == 4 || $file->tipo == 5 || $file->tipo == 6)
            <div class="px-4 py-2 bg-white border rounded-lg shadow-lg">
                <div class="flex gap-1">
                    <x-eva-file-outline class='size-6 text-indigo-500'/>
                    <p class="text-gray-500">Tipo de Arquivo</p>
                </div>
                <p>Arquivo .{{pathinfo($file->file_path, PATHINFO_EXTENSION);}}</p>
            </div>
            <a href={{ asset('uploads_evidencias/'.$file->file_path) }} download="{{ $file->titulo }}" class="flex gap-1 w-full px-4 py-2 bg-indigo-500 border rounded-lg shadow-lg text-white items-center justify-center">
                <x-eva-download-outline class="size-6 text-white"/>
                <p>Download</p>
            </a>
        @endif
        <form class="flex gap-1 px-4 py-2 flex-row justify-center items-center cursor-pointer" action="{{ route('evidencias.destroy', $file->id) }}" method="POST" onclick="this.submit()">
            @csrf
            @method('DELETE')
            <x-eva-trash-outline class='size-5 text-red-400'/>
            <p class="text-red-400 underline">excluir</p>
        </form>
    </div>
    <div class="w-full flex flex-col items-center">
        <div class="w-full bg-indigo-500 shadow-lg cursor-pointer">
            <div class="flex gap-1 px-4 py-2 flex-row-reverse items-center">
                <x-eva-arrow-right-outline class='size-6 text-white'/>
                <p class="text-white">Selecionar</p>
            </div>
        </div>
    </div>
</div>