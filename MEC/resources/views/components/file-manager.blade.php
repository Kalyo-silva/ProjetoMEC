<div class="flex w-full h-full bg-black fixed top-0 left-0 bg-opacity-40 p-4"> <!-- dark Bg -->
    <div class="flex flex-col w-full h-full bg-white rounded shadow-lg">
        <header class="w-full h-fit border-b px-4 py-2 flex justify-between items-center">
            <p class="text-gray-500">Gerenciador de Arquivos</p>
            <x-eva-close-outline class='size-6 fill-gray-400 cursor-pointer' onclick="closeModal('')"/>
        </header>
        <x-popup-message-handler/>
        <div class="flex w-full h-full bg-gray-100">
            <aside class="w-2/12 border-r flex flex-col ">
                <div class="h-1/2">
                    <nav class="w-full px-4 py-2 border-b shadow-lg bg-white">
                        <div class="flex gap-1 items-center">
                            <x-eva-clock-outline class="size-5 text-indigo-500"/>
                            <p class="text-sm text-gray-500">Histórico</p>
                        </div>
                    </nav>
                </div>
                <div class="h-1/2 border-t flex flex-col">
                    <nav class="w-full px-4 py-2 border-b shadow-lg flex justify-between items-center bg-white">
                        <div class="flex gap-1 items-center">
                            <x-eva-link-2-outline class="size-5 text-indigo-500"/>
                            <p class="text-sm text-gray-500">Links</p>
                        </div>
                        <x-eva-plus-outline class="size-5 text-indigo-500 cursor-pointer transition-all" onclick="openlinkForm(this, 'linkForm')"/>
                    </nav>
                    <form id='linkForm' class="border rounded m-2 overflow-hidden hidden" method='POST' action="{{route('evidencias.store_link')}}">
                        @csrf
                        <input type="text" id='link' name='link' class="border-0 w-full">
                        <button type='submit' class="px-2 bg-indigo-500">
                            <x-eva-arrow-right-outline class="size-6 text-white cursor-pointer"/>
                        </button>
                    </form>

                    <x-filemanager.links :listaLinks="$listaLinks"/>
                </div>
            </aside>
            <main class="w-8/12 flex flex-col">
                <section class="h-4/6 overflow-hidden" id="FilesSection">
                    <nav class="w-full px-4 py-2 flex justify-between border-b shadow-lg bg-white">
                        <div class="flex gap-1 items-center">
                            <x-eva-file-text-outline class="size-5 text-indigo-500"/>
                            <p class="text-sm text-gray-500">Meus Arquivos</p>
                        </div>
                        <div class="flex justify-between flex-row-reverse">
                            <button id="UploadButton" class="flex gap-1 h-fit items-center" onclick="openUploadContainer()">
                                <x-eva-cloud-upload-outline class="size-5 text-indigo-400"/>
                                <p class='text-sm text-indigo-500 underline'>Upload</p>
                            </button>
                            <x-filemanager.upload/>
                        </div>
                    </nav>
                    <x-filemanager.files :listaArquivos="$listaArquivos"/>
                    
                </section>
                <section class="border-t h-2/6 overflow-y-scroll flex flex-col transition-all" id = "TextSection">
                    <nav class="w-full px-4 py-2 border-b shadow-lg flex justify-between items-center bg-white">
                        <div class="flex gap-1 items-center">
                            <x-eva-book-outline class="size-5 text-indigo-500"/>
                            <p class="text-sm text-gray-500">Textos</p>
                        </div>
                        <div class="flex items-center">
                            <x-eva-plus-outline class="size-5 text-indigo-500 cursor-pointer transition-all" onclick="openlinkForm(this, 'formText'); changeGridSize('textGrid', 2)"/>
                            <x-eva-arrow-up-outline class="size-5 text-indigo-500 cursor-pointer transition-all" onclick="expandTextSection(this)"/>
                        </div>
                    </nav>
                    <div class="flex items-start">   

                        <x-filemanager.texts :listaTexto="$listaTexto"/>

                        <form action="{{ route('evidencias.store_text') }}" id='formText' method="POST" class="flex-col bg-white border rounded-lg m-4 overflow-hidden hidden">
                            @csrf

                            <input class="border-0 border-b border-gray-400 font-bold" type="text" name="titulo" placeholder="Titulo...">
                        
                            <textarea name="texto" id="texto" cols="100" rows="10" class="border-0"></textarea>
 
                            <button type='submit' class="px-2 bg-indigo-500 flex flex-row-reverse items-center">
                                <x-eva-arrow-right-outline class="size-6 text-white cursor-pointer"/>
                                <p class="text-sm text-white">Enviar</p>
                            </button>
                        
                        </form>

                    </div>
                </section>
            </main>
            <aside class="w-2/12 border-l">
                <nav class="w-full px-4 py-2 border-b shadow-lg bg-white">
                    <div class="flex gap-1 items-center">
                        <x-eva-list-outline class="size-5 text-indigo-500"/>
                        <p class="text-sm text-gray-500">Detalhes</p>
                    </div>
                </nav>

                <x-filemanager.details/>
            </aside>
        </div>
    </div>
</div>

<script>
    function openlinkForm(button, formname){
        form = document.getElementById(formname);

        if (form.style.display == 'flex' && form.style.display != ''){
            form.style.display = 'none';
            button.style = 'transform: rotate(0deg);'
        }
        else{
            form.style.display = 'flex';
            button.style = 'transform: rotate(45deg);'
        }
    }

    function changeGridSize(gridname, size){
        grid = document.getElementById(gridname);

        console.log(grid.style.gridTemplateColumns)

        if (grid.style.gridTemplateColumns == 'repeat('+size+', minmax(0px, 1fr))'){
            grid.style.gridTemplateColumns = '';
        }
        else{
            grid.style.gridTemplateColumns = 'repeat('+size+', minmax(0, 1fr))';
        }
    }

    function expandTextSection(button){
        files = document.getElementById('FilesSection');
        texts = document.getElementById('TextSection');

        if (files.style.display == 'block' || files.style.display == ''){
            files.style.display = 'none';
            texts.style.height = '100%'
            button.style = 'transform: rotate(180deg);'
        }
        else{
            files.style.display = 'block';
            texts.style.height = ''
            button.style = 'transform: rotate(0deg);'
        }
    }
</script>