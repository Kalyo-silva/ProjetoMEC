<div id="modalConfirm" class='hidden flex-col justify-center items-center w-full h-full fixed bg-black bg-opacity-40 top-0 left-0'>
    <div class='bg-white rounded shadow-lg px-8 py-8'>
        <div class='flex items-center justify-between'>
            <div class='flex items-center'>
                <x-eva-trash-outline class="size-6 fill-red-400 mr-2"/>
                <h1 class='text-xl font-bold border-b-2 w-fit border-indigo-400'>Confirmar exclusão</h1>
            </div>
            <x-eva-close-outline class='size-6 fill-gray-400 cursor-pointer' onclick='closeModal()'/>
        </div>
        <p class='mt-6'>Você tem certeza que deseja excluir a seguinte instituição?</p>
        
        <div class='flex items-center justify-center border-2 rounded w-fit px-4 py-2 border-indigo-400 mt-6 mx-auto'>
            <x-lucide-university class="size-6 text-black mr-2"/>
            <h2 class='text-2xl'>{{$nome}}</h2>
        </div>
        <div class="flex flex-row-reverse gap-4 mt-6">
            <form method="POST" enctype="multipart/form-data" action="{{ route('instituicoes.destroy', $id) }}" class='cursor-pointer'>
            @method("DELETE")
            @csrf
                <div class="text-red-500 border-red-500 border rounded items-center flex px-4 py-2 hover:bg-red-500 hover:text-white transition-all">
                    <button type='submit' class="flex">
                        <x-eva-trash-outline class="size-6" />
                        <p>Excluir</p>
                    </button>
                </div>
            </form>
            <div class="linkButton hover:text-indigo-400 hover:border-indigo-400">
                <a onclick='closeModal()' class="flex">
                    <x-eva-undo-outline class="size-6" />
                    <p>Cancelar</p>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    function closeModal(){
        document.getElementById('modalConfirm').style.display='none';
    }
    function OpenModal(){
        document.getElementById('modalConfirm').style.display='flex';
    }
</script>