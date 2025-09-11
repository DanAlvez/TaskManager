<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-white">
            👤 {{ __('Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="sm:w-full flex gap-12 max-sm:flex-col p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="w-full">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="sm:w-full">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Foto de Perfil') }}
                            </h2>
    
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Adicione ou atualize sua foto de perfil.") }}
                            </p>
                        </header>
    
                        <form method="post" action="{{ route('profile.updatePhoto') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
    
                            <div>
                                @if ($user->photo)
                                    <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" class="w-20 h-20 rounded-full object-cover mb-4">
                                @endif
                                <x-input-label for="photo" :value="__('Foto:')" />
                                <input type="file" name="photo" id="photo" class="mt-1 p-4 block  w-full border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"/>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">JPG, PNG ou JPEG de no m&aacute;ximo 5MB</p>
                                <x-input-error class="mt-2" :messages="$errors->get('photo')" />
                            </div>
    
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Salvar') }}</x-primary-button>
    
                                @if (session('status') === 'profile-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400"
                                    >{{ __('Salvo.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
