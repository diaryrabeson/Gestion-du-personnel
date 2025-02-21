<x-guest-layout class="">

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 conteneur" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="contains">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Se souvenir de Moi') }}</span>
            </label>
        </div>



        <div class="">

            <x-primary-button class="connect">
                {{ __('Se connecter') }}
            </x-primary-button>
        </div>
        <div class="d-flex">
            <div class="registers">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Créer
                        un compte</a>
                @endif
            </div>
            <div>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('password.request') }}">
                        {{ __('Mots de passe oublié') }}
                    </a>
                @endif

            </div>

    </form>
</x-guest-layout>

<style>
    /* .registers a{
    position: absolute;
    left: 34em;
    bottom: 4.6em;
   
    text-decoration: none;
} */
    .d-flex {
        display: flex;
        justify-content: space-between;
        margin-top: 2em;
     

    }
    .d-flex a{
        text-decoration: none;
        color: rgb(41, 41, 66);
        font-weight: 600;
        color: rgb(0, 0, 0);
    }

    .contains {
        height: 26em;

    }

    /* From Uiverse.io by krlozCJ */
    .connect {
        margin-top: 2em;
        width: 100%;
        padding-left: 13em !important;
        border: none;
        outline: none;
        background-color: #227e32;
        padding: 10px 20px;
        font-size: 12px;
        font-weight: 700;
        color: #fff;
        border-radius: 5px;
        transition: all ease 0.1s;
        box-shadow: 0px 5px 0px 0px #a29bfe;
    }

    .connect:active {
        transform: translateY(5px);
        box-shadow: 0px 0px 0px 0px #a29bfe;
    }
</style>