<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('Nom')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mots de passe')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmation du mots de pass')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

 <!-- role  -->
        <div class="mt-4 nones" >
            <x-input-label for="" />

            <x-text-input id="role" class="block mt-1 w-full"
                            type="text"
                            name="role" value="client" hidden />

        </div>


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Déjà inscri') }}
            </a>

            {{-- <x-primary-button class="ml-4">
                {{ __('Inscrire') }}
            </x-primary-button> --}}

            <x-primary-button id="registerBtn" class="ml-4">
                <span id="registerText">Inscrire</span>
                <img src="{{ asset('img/Loading.gif') }}" id="registerSpinner" alt="Chargement..."
                     style="display: none; width: auto; margin-left: -21em; position: absolute; margin-top: -29em;">
            </x-primary-button>
            
        </div>
    </form>
</x-guest-layout>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form'); // adapte si tu as plusieurs formulaires
        const registerSpinner = document.getElementById('registerSpinner');

        form.addEventListener('submit', function () {
            registerSpinner.style.display = 'inline-block'; // Affiche le loader à droite du bouton
        });
    });
</script>


<style>
    .nones{
        display: none;
    }
</style>