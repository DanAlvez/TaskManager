<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-400 leading-tight">
            Tarefas de {{ $category->name }}
        </h2>
    </x-slot>

    {{-- Botão criar nova categoria --}}
    <div class="max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-end">
            <x-secondary-button>
                <a href="{{ route('tasks.create') }}">{{ __('Criar Nova Tarefa') }}</a>
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
                    @if ($tasks->isEmpty())
                        <p class="text-gray-500 dark:text-gray-400">Você não tem tarefas nesta categoria.</p>
                    @else
                        <table class="w-full">
                            <tr class="border-b border-gray-400 dark:border-gray-400">
                                <th class="py-4 px-6 text-left text-xl text-gray-900 dark:text-gray-100">Tarefa</th>
                                <th class="py-4 px-6 text-left text-xl text-gray-900 dark:text-gray-100">Status</th>
                                <th class="py-4 px-6 text-left text-xl text-gray-900 dark:text-gray-100">Prioridade</th>
                                <th class="py-4 px-6 text-right text-2xl text-gray-900 dark:text-gray-100">Ações</th>
                            </tr>
                            @foreach ($tasks as $task)
                                    <tr class="border-b border-gray-200 dark:border-gray-700 mt-12">
                                        <td class="py-4 px-6">
                                            <a class="text-lg font-medium text-gray-900 dark:text-gray-100 flex gap-4" href="{{ route('tasks.show', $task) }}">
                                                <span class="material-symbols-outlined" style="color: #ccc; font-size: 24px; align-self: center;">visibility</span>
                                                {{ $task->title }}
                                            </a>
                                        </td>
                                        <td class="py-4 px-6">
                                            <a class="text-lg font-medium text-gray-900 dark:text-gray-100 flex gap-4" href="{{ route('tasks.show', $task) }}">
                                                @if ($task->status == 'concluida')
                                                    🟢 Concluída
                                                @else
                                                    🟡 Pendente
                                                @endif
                                            </a>
                                        </td>
                                        <td class="py-4 px-6">
                                            <a class="text-lg font-medium text-gray-900 dark:text-gray-100 flex gap-4" href="{{ route('tasks.show', $task) }}">
                                                @if ($task->priority == 'alta')
                                                    🔴 Alta
                                                @elseif ($task->priority == 'media')
                                                    🟠 Média
                                                @else
                                                    🟢 Baixa
                                                @endif
                                            </a>
                                        </td>
                                        <td class="float-right text-right flex space-x-2 justify-end py-4 px-6">
                                            {{-- Botões de ação --}}
                                            <a href="{{ route('tasks.show', $task) }}" class="">
                                                <x-secondary-button class="flex gap-2">
                                                    <span class="material-symbols-outlined" style="color: #ccc; font-size: 16px; align-self: center;">visibility</span>
                                                    {{ __('Ver Tarefa') }}
                                                </x-secondary-button>
                                                </a>
                                            <a href="{{ route('tasks.edit', $task) }}" class="">
                                                <x-secondary-button class="flex gap-2">
                                                <span class="material-symbols-outlined" style="color: #ccc; font-size: 16px; align-self: center;">edit</span>
                                                {{ __('Editar') }}
                                                </x-secondary-button>
                                            </a>
                                            <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-task-deletion-{{ $task->id }}')" class="flex gap-2">
                                                <span class="material-symbols-outlined" style="color: #ccc; font-size: 16px; align-self: center;">delete</span>
                                                {{ __('Excluir') }}
                                            </x-danger-button>

                                            <x-modal name="confirm-task-deletion-{{ $task->id }}" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                                <form method="post" action="{{ route('tasks.destroy', $task) }}" class="p-6">
                                                    @csrf
                                                    @method('delete')

                                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                        {{ __('Você realmente deseja deletar esta tarefa?') }}
                                                    </h2>
                                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                        {{ __('Após a exclusão desta tarefa, todos os seus recursos e dados serão excluídos permanentemente. Antes de excluir sua tarefa, baixe todos os dados ou informações que deseja manter.') }}
                                                    </p>

                                                    <div class="mt-6">
                                                        <x-secondary-button x-on:click="$dispatch('close')">
                                                            {{ __('Cancelar') }}
                                                        </x-secondary-button>

                                                        <x-danger-button type="submit" class="ml-3">
                                                            {{ __('Excluir Tarefa') }}
                                                        </x-danger-button>
                                                    </div>
                                                </form>
                                            </x-modal>
                                        </td>
                                    </tr>
                            @endforeach
                            {{-- Paginação --}}
                            @if ($tasks->hasPages())
                                <tr>
                                    <td colspan="4" class="py-4 px-6">
                                        {{ $tasks->links() }}
                                    </td>
                                </tr>
                            @endif
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>