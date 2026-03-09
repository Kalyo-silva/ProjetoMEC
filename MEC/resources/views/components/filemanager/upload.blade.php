<div id="uploadContainer" class="bg-black bg-opacity-40 fixed w-full h-full top-0 left-0 content-center hidden">
    <form method="POST" action="{{ route('evidencias.store_file') }}" enctype="multipart/form-data" class="w-1/2 h-1/2 border rounded-lg mx-auto bg-white shadow-lg flex flex-col items-center justify-center">
        @csrf
        <div id="fileContainer" class="flex flex-col items-center justify-center cursor-pointer w-full h-full">
            <label for='file_path' class="flex flex-col items-center justify-center cursor-pointer w-full h-full">   
                <x-eva-cloud-upload-outline class="size-16 text-indigo-400"/>
                <p class="text-gray-500">Selecione o arquivo.</p>
            </label>
            <input type="file" name="file_path" id="file_path" hidden onchange="loadFile(event)">
        </div>
        <div id='previewContainer' class="flex-col items-center justify-center  w-full h-full hidden">
            <div class="flex gap-1 h-1/5 w-full px-8 items-center justify-center">
                <x-eva-file-text-outline class="size-16 text-gray-500"/>
                <div class="flex flex-col">
                    <p id='imagem_title' class="text-indigo-500 font-bold text-lg">Titulo da Imagem </p>
                    <p id='imagem_extension' class="text-sm text-gray-400 italic">Arquivo .PNG</p>
                </div>
            </div>
        </div>
        <div class="border-t w-full flex items-center justify-between px-4 py-2">
            <button type='reset' class="flex items-center" onclick="unloadFile(); openUploadContainer()">
                <x-eva-close-outline class="size-5 text-red-400"/>
                <p class="text-red-400">Cancelar</p>
            </button>
            <button type="submit" id='uploadButton' class="flex items-center text-gray-400" disabled>
                <p>Upload</p>
                <x-eva-arrow-right-outline class="size-5"/>
            </button>
        </div>
    </form>
</div>

<script>
    function openUploadContainer(){
        container = document.getElementById('uploadContainer');
        console.log(container.style.display)

        if (container.style.display == 'block'){
            container.style.display = 'none';
        }
        else{
            container.style.display = 'block';
        }
    }

    function loadFile(event){
        document.getElementById('fileContainer').style.display = 'none';
        document.getElementById('previewContainer').style.display = 'flex';

        ext = event.target.files[0].name.split('.').pop();

        document.getElementById('imagem_title').innerText = event.target.files[0].name
        document.getElementById('imagem_extension').innerText = 'Arquivo .'+ext        
        document.getElementById('uploadButton').className += ' text-green-500';
        document.getElementById('uploadButton').disabled = false;
    }

    function unloadFile(){

        document.getElementById('fileContainer').style.display = 'flex';
        document.getElementById('previewContainer').style.display = 'none';
        document.getElementById('uploadButton').className = document.getElementById('uploadButton').className.replace(' text-green-500', '');
        document.getElementById('uploadButton').disabled = true;
    }
</script>