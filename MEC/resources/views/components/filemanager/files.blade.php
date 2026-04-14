<div class="w-full flex flex-col gap-4 justify-start items-start px-4 py-2">
    @if (!$Arquivos['arquivos'] && !$Arquivos['imagens'] && !$Arquivos['audios'] && !$Arquivos['videos'])
        <div class="flex items-center justify-center w-full h-full">
            <p class="text-gray-500">Nenhum Arquivo Encontrado...</p>
        </div>
    @else
        @if ($Arquivos['arquivos'])
            <x-filemanager.file-section :total="$Arquivos['qtdArquivos']" :titulo="'Documentos'" :arquivos="$Arquivos['arquivos']" :tipo="6" />
        @endif
        @if ($Arquivos['imagens'])
            <x-filemanager.file-section :total="$Arquivos['qtdImagens']" :titulo="'Imagens'" :arquivos="$Arquivos['imagens']" :tipo="3" />
        @endif
        @if ($Arquivos['audios'])
            <x-filemanager.file-section :total="$Arquivos['qtdAudios']" :titulo="'Áudios'" :arquivos="$Arquivos['audios']" :tipo="4" />
        @endif
        @if ($Arquivos['videos'])
            <x-filemanager.file-section :total="$Arquivos['qtdVideos']" :titulo="'Vídeos'" :arquivos="$Arquivos['videos']" :tipo="5" />
        @endif
    @endif
</div>
