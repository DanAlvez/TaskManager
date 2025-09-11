<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Atualizar Senha') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Certifique-se de que sua conta esteja usando uma senha longa e aleatória para permanecer segura.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Senha Atual:')" />
            
            <div class="relative">
                <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                            {{-- Visibility Toggle --}}
                <span class="material-symbols-outlined absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer togglePassword" id="togglePassword" onclick="togglePasswordVisibility()">
                    visibility
                </span>
            </div>
            <script>
                function togglePasswordVisibility() {
                    const passwordInput = document.getElementById('update_password_current_password');
                    const toggleIcon = document.getElementById('togglePassword');
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        toggleIcon.textContent = 'visibility_off';
                    } else {
                        passwordInput.type = 'password';
                        toggleIcon.textContent = 'visibility';
                    }
                }
            </script>
            <style>
                .togglePassword {
                    font-size: 24px;
                    user-select: none;
                    color: #ccc;
                }
            </style>
            
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Nova Senha:')" />

            <div class="relative">
                <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                            {{-- Visibility Toggle --}}
                <span class="material-symbols-outlined absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer togglePassword" id="togglePasswordTwo" onclick="togglePasswordVisibilityTwo()">
                    visibility
                </span>
            </div>
            <script>
                function togglePasswordVisibilityTwo() {
                    const passwordInput = document.getElementById('update_password_password');
                    const toggleIcon = document.getElementById('togglePasswordTwo');
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        toggleIcon.textContent = 'visibility_off';
                    } else {
                        passwordInput.type = 'password';
                        toggleIcon.textContent = 'visibility';
                    }
                }
            </script>

            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmar Nova Senha:')" />

            <div class="relative">
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                <span class="material-symbols-outlined absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer togglePassword" id="togglePasswordThree" onclick="togglePasswordVisibilityThree()">
                    visibility
                </span>
            </div>
            <script>
                function togglePasswordVisibilityThree() {
                    const passwordInput = document.getElementById('update_password_password_confirmation');
                    const toggleIcon = document.getElementById('togglePasswordThree');
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        toggleIcon.textContent = 'visibility_off';
                    } else {
                        passwordInput.type = 'password';
                        toggleIcon.textContent = 'visibility';
                    }
                }
            </script>

            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Salvar') }}</x-primary-button>

            @if (session('status') === 'password-updated')
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
