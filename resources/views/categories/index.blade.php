<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-400 leading-tight">
            {{ __('Suas Categorias') }}
        </h2>
    </x-slot>

    {{-- Botão criar nova categoria --}}
    <div class="max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-end">
            <x-secondary-button>
                <a href="{{ route('categories.create') }}">{{ __('Criar Nova Categoria') }}</a>
            </x-secondary-button>
        </div>
    </div>

    @if (session('sucess'))
        <div class="max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Seção --}}
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="w-full">
                    @if ($categories->isEmpty())
                        <p class="text-gray-500 dark:text-gray-400">Você ainda não criou nenhuma categoria.</p>
                    @else
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[600px]">
                            <tr class="border-b border-gray-400 dark:border-gray-400">
                                <th class="py-4 px-6 text-left text-xl text-gray-900 dark:text-gray-100">Categorias</th>
                                <th class="py-4 px-6 text-right text-2xl text-gray-900 dark:text-gray-100">Ações</th>
                            </tr>
                            @foreach ($categories as $category)
                                <tr class="border-b border-gray-200 dark:border-gray-700 mt-12">
                                    <td class="py-4 px-6 whitespace-nowrap">
                                        <a class="text-lg items-center font-medium text-gray-900 dark:text-gray-100 flex gap-4" href="{{ route('categories.show', $category) }}">
                                            <span class="inline-block w-3 h-3 rounded-full" style="background-color: {{ $category->color }};"></span>
                                            <span class="material-symbols-outlined" style="color: #ccc; font-size: 24px; align-self: center;">visibility</span>
                                            {{ $category->name }}
                                        </a>
                                    </td>
                                    <td class="float-right text-right flex whitespace-nowrap space-x-2 justify-end py-4 px-6">
                                        {{-- Botões de ação --}}
                                        <a href="{{ route('categories.show', $category) }}">
                                            <x-secondary-button class="flex gap-2">
                                                <span class="material-symbols-outlined" style="color: #ccc; font-size: 16px; align-self: center;">visibility</span>
                                                {{ __('Ver Tarefas') }}
                                            </x-secondary-button>
                                        </a>
                                        <a href="{{ route('categories.edit', $category) }}">
                                            <x-secondary-button class="flex gap-2">
                                                <span class="material-symbols-outlined" style="color: #ccc; font-size: 16px; align-self: center;">edit</span>
                                                {{ __('Editar') }}
                                            </x-secondary-button>
                                        </a>
                                        <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-category-deletion-{{ $category->id }}')" class="flex gap-2">
                                            <span class="material-symbols-outlined" style="color: #ccc; font-size: 16px; align-self: center;">delete</span>
                                            {{ __('Excluir') }}
                                        </x-danger-button>
                                        
                                        <x-modal name="confirm-category-deletion-{{ $category->id }}" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                            <form method="post" action="{{ route('categories.destroy', $category) }}" class="p-6">
                                                @csrf
                                                @method('delete')
                                                
                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                    {{ __('Você realmente deseja deletar esta categoria?') }}
                                                </h2>
                                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                    {{ __('Após a exclusão desta categoria, todas as tarefas associadas a ela também serão excluídas permanentemente. Antes de excluir esta categoria, certifique-se de que não há tarefas importantes associadas a ela.') }}
                                                </p>
                                                
                                                <div class="mt-6">
                                                    <x-secondary-button x-on:click="$dispatch('close')">
                                                        {{ __('Cancelar') }}
                                                    </x-secondary-button>

                                                    <x-danger-button type="submit" class="ml-3">
                                                        {{ __('Excluir Categoria') }}
                                                    </x-danger-button>
                                                </div>
                                            </form>
                                        </x-modal>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        @endif
                    </div>
                    {{-- Paginação --}}
                    @if ($categories->hasPages())
                        <div class="mt-2">
                            <div colspan="4" class="py-4 px-6">
                                {{ $categories->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>