<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="flex justify-between items-center">

                        <h2 class='text-xl border-b-2 border-indigo-400 font-bold'>Lista de Mantenedores</h2>
                        <div class="linkButton">
                            <x-fas-plus class="size-6"/>
                            <a href="{{route('mantenedores.create')}}">Novo</a>
                        </div>
                    </div>

                    @if($listaMantenedores->isEmpty())
                        <p>Nenhum Mantenedor Encontrado.</p>
                    @else
                        @foreach ($listaMantenedores as $mantenedor)
                            <div class="rounded border mt-4 px-4 py-4 shadow-lg">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <x-uni-university-o class="size-6 mr-2 text-gray-500"/>
                                        <h2 class="font-bold">{{$mantenedor->nome}}</h2>
                                    </div>
                                    <div class="flex items-center">
                                        <p class="text-gray-700 mr-4">0 Instituições</p>
                                        <x-eva-arrow-down-outline class="size-8 text-gray-500 cursor-pointer transition-all" onclick="OpenMenuDetalhes(this,'details_mantenedor_{{$mantenedor->id}}')"/>
                                    </div>
                                </div>
                                <div id='details_mantenedor_{{$mantenedor->id}}' class="hidden gap-4 mt-4">
                                    <div class="flex gap-4">
                                        <div class="shadow-lg border rounded p-4 w-1/2">
                                            <h2 class="font-bold border-b-2 w-fit border-indigo-400 mb-2">Endereço</h2>

                                            <div class="flex justify-between items-center mb-2">
                                                <div class='labeledInput w-10/12 mr-4'>
                                                    <label for='cidade'>Cidade</label>
                                                    <input name='cidade' id='cidade' type='text' value="{{$mantenedor->cidade}}" readonly>
                                                </div>

                                                <div class='labeledInput w-2/12'>
                                                    <label for='uf'>UF</label>
                                                    <input name='uf' id='uf' type='text' value="{{$mantenedor->uf}}" readonly>
                                                </div>
                                            </div>

                                            <div class="flex justify-between items-center mb-2">
                                                <div class='labeledInput w-1/2 mr-4'>
                                                    <label for='bairro'>Bairro</label>
                                                    <input name='bairro' id='bairro' type='text' value="{{$mantenedor->bairro}}" readonly>
                                                </div>

                                                <div class='labeledInput w-1/2'>
                                                    <label for='cep'>CEP</label>
                                                    <input name='cep' id='cep' type='text' value="{{$mantenedor->cep}}" readonly>
                                                </div>
                                            </div>
                                            <div class='labeledInput'>
                                                <label for='logradouro'>Logradouro</label>
                                                <input name='logradouro' id='logradouro' type='text' value="{{$mantenedor->logradouro}}" readonly>
                                            </div>

                                        </div>
                                        <div class="shadow-lg border rounded p-4 w-1/2">
                                            <h2 class="font-bold border-b-2 w-fit border-indigo-400 mb-2">Instituições Vinculadas</h2>
                                            <div class="flex justify-center items-center h-5/6">
                                                <p class="text-gray-500">Nenhuma Instituição vinculada... 😕</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex mt-4 flex-row-reverse gap-4">
                                        <div class="linkButton">
                                            <x-eva-edit-outline class="size-6"/>
                                            <a href="{{route('mantenedores.create')}}">Editar</a>
                                        </div>
                                        <div class="linkButton">
                                            <x-eva-trash-outline class="size-6"/>
                                            <a href="{{route('mantenedores.create')}}">Excluir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <div class="mt-4">
                        {{$listaMantenedores->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function OpenMenuDetalhes(button, id){
        var menu = document.getElementById(id);

        if (menu.style.display != 'none' && menu.style.display != ''){
            menu.style.display = 'none';
            button.style = 'transform : rotate(0deg);';
        }
        else{
            menu.style.display = 'block';
            button.style = 'transform : rotate(180deg);';
        }
    }
</script>