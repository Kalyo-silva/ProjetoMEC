<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2>Cadastro de Mantenedores</h2>

                    <form method="POST" enctype="multipart/form-data" action="{{ route('mantenedores.store') }}">
                        @csrf
                        <div>
                            <div class='labeledInput'>
                                <label for='nome'>Nome</label>
                                <input name='nome' id='nome' type='text'>
                            </div>

                            <div class='flex justify-between gap-4'>
                                <div class='labeledInput w-full'>
                                    <label for='cidade'>Cidade</label>
                                    <input name='cidade' id='cidade' type='text'>
                                </div>
                                <div class='labeledInput w-48'>
                                    <label for='uf'>UF</label>
                                    <input name='uf' id='uf' type='text'>
                                </div>
                            </div>
                            <div class='flex justify-between gap-4'>
                                <div class='labeledInput w-full'>
                                    <label for='bairro'>Bairro</label>
                                    <input name='bairro' id='bairro' type='text'>
                                </div>
                                <div class='labeledInput w-full'>
                                    <label for='cep'>CEP</label>
                                    <input name='cep' id='cep' type='text'>
                                </div>
                            </div>
                            <div class='labeledInput'>
                                <label for='logradouro'>Logradouro</label>
                                <input name='logradouro' id='logradouro' type='text'>
                            </div>
                        </div>
                        
                        <div class='mt-8'>
                            <button type="submit" class='linkButton'>Salvar</button>
                            <button type="reset" class='linkButton'>Limpar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
