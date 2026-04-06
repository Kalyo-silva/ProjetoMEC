<!--dark bg-->
<div class="w-full h-full bg-black bg-opacity-40 fixed left-0 top-0 p-4">
    <!--Main Container-->
    <div class="w-full h-full bg-white rounded-lg flex flex-col overflow-hidden">
        <!--Header-->
        <header class="w-full h-10 border-b px-4 py-2 flex justify-between items-center">
            <p class="text-gray-500">Gerenciador de Arquivos</p>
            <x-eva-close-outline class='size-6 fill-gray-400 cursor-pointer' onclick="closeModal('fileManager_container')"/>
        </header>
        <!--3 sides-->
        <div class="flex overflow-hidden w-full h-full">

            <!--Links-->
            <aside class="h-full w-2/12 border-r flex flex-col">
                <header class="flex items-center justify-between py-2 px-4 shadow-lg border-b">
                    <div class="flex gap-1 items-center">
                        <x-eva-link-2-outline class="size-5 text-indigo-500"/>
                        <p class="text-sm text-gray-500">Links</p>
                    </div>    
                    <x-eva-plus-outline class="size-5 text-indigo-500 cursor-pointer transition-all" onclick="openlinkForm(this, 'linkForm')"/>
                </header>

                <form id='linkForm' class="border rounded m-2 overflow-hidden hidden" method='POST' action="{{route('evidencias.store_link')}}">
                    @csrf
                    <input type="text" id='link' name='link' class="border-0 w-full">
                    <button type='submit' class="px-2 bg-indigo-500">
                        <x-eva-arrow-right-outline class="size-6 text-white cursor-pointer"/>
                    </button>
                </form>
                
                
                <div id="containerLinks" class="overflow-y-scroll h-full">

                </div>
            </aside>

            <!-- Files and Texts-->
            <main class="h-full w-8/12 flex flex-col">

                <!-- Files -->
                <section class="h-3/6 border-b flex flex-col" id="FilesSection">
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
                    <div id="containerFiles" class="h-full overflow-y-scroll">

                    </div>
                </section>

                <!-- Texts -->
                <section id="TextSection" class="flex flex-col transition-all h-3/6">
                    <nav class="w-full px-4 py-2 border-b shadow-lg flex justify-between items-center bg-white">
                        <div class="flex gap-1 items-center">
                            <x-eva-book-outline class="size-5 text-indigo-500"/>
                            <p class="text-sm text-gray-500">Textos</p>
                        </div>
                        <div class="flex items-center">
                            <x-eva-plus-outline class="size-5 text-indigo-500 cursor-pointer transition-all" onclick="openlinkForm(this, 'formText'); changeGridSize('textGrid')"/>
                            <x-eva-arrow-up-outline class="size-5 text-indigo-500 cursor-pointer transition-all" onclick="expandTextSection(this)"/>
                        </div>
                    </nav>

                    <div id="containerTexts" class="h-full overflow-y-scroll">

                    </div>


                    <form action="{{ route('evidencias.store_text') }}" id='formText' method="POST" class="overflow-y-scroll flex-col bg-white border rounded-lg m-4 overflow-hidden hidden">
                        @csrf

                        <input class="border-0 border-b border-gray-400 font-bold" type="text" name="titulo" placeholder="Titulo...">
                    
                        <textarea name="texto" id="texto" cols="100" rows="8" class="border-0"></textarea>

                        <button type='submit' class="px-2 bg-indigo-500 flex flex-row-reverse items-center">
                            <x-eva-arrow-right-outline class="size-6 text-white cursor-pointer"/>
                            <p class="text-sm text-white">Enviar</p>
                        </button>
                    
                    </form>

                </section>
            </main>

            <!-- Details -->
            <aside class="h-full w-2/12 border-l flex flex-col">
                <nav class="w-full px-4 py-2 border-b shadow-lg bg-white">
                    <div class="flex gap-1 items-center">
                        <x-eva-list-outline class="size-5 text-indigo-500"/>
                        <p class="text-sm text-gray-500">Detalhes</p>
                    </div>
                </nav>
                <div id="containerDetails" class="h-full">

                </div>
            </aside>

        </div>
    </div>
</div>

<script src="{{ asset('js/request.js') }}"></script>

<script>
    function openlinkForm(button, formname){
        form = document.getElementById(formname);

        if (form.style.display == 'flex' && form.style.display != ''){
            form.style.display = 'none';
            button.style = 'transform: rotate(0deg);'
        
            if (formname == 'formText'){
                document.getElementById('containerTexts').style.display = 'flex';
            }
        }
        else{
            form.style.display = 'flex';
            button.style = 'transform: rotate(45deg);'

            if (formname == 'formText'){
                document.getElementById('containerTexts').style.display = 'none';
            }
        }

    }

    function loadLinks(size = 0){
        document.getElementById('containerLinks').innerHTML = request('http://127.0.0.1:8000/evidencias/links/'+size, 'GET');
    }

    function loadFiles(){
        document.getElementById('containerFiles').innerHTML = request('http://127.0.0.1:8000/evidencias/files', 'GET');
    }

    function detail(id){
        document.getElementById('containerDetails').innerHTML = request('http://127.0.0.1:8000/evidencias/'+id+'/details', 'GET');
    }

    function loadTexts(){
        document.getElementById('containerTexts').innerHTML = request('http://127.0.0.1:8000/evidencias/texts', 'GET');
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

    loadLinks()
    loadFiles()
    loadTexts()
</script>