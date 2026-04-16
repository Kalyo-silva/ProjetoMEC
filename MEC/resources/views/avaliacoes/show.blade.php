<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <x-popup-message-handler/>

                    <div class="flex justify-between items-center">
                        <div class="flex gap-1 items-center">
                            <x-eva-award-outline class="size-6 text-gray-400" />
                            <h2 class='text-xl border-b-2 border-indigo-400 font-bold'>Executando Avaliação - {{$avaliacao->descricao}}</h2>
                        </div>
                        <a href="{{ route('instrumentos.show', $avaliacao->instrumento->id) }}" class="flex items-center gap-1 border rounded border-indigo-400 px-4 py-2">
                            <x-eva-clipboard-outline class="size-6 text-indigo-400" />
                            <h2 class='text-xl'>{{$avaliacao->instrumento->titulo}}</h2>
                        </a>
                    </div>

                    <div id = "indicadorContainer">
                    
                    </div>
                    
                    <div class="flex flex-row-reverse gap-4 py-2">
                        <button onclick="loadNext()" class="px-4 py-2 border rounded bg-indigo-400 text-white border-indigo-400">Proximo</button>
                        <button onclick="loadPrevious()" class="px-4 py-2 border rounded border-indigo-400 text-indigo-400">Anterior</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-file-manager/>
</x-app-layout>

<script src="{{ asset('js/request.js') }}"></script>

<script>
    let avaliacao_id = {{ $avaliacao->id }}
    let maxDimensao = {{ $avaliacao->instrumento->dimensoes->count() }}
    let maxIndicador = [{{ $maxIndicador }}]
    let dimensao = 0
    let indicador = 0

    function loadIndicador(){
        let container = document.getElementById('indicadorContainer'); 
        container.innerHTML = request('http://127.0.0.1:8000/avaliacoes/'+avaliacao_id+'/'+dimensao+'/'+indicador,'GET');
    }

    function loadNext(){
        if (indicador < maxIndicador[dimensao]-1){
            indicador += 1;

            loadIndicador()
        }
        else {
            if (dimensao < maxDimensao-1){
                dimensao += 1;
                indicador = 0;

                loadIndicador()
            }
        }
    }

    function loadPrevious(){
        if (indicador > 0){
            indicador -= 1;

            loadIndicador()
        }
        else {
            if (dimensao > 0){
                dimensao -= 1;
                indicador = maxIndicador[dimensao]-1;

                loadIndicador()
            }
        }
    }

    loadIndicador()
</script>