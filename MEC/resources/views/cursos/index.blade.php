<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <x-popup-message-handler/>

                    <div class="flex justify-between items-center">

                        <div class="flex gap-1 items-center">
                            <x-eva-book-outline class="size-6 text-gray-400" />
                            <h2 class='text-xl border-b-2 border-indigo-400 font-bold'>Lista de Cursos</h2>
                        </div>
                        <a href="{{ route('cursos.create') }}" class="linkButton">
                            <x-fas-plus class="size-6" />
                            <p>Novo</p>
                        </a>
                    </div>

                    @if ($listaCursos->isEmpty())
                        <p>Nenhum Curso Encontrado.</p>
                    @else
                        @foreach ($listaCursos as $curso)
                            <x-dropdown-section :mode="'cursos'" :id="$curso->id" :title="$curso->nome">
                                <div class="flex gap-4">
                                    <div class="rounded p-4 w-1/2 h-full">
                                        <div class='flex gap-2'>
                                            <x-eva-person-outline class="size-6 text-gray-400" />
                                            <h2 class="font-bold border-b-2 w-fit border-indigo-400 mb-2">Gestor do Curso</h2>
                                        </div>
                                        <div class="max-h-64 overflow-y-scroll">
                                            <div
                                                class="flex gap-4 items-center mb-2 py-2 px-4 border rounded justify-between">
                                                <div class="flex gap-4 items-center">

                                                    <div>
                                                        <h2 class="font-bold">{{ $curso->professor->nome }}</h2>
                                                        <p class="text-sm">{{ $curso->professor->vinculo}}</p>
                                                    </div>
                                                </div>
                                                <a href="{{ route('professores.edit', $curso->professor->id) }}">
                                                    <x-eva-search-outline
                                                        class="size-6 text-gray-300 hover:text-gray-700 hover:cursor-pointer" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rounded p-4 w-1/2">

                                        <div class='flex gap-2'>
                                            <x-lucide-university class="size-6 text-gray-400"/>
                                            <h2 class="font-bold border-b-2 w-fit border-indigo-400 mb-2">Instituição Vinculada</h2>
                                        </div>

                                        <div class="max-h-64 overflow-y-scroll">
                                            <div
                                                class="flex gap-4 items-center mb-2 py-2 px-4 border rounded justify-between">
                                                <div class="flex gap-4 items-center">

                                                    <div>
                                                        <h2 class="font-bold">{{ $curso->instituicao->nome }}</h2>
                                                        <p class="text-sm">{{ $curso->instituicao->sigla }}</p>
                                                    </div>
                                                </div>
                                                <a href="{{ route('instituicoes.show', $curso->instituicao->id) }}">
                                                    <x-eva-search-outline
                                                        class="size-6 text-gray-300 hover:text-gray-700 hover:cursor-pointer" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex mt-4 flex-row-reverse gap-4">
                                    <div class="linkButton hover:text-indigo-400 hover:border-indigo-400">
                                        <a href="{{ route('cursos.edit', $curso->id) }}" class="flex">
                                            <x-eva-edit-outline class="size-6" />
                                            <p>Editar</p>
                                        </a>
                                    </div>
                                </div>
                            </x-dropdown-section>
                        @endforeach
                    @endif

                    <div class="mt-4">
                        {{ $listaCursos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

