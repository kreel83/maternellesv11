<x-guest-layout>
    

    <div class="container">
        
        <div class="card m-auto mt-5 h-auto" style="height: 600px !important">
            <div class="card-body " >
      
                      <p class="text-center h1">Enregistrement</p>
    
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
    
                            <div class="row mt-5 mb-3">
    
                                <!-- nom -->
                                <div class="col">
                                    <!--<label for="name" class="form-label">{{ __('Nom') }}</label>-->
                                    <input placeholder="{{ __('Nom') }}" id="name" class="form-control block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required autofocus />
                                </div>
                            
                                <!-- prenom -->
                                <div class="col">
                                    <!--<label for="firstname" class="form-label">{{ __('Prénom') }}</label>-->
                                    <input placeholder="{{ __('Prénom') }}" id="prenom" class="form-control block mt-1 w-full" type="text" name="prenom" value="{{ old('prenom') }}" required autofocus />
                                </div>
    
                            </div>
    
                            <!-- email -->
                            <div class="mb-3">
                                <!--<label for="email" class="form-label">{{ __('Email') }}</label>-->
                                <input placeholder="{{ __('Email') }}" id="email" class="form-control block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required />
                            </div>
    
                            <!-- password -->
                            <div class="mb-3">
                                <!--<label for="password" class="form-label">{{ __('Mot de passe') }}</label>-->
                                <input placeholder="{{ __('Mot de passe') }}" id="password" class="form-control block mt-1 w-full"
                                                type="password"
                                                name="password"
                                                required autocomplete="new-password" />
                            </div>
    
                            <!-- confirm password -->
                            <div class="mb-3">
                                <!--<label for="password_confirmation" class="form-label">{{ __('Confirmer le mot de passe') }}</label>-->
                                <input placeholder="{{ __('Confirmer le mot de passe') }}" id="password_confirmation" class="form-control block mt-1 w-full"
                                                type="password"
                                                name="password_confirmation" required />
                            </div>
    
                            <div class="form-check d-flex justify-content-center mb-3">
                                <input class="form-check-input me-2" type="checkbox" value="" id="agree" required />
                                <label class="form-check-label" for="agree">
                                  J'accepte les <a href="#voirConditions" data-bs-toggle="modal">conditions générales d'utilisation.</a>
                                </label>
                            </div>
    
                            <div class="text-center">
                                <button class="btn btn-primary ml-3">
                                    {{ __('Créer le compte') }}
                                </button>
                            </div>
    
                            <div class="flex text-center items-center justify-end mt-4">
                                {{__('Vous avez déjà un compte ?') }}
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                    {{ __('Identifiez vous') }}
                                </a>
                                
                            </div>
                        </form>
    
                    </div>
                </div>
            </div>        
        </div>
    
        <div class="modal" id="voirConditions" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Conditions générales d'utilisation</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>Voici les conditions d'utilisation du service <strong>Les Maternelles</strong> :</p>
                    <p>...</p>
                  </p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
                </div>
              </div>
            </div>
          </div>
      
    
    </x-guest-layout>    