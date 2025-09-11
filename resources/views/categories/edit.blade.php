<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-white">
            ✏ Editar a Categoria {{ $category->name }}
        </h2>
    </x-slot>

    {{-- Botão voltar a listagem --}}
    <div class="max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-end">
            <x-secondary-button>
                <a href="{{ route('categories.index') }}">{{ __('Voltar') }}</a>
            </x-secondary-button>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Seção --}}
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('categories.update', $category) }}">
                        @csrf
                        @method('PUT')
                        <header class="mb-4">
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ $category->name }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Preencha o formulário abaixo para editar a categoria.") }}
                            </p>
                        </header>


                        <!-- Nome -->
                        <div>
                            <x-input-label for="name" :value="__('Novo Nome da Categoria')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $category->name }}" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        {{-- Tag --}}

                        <div class="mt-4">
                            <x-input-label for="color" :value="__('Etiqueta da Categoria')" />
                            <x-text-input id="color" class="block mt-1 w-full" type="color" name="color" :value="old('color', '#ff0000')" required />
                            <x-input-error :messages="$errors->get('color')" class="mt-2" />
                        </div>                        
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Atualizar Categoria') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>