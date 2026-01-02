<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <x-popup-message-handler/>

                    <div class="flex justify-center items-center">
                        <div class="flex gap-1 items-center">
                            <h2 class='text-xl border-b-2 border-indigo-400 font-bold'>Confirmar Exclusão de Mantenedor</h2>
                        </div>
                    </div>
                    
                    <div class='py-6 flex items-center justify-center'>
                        <div class="p-2  px-4 flex items-center justify-center border border-gray-400 rounded w-fit">
                            <x-uni-university-o class="size-6 mr-2 text-gray-500" />
                            <h2 class="font-bold">{{ $mantenedor->nome }}</h2>
                        </div>
                    </div>

                    <div class="flex flex-row-reverse gap-4 justify-center">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('mantenedores.destroy', $mantenedor->id) }}">
                        @method("DELETE")
                        @csrf
                            <div class="text-red-500 border-red-500 border rounded items-center flex px-4 py-2">
                                <button type='submit' class="flex">
                                    <x-eva-trash-outline class="size-6" />
                                    <p>Excluir</p>
                                </button>
                            </div>
                        </form>
                        <div class="linkButton hover:text-indigo-400 hover:border-indigo-400">
                            <a href="{{ route('mantenedores.index') }}" class="flex">
                                <x-eva-undo-outline class="size-6" />
                                <p>Cancelar</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>