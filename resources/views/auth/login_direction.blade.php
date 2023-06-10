<x-guest-layout>

    <div class="container">
        <div class="card m-auto mt-5 h-auto" style="height: 500px !important">
                <div class="card-body p-2" >

                    <x-auth-session-status class="mb-4" :status="session('status')" />
        
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    
                    <p class="text-center h3">Connexion au compte Direction</p>
        
                    <form method="POST" action="{{ route('storedirection') }}">
                    @csrf
        
                    <!-- Email Address -->
                        <div>
                            <label for="email"  >{{ __('Email') }}</label>
        
                            <input id="email" class=" form-control block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                        </div>
        
                        <!-- Password -->
                        <div class="mt-4">
                            <label for="password"  >{{ __('Mot de passe') }}</label>
        
                            <input id="password" class="form-control block mt-1 w-full"
                                   type="password"
                                   name="password"
                                   required autocomplete="current-password" />
                        </div>
        
                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Se souvenir de moi') }}</span>
                            </label>
                        </div>
        
                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('Mot de passe oublié ?') }}
                                </a>
                            @endif
        
                                <a  href="{{\App\utils\Google::url_connection()}}" class="btn btn-secondary ml-3">
                                    Se connecter avec Google
                                </a>
        
                            <button class="btn btn-primary ml-3">
                                {{ __('Se connecter') }}
                            </button>
                        </div>
                    </form>

                    <p class="mt-3">Pas encore inscrit à notre service ? <a href="/newaccount">Cliquez ici.</a></p>

                </div>
                <x-slot name="logo">
                    <a href="/">
                        <x-application-logo class="w-25 h-25 fill-current text-gray-500" />
                    </a>
                </x-slot>
        
                <!-- Session Status -->
        
            </div>
        
        </div>
        
</x-guest-layout>