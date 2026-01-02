@if (session('success'))
    <div id="ErrorContainer" class="flex mb-4 p-4 bg-green-100 text-green-800 rounded justify-between items-center">
        <p>{{ session('success') }}</p>
        <p class="font-bold mr-2 cursor-pointer" onclick="closeContainer()">X</p>
    </div>
@elseif (session('error'))
    <div id="ErrorContainer" class="flex mb-4 p-4 bg-red-100 text-red-800 rounded justify-between items-center">
        <p>{{ session('error') }}</p>
        <p class="font-bold mr-2 cursor-pointer" onclick="closeContainer()">X</p>
    </div>
@endif

<script>
    function closeContainer(){
        document.getElementById('ErrorContainer').remove();
    }
</script>