<div class="w-full h-full bg-red-50 p-4">
    @if ($file->tipo == 3)
    <div class="bg-white border rounded-lg shadow-lg overflow-hidden">
        <img src="{{ asset('uploads_evidencias/'.$file->file_path) }}">    
        <p class="px-4 py-2 text-indigo-500 truncate">{{$file->titulo}}</p>
    </div>
    @elseif ($file->tipo == 4)
        <audio class="w-full bg-transparent" controls src="{{ asset('uploads_evidencias/'.$file->file_path)}}"></audio>
    @elseif ($file->tipo == 5)
        <video controls class='w-full' src="{{ asset('uploads_evidencias/'.$file->file_path) }}"></video>
    @endif
</div>