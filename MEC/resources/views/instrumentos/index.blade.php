<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <x-popup-message-handler/>

                    <div class="flex justify-between items-center mb-4">

                        <div class="flex gap-1 items-center">
                            <x-eva-clipboard-outline class="size-6 text-indigo-400" />
                            <h2 class='text-xl border-b-2 border-indigo-400 font-bold'>Lista de Instrumentos</h2>
                        </div>
                        <div class="flex gap-4">
                            <form method='GET' action="{{ route('instrumentos.index') }}" class="pl-2 flex gap-2 items-center border rounded border-gray-500 overflow-hidden">
                                <x-eva-search-outline class="size-6 text-indigo-400 hover:text-gray-700 hover:cursor-pointer" onclick="this.parentElement.submit()"/>
                                <input type="text" id='search' name='search' class="border-0" placeholder="Titulo, Ano..." value="{{$search}}">
                            </form>

                            <a onclick="OpenModal('create')" class="linkButton">
                                <x-fas-plus class="size-6 text-indigo-400"/>
                                <p>Novo</p>
                            </a>
                        </div>
                    </div>
                    
                    <div class="rounded border">
                        <table class="w-full">
                            <thead class="">
                                <th class="w-10/12 border-collapse border-r py-2">Titulo</th>
                                <th class="w-2/12 border-r">Ano</th>
                            </thead>
                            <tbody>
                                @foreach ($listaInstrumentos as $instrumento)
                                <tr class="border-t">
                                    <td class="border-r">
                                        <a class="flex px-4 py-2 gap-2 items-center hover:border-b-2 border-indigo-400 transition-all" href="{{ route('instrumentos.show', $instrumento->id) }}">
                                            <x-eva-clipboard-outline class="size-5 text-indigo-400" />
                                            <p>{{$instrumento->titulo}}</p>
                                        </a>
                                    </td>
                                    <td class="text-center border-r">{{$instrumento->ano}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{$listaInstrumentos->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-popup-new-instrumento :title="'Novo Instrumento'" :id="'create'">
        <form method="POST" class="mt-4" enctype="multipart/form-data" action="{{ route('instrumentos.store') }}">
        @csrf
            <div class='flex justify-between gap-4'>
                <div class='labeledInput w-10/12'>
                    <label for='titulo'>Titulo</label>
                    <input name='titulo' id='titulo' type='text'>
                </div>
                <div class='labeledInput w-2/12'>
                    <label for='ano'>Ano</label>
                    <input name='ano' id='ano' type='number' maxlength="4">
                </div>
            </div>
            <div class='flex items-center gap-4'>
                <button type="submit" class='linkButton w-full hover:text-green-700 hover:border-green-700 justify-center text-center'>Salvar</button>
            </div>
        </form>
    </x-popup-new-instrumento>
</x-app-layout>