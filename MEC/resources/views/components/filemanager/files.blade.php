<div class="w-full flex flex-col justify-start items-start p-8">
    @if ($listaArquivos->count() == 0)
        <div class="flex items-center justify-center w-full h-full">
            <p class="text-gray-500">Nenhum Arquivo Encontrado...</p>
        </div>
    @else
        <div class="grid grid-cols-4 gap-2">
            @foreach ($listaArquivos as $file)
                <div class="flex items-center gap-1 px-4 py-2 border rounded-lg bg-white overflow-hidden cursor-pointer hover:bg-gray-200" onclick="detail({{ json_encode($file) }}, '{{ asset('uploads_evidencias')}}')">
                    @if (str_contains($file->titulo, '.pdf'))
                        <x-far-file-pdf class="size-6 text-indigo-500 w-1/12"/>
                    @elseif (str_contains($file->titulo, '.png') || str_contains($file->titulo, '.jpeg') || str_contains($file->titulo, '.jpg'))
                        <x-far-file-image class="size-6 text-indigo-500 w-1/12"/>
                    @elseif (str_contains($file->titulo, '.zip') || str_contains($file->titulo, '.rar') || str_contains($file->titulo, '.7z'))
                        <x-far-file-archive class="size-6 text-indigo-500 w-1/12"/>
                    @elseif (str_contains($file->titulo, '.mp3'))
                        <x-far-file-audio class="size-6 text-indigo-500 w-1/12"/>
                    @elseif (str_contains($file->titulo, '.mp4') || str_contains($file->titulo, '.wav') || str_contains($file->titulo, '.avi'))
                        <x-far-file-video class="size-6 text-indigo-500 w-1/12"/>
                    @else
                        <x-far-file-alt class="size-6 text-indigo-500 w-1/12"/>
                    @endif
                    <p class="truncate w-11/12">{{$file->titulo}}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>

<script>
    function detail(file, path){        
        document.getElementById('details_container').style.display = 'flex';
        document.getElementById('details_title').innerText = file['titulo'];
        document.getElementById('details_type').innerText = file['titulo'].split('.').pop();
        document.getElementById('details_upload_date').innerText = new Date(file['data_criacao']).toLocaleDateString();
        
        if ((file['titulo'].split('.').pop() == 'png') || (file['titulo'].split('.').pop() == 'jpg') || (file['titulo'].split('.').pop() == 'jpeg')){
            document.getElementById('details_img').style.display = 'flex';
            document.getElementById('details_img_source').src = path+'/'+file['file_path'];

            document.getElementById('details_audio').style.display = 'none';
            document.getElementById('details_video').style.display = 'none';
        }
        else if ((file['titulo'].split('.').pop() == 'mp4') || (file['titulo'].split('.').pop() == 'wav') || (file['titulo'].split('.').pop() == 'avi')){
            document.getElementById('details_video').style.display = 'flex';
            document.getElementById('details_video_source').src = path+'/'+file['file_path'];

            document.getElementById('details_img').style.display = 'none';
            document.getElementById('details_audio').style.display = 'none';
        }
        else if (file['titulo'].split('.').pop() == 'mp3'){
            document.getElementById('details_audio').style.display = 'flex';
            document.getElementById('details_audio_source').src = path+'/'+file['file_path'];
            
            document.getElementById('details_video').style.display = 'none';
            document.getElementById('details_img').style.display = 'none';
        }
        else{
            document.getElementById('details_img').style.display = 'none';
            document.getElementById('details_audio').style.display = 'none';
            document.getElementById('details_video').style.display = 'none';
        }
    }
</script>