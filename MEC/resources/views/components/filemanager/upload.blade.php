<div id="uploadContainer" class="bg-black bg-opacity-40 fixed w-full h-full top-0 left-0 content-center hidden">
    <div class="w-1/2 h-1/2 border rounded-lg mx-auto bg-white shadow-lg flex flex-col items-center justify-center">
        <label for='upload' class="flex flex-col items-center justify-center cursor-pointer w-full h-full">   
            <x-eva-cloud-upload-outline class="size-16 text-indigo-400"/>
            <p class="text-gray-500">Selecione o arquivo.</p>
        </label>
        <input type="file" name="upload" id="upload" hidden>
        <div class="border-t w-full flex items-center justify-between px-4 py-2">
            <button class="flex items-center" onclick="openUploadContainer()">
                <x-eva-close-outline class="size-5 text-red-400"/>
                <p class="text-red-400">Cancelar</p>
            </button>
            <button class="flex items-center">
                <p class="text-gray-400">Upload</p>
                <x-eva-arrow-right-outline class="size-5 text-gray-400"/>
            </button>
        </div>
    </div>
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
</script>