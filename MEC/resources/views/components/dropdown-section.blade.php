<div class="rounded border mt-4 px-4 py-4">
    <script>
        function OpenMenuDetalhes(button, id) {
            var menu = document.getElementById(id);

            if (menu.style.display != 'none' && menu.style.display != '') {
                menu.style.display = 'none';
                button.style = 'transform : rotate(0deg);';
            } else {
                menu.style.display = 'block';
                button.style = 'transform : rotate(180deg);';
            }
        }
    </script>

    <div class="flex justify-between items-center">
        <div class="flex items-center gap-1">
            @if ($mode == 'cursos')  
                <x-eva-book-outline class="size-6 mr-2 text-gray-500" />
            @elseif ($mode == 'mantenedores')
                <x-uni-university-o class="size-6 text-gray-400" />
            @elseif ($mode == 'instrumentos')
                <x-eva-clipboard-outline class="size-6 text-gray-400" />
            @elseif ($mode == 'dimensoes')
                <x-eva-cube-outline class="size-6 text-gray-400" />
            @endif
            
            <h2 class="font-bold">{{ $title }}</h2>
        </div>
        <div class="flex items-center">
            <x-eva-arrow-down-outline
                class="size-8 text-gray-500 cursor-pointer transition-all"
                onclick="OpenMenuDetalhes(this,'details_{{ $id }}')" />
        </div>
    </div>

    <div id='details_{{ $id }}' class="hidden gap-4 mt-4">
        {{ $slot }}
    </div>
</div>
