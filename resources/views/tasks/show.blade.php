<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-400 leading-tight">
            Tarefa {{ $task->title }}
        </h2>
    </x-slot>

    {{-- Botão criar nova categoria --}}
    <div class="max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-end">
            <x-secondary-button>
                <a href="{{ route('tasks.index') }}">{{ __('Suas Tarefas') }}</a>
            </x-secondary-button>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="infotask grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="w-full">
                        <section class="space-y-6">
                            <header class="space-y-1 pb-4">
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Finalidade da Tarefa') }}
                                </h2>
    
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __("Veja a finalidade da tarefa.") }}
                                </p>
                            </header>
                            
                            <div class="title">
                                <h2 class="text-md font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Título:') }}
                                </h2>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ $task->title }}
                                </p>
                            </div>
    
                            <div class="description">
                                <h2 class="text-md font-medium text-gray-900 dark:text-gray-100 mt-4">
                                    {{ __('Descrição:') }}
                                </h2>
                                @if ($task->description == null)
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Sem descrição</p>
                                @endif
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ $task->description }}
                                </p>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="w-full">
                        <section class="space-y-6">
                            <header class="space-y-1 pb-4">
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Detalhes da Tarefa') }}
                                </h2>
    
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __("Veja os detalhes da tarefa.") }}
                                </p>
                            </header>
                            
                            <div class="due_date">
                                @if ($task->due_date == null)
                                    <h2 class="text-md font-medium text-gray-900 dark:text-gray-100 mt-4">
                                        {{ __('Data de vencimento:') }}
                                    </h2>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        Sem data de vencimento.
                                    </p>
                                @else
                                    @if ($task->due_date < now() && $task->status != 'concluida')
                                        <h2 class="text-lg font-medium text-red-600 dark:text-red-400">
                                            {{ __('Atenção: Esta tarefa está atrasada!') }}
                                        </h2>
                                    @endif
                                    <h2 class="text-md font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Data de vencimento:') }}
                                    </h2>
    
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ date('d/m/Y', strtotime($task->due_date)) }}
                                    </p>
                                @endif
                            </div>
    
                            <div class="category">
                                <h2 class="text-md font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Categoria:') }}
                                </h2>
                                @if ($task->category == null)
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Sem categoria</p>
                                @else
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $task->category->name }}
                                    </p>
                                @endif
                            </div>
                        </section>
                    </div>
                </div>
    
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="w-full">
                        <section class="space-y-6">
                            <div class="status">
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mt-4">
                                    {{ __('Status:') }}
                                </h2>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    @if ($task->status == 'concluida')
                                        🟢 Concluída
                                    @else
                                        🟡 Pendente
                                    @endif
                                </p>
                            </div>
    
                            <div class="priority">
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mt-4">
                                    {{ __('Prioridade:') }}
                                </h2>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    @if ($task->priority == 'alta')
                                        🔴 Alta
                                    @elseif ($task->priority == 'media')
                                        🟠 Média
                                    @else
                                        🟢 Baixa
                                    @endif
                                </p>
                            </div>

                            <div class="label">
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mt-4">
                                    {{ __('Etiqueta:') }}
                                </h2>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    Sem etiqueta ainda.
                                </p>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
