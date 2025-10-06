<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('error'))
                        <div id="ErrorContainer" class="flex mb-4 p-4 bg-red-100 text-red-800 rounded justify-between items-center">
                            <p>{{ session('error') }}</p>
                            <p class="font-bold mr-2 cursor-pointer" onclick="closeContainer()">X</p>
                        </div>
                    @endif

                    <div class="flex items-center">
                        <x-uni-university-o class="size-6 mr-2 text-gray-400"/>
                        <h2 class="text-lg border-b-2 border-indigo-400 w-fit">@if ($mode = 'edit') Alteração da Instituição @else Cadastro de Instituição @endif</h2>
                    </div>

                    @if ($mode == 'edit' && isset($instituicao))
                        <form method="POST" class="mt-4 border rounded p-6 shadow-lg" enctype="multipart/form-data" action="{{ route('instituicoes.update', $instituicao->id) }}">
                        @method("PUT")
                    @else
                        <form method="POST" class="mt-4 border rounded p-6 shadow-lg" enctype="multipart/form-data" action="{{ route('instituicoes.store') }}">
                    @endif
                        @csrf
                        <div>
                            <div class="flex">
                                <div class="mr-4">
                                    <label for="logo">
                                        <p>Logo</p>
                                        <div id='preview_logo'>
                                            <img src="{{asset('img/defaultcover.png')}}" alt="logo" class="size-32 rounded shadow-lg border">
                                        </div>
                                    </label>
                                    <input type="file" name="logo" id="logo" hidden accept=".jpg, .jpeg, .png">
                                </div>

                                <div class="w-full">
                                    <div class='flex justify-between gap-4'>
                                        <div class='labeledInput w-10/12'>
                                            <label for='nome'>Nome</label>
                                            <input name='nome' required maxlength="200" id='nome' type='text' @if($mode == 'edit' && isset($instituicao)) value="{{$instituicao->nome}}" @endif>
                                        </div>
                                        <div class='labeledInput w-2/12'>
                                            <label for='sigla'>Sigla</label>
                                            <input name='sigla' required maxlength="200" id='sigla' type='text' @if($mode == 'edit' && isset($instituicao)) value="{{$instituicao->sigla}}" @endif>
                                        </div>
                                    </div>

                                    <div class='flex justify-between gap-4'>
                                        <div class='labeledInput w-10/12'>
                                            <label for='cidade'>Cidade</label>
                                            <input name='cidade' id='cidade' maxlength="200" type='text' @if($mode == 'edit' && isset($instituicao)) value="{{$instituicao->cidade}}" @endif>
                                        </div>
                                        <div class='labeledInput w-2/12'>
                                            <label for='uf'>UF</label>
                                            <select name="uf" id="uf" class="rounded">
                                                <option value="AC" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'AC') selected @endif>AC</option>
                                                <option value="AL" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'AL') selected @endif>AL</option>
                                                <option value="AP" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'AP') selected @endif>AP</option>
                                                <option value="AM" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'AM') selected @endif>AM</option>
                                                <option value="BA" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'BA') selected @endif>BA</option>
                                                <option value="CE" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'CE') selected @endif>CE</option>
                                                <option value="DF" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'DF') selected @endif>DF</option>
                                                <option value="ES" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'ES') selected @endif>ES</option>
                                                <option value="GO" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'GO') selected @endif>GO</option>
                                                <option value="MA" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'MA') selected @endif>MA</option>
                                                <option value="MT" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'MT') selected @endif>MT</option>
                                                <option value="MS" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'MS') selected @endif>MS</option>
                                                <option value="MG" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'MG') selected @endif>MG</option>
                                                <option value="PA" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'PA') selected @endif>PA</option>
                                                <option value="PB" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'PB') selected @endif>PB</option>
                                                <option value="PR" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'PR') selected @endif>PR</option>
                                                <option value="PE" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'PE') selected @endif>PE</option>
                                                <option value="PI" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'PI') selected @endif>PI</option>
                                                <option value="RJ" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'RJ') selected @endif>RJ</option>
                                                <option value="RN" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'RN') selected @endif>RN</option>
                                                <option value="RS" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'RS') selected @endif>RS</option>
                                                <option value="RO" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'RO') selected @endif>RO</option>
                                                <option value="RR" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'RR') selected @endif>RR</option>
                                                <option value="SC" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'SC') selected @endif>SC</option>
                                                <option value="SP" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'SP') selected @endif>SP</option>
                                                <option value="SE" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'SE') selected @endif>SE</option>
                                                <option value="TO" @if($mode == 'edit' && isset($instituicao) && $instituicao->uf == 'TO') selected @endif>TO</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='flex justify-between gap-4'>
                                <div class='labeledInput w-full'>
                                    <label for='bairro'>Bairro</label>
                                    <input name='bairro' maxlength="200" id='bairro' type='text' @if($mode == 'edit' && isset($instituicao)) value="{{$instituicao->bairro}}" @endif>
                                </div>
                                <div class='labeledInput w-full'>
                                    <label for='cep'>CEP</label>
                                    <input name='cep' maxlength="8" id='cep' type='number' @if($mode == 'edit' && isset($instituicao)) value={{$instituicao->cep}} @endif>
                                </div>
                            </div>
                            <div class='labeledInput'>
                                <label for='logradouro'>Logradouro</label>
                                <input name='logradouro' maxlength="200" id='logradouro' type='text' @if($mode == 'edit' && isset($instituicao)) value="{{$instituicao->logradouro}}" @endif>
                            </div>


                            <div class='labeledInput'>
                                <label for='id_mantenedor'>Mantenedor</label>
                                <select name="id_mantenedor" id="id_mantenedor" class="rounded">
                                        <option value="0" selected>Selecione</option>
                                    @foreach ($listaMantenedores as $mantenedor)
                                        <option value="{{$mantenedor->id}}">{{$mantenedor->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class='mt-8 flex gap-4 flex-row-reverse'>
                            <button type="submit" class='linkButton hover:text-green-700 hover:border-green-700'>Salvar</button>
                            @if ($mode == 'edit')
                                <a href="{{route('instituicoes.index')}}" class='linkButton hover:text-red-700 hover:border-red-700'>Cancelar</a>
                            @else
                                <button type="reset" class='linkButton hover:text-red-700 hover:border-red-700'>Limpar</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function closeContainer(){
        document.getElementById('ErrorContainer').remove();
    }
</script>


<script>
    const input = document.getElementById("logo");
    const Preview = document.getElementById("preview_logo");

    input.addEventListener("change", updateImageDisplay);

    function updateImageDisplay() {
        const curFiles = input.files;

        if (curFiles.length != 0) {
            while (Preview.firstChild) {
                Preview.removeChild(Preview.firstChild);
            }


            for (const file of curFiles) {
                const image = document.createElement("img");
                image.src = URL.createObjectURL(file);
                image.alt = file.name;
                image.className = "size-32 rounded object-contain shadow-lg border";

                Preview.appendChild(image);
            }
        }
    }
</script>
