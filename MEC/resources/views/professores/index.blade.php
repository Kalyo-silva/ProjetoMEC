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

                        <div class="flex gap-1 items-center">
                            <x-uni-university-o class="size-6 text-gray-400" />
                            <h2 class='text-xl border-b-2 border-indigo-400 font-bold'>Lista de Professores</h2>
                        </div>
                        <div class="linkButton">
                            <x-fas-plus class="size-6" />
                            <a href="{{ route('mantenedores.create') }}">Novo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>