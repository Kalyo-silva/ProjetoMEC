<div id="modal_{{ $id }}" class='hidden flex-col justify-center items-center w-full h-full fixed bg-black bg-opacity-40 top-0 left-0'>
    <div class='bg-white rounded shadow-lg px-8 py-8'>
        <div class='flex items-center justify-between gap-32'>
            <div class='flex items-center'>
                @if ($id == 'create')
                    <x-fas-plus class="size-6 fill-indigo-400 mr-2"/>
                @elseif ($id == 'edit')  
                    <x-eva-edit-outline class="size-6 fill-indigo-400 mr-2"/>
                @endif
                <h1 class='text-xl font-bold border-b-2 w-fit border-indigo-400'>{{$title}}</h1>
            </div>
            <x-eva-close-outline class='size-6 fill-gray-400 cursor-pointer' onclick="closeModal('{{$id}}')"/>
        </div>
        
        {{ $slot }}
    </div>
</div>

<script>
    function closeModal(id){
        document.getElementById('modal_'+id).style.display='none';
    }
    function OpenModal(id){
        document.getElementById('modal_'+id).style.display='flex';
    }
</script>