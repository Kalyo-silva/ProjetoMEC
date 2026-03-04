<div class="flex w-full h-full bg-black fixed top-0 left-0 bg-opacity-40 p-4"> <!-- dark Bg -->
    <div class="flex flex-col w-full h-full bg-white rounded shadow-lg">
        <header class="w-full h-fit border-b px-4 py-2 flex justify-between items-center">
            <p class="text-gray-500">Gerenciador de Arquivos</p>
            <x-eva-close-outline class='size-6 fill-gray-400 cursor-pointer' onclick="closeModal('')"/>
        </header>
        <div class="flex w-full h-full">
            <aside class="w-2/12 border-r flex flex-col">
                <div class="h-1/2">
                    <nav class="w-full px-4 py-2">
                        <p class="text-sm text-gray-500">Recentemente Adicionados</p>
                    </nav>
                </div>
                <div class="h-1/2 border-t">
                    <nav class="w-full px-4 py-2">
                        <p class="text-sm text-gray-500">Links</p>
                    </nav>
                </div>
            </aside>
            <main class="w-8/12 flex flex-col">
                <section class="h-4/5">
                    <nav class="w-full px-4 py-2 flex justify-between">
                        <p class="text-sm text-gray-500">Meus Arquivos</p>
                    </nav>
                </section>
                <section class="border-t h-1/5">
                    <nav class="w-full px-4 py-2">
                        <p class="text-sm text-gray-500">Textos</p>
                    </nav>
                </section>
            </main>
            <aside class="w-2/12 border-l">
                <nav class="w-full px-4 py-2">
                    <p class="text-sm text-gray-500">Detalhes</p>
                </nav>
            </aside>
        </div>
    </div>
</div>