<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-white">
            ➕ {{ __('Criar Nova Tarefa') }}
        </h2>
    </x-slot>

    {{-- Botão voltar a listagem --}}
    <div class="max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-end">
            <x-secondary-button>
                <a href="{{ route('tasks.index') }}">{{ __('Suas Tarefas') }}</a>
            </x-secondary-button>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Seção --}}
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="w-full">
                    <form method="POST" action="{{ route('tasks.store') }}">
                        @csrf
                        <header class="mb-4">
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Criação de Nova Tarefa') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Preencha o formulário abaixo para criar uma nova tarefa.") }}
                            </p>
                        </header>


                        <div class="grid grid-cols-2 max-sm:grid-cols-1 w-full gap-4">
                            <!-- Nome -->
                            <div class="mt-4">
                                <x-input-label for="name" :value="__('Nome da Tarefa')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
    
                            
                            <!-- Data de Vencimento -->
                            <div class="mt-4">
                                <x-input-label for="due_date" :value="__('Data de Vencimento')" />
                                <x-text-input id="due_date" class="block mt-1 w-full" type="date" name="due_date" :value="old('due_date')" />
                                <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                            </div>
    
                            {{-- Nível de Prioridade --}}
                            <div class="mt-4">
                                <x-input-label for="priority" :value="__('Nível de Prioridade')" />
                                <select id="priority" name="priority" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="Baixa" {{ old('priority') == 'Baixa' ? 'selected' : '' }}>Baixa</option>
                                    <option value="Média" {{ old('priority') == 'Média' ? 'selected' : '' }}>Média</option>
                                    <option value="Alta" {{ old('priority') == 'Alta' ? 'selected' : '' }}>Alta</option>
                                </select>
                                <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                            </div>
    
                            {{-- Status --}}
                            <div class="mt-4">
                                <x-input-label for="status" :value="__('Status da Tarefa')" />
                                <select id="status" name="status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="Pendente" {{ old('status') == 'Pendente' ? 'selected' : '' }}>🟡 Pendente</option>
                                    <option value="Concluída" {{ old('status') == 'Concluída' ? 'selected' : '' }}>🟢 Concluída</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>

                            {{-- Categoria --}}
                            @if ($categories->isEmpty())
                                <div class="mt-4">
                                    <x-input-label for="category_id" :value="__('Categoria')" />
                                    <select disabled="category_id" name="category_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                        <option value="">Você não tem categorias.</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                                </div>
                            @else
                                <div class="mt-4">
                                    <x-input-label for="category_id" :value="__('Categoria')" />
                                    <select id="category_id" name="category_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                        <option value="">Nenhuma Categoria</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                                </div>
                            @endif

                            <!-- Descrição -->
                            <div class="mt-4">
                                <x-input-label for="description" :value="__('Descrição da Tarefa')" />
                                <textarea id="description" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="5" type="text" name="description" :value="old('description')"></textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Criar Tarefa') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>