<div id="details_container" class="w-full flex-col p-4 gap-4 hidden">
    <div id="details_img" class="w-full rounded overflow-hidden border shadow-lg hidden">
        <img id="details_img_source" src="#" alt="">
    </div>
    <div id="details_audio" class="w-full rounded overflow-hidden border shadow-lg hidden">
        <audio controls class="w-full">
            <source id="details_audio_source" src="#" type="audio/ogg">
            <source id="details_audio_source" src="#" type="audio/mpeg">
        </audio>
    </div>
    <div id="details_video" class="w-full rounded overflow-hidden border shadow-lg hidden">
        <video controls class="w-full">
            <source id="details_video_source" src="#" type="video/mp4">
        </video>
    </div>
    <div class="border rounded shadow-lg bg-white px-4 py-2">
        <div class="flex items-center gap-1">
            <x-eva-list-outline class="text-indigo-500 size-6"/>
            <p class="text-lg text-indigo-500 font-bold">Título</p>
        </div>
        <p id='details_title' class="truncate">Arquivo_teste.png</p>
    </div>
    <div class="border rounded shadow-lg bg-white px-4 py-2">
        <div class="flex items-center gap-1">
            <x-eva-file-outline class="text-indigo-500 size-6"/>
            <p class="text-lg text-indigo-500 font-bold">Tipo de Arquivo</p>
        </div>
        <p id='details_type' class="truncate">Arquivo de imagem</p>
    </div>
    <div class="border rounded shadow-lg bg-white px-4 py-2">
        <div class="flex items-center gap-1">
            <x-eva-calendar-outline class="text-indigo-500 size-6"/>
            <p class=" text-lg text-indigo-500 font-bold">Data de Upload</p>
        </div>
        <p id='details_upload_date' class="truncate">01/01/2000</p>
    </div>
</div>