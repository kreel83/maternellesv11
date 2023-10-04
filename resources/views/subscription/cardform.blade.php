@extends('layouts.mainMenu2', ['titre' => 'Abonnement', 'menu' => 'souscrire'])

@section('content')

<div class="container mt-5">

{{-- 
    Lien vers cartes de test
    https://stripe.com/docs/testing?locale=fr-FR&testing-method=card-numbers
--}}        

@if(Auth::user()->subscribed('default'))

    <p>Vous avez déjà un abonnement en cours.</p>

@else

    <div id="achatLicences">

        {{--<input id="prixLicence" type="hidden" value="{{ $product->price }}">--}}

        <div class="row">
            <div class="col text-center">
                <p class="h4 mb-0">Achat d'une licence</p>
                <p class="mb-0"><span class="fw-bold">Service :</span><span class="c-green"> {{ $product->name }}</span></p>
                <p class="mb-0">
                    <span class="fw-bold">Prix de la licence :</span>
                    <span class="c-green">{{ number_format($product->price,2) }} €</span>
                </p>
                {{--
                <p>Nombre de licences souhaitées<br />
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button id="btnRemoveLicence" type="button" class="btn btn-primary fw-bold fs-5">-</button>
                    <input id="quantite" name="quantite" type="number" min="1" step="1" value="1" size="5" class="text-center fw-bold fs-5">
                    <button id="btnAddLicence" type="button" class="btn btn-primary fw-bold fs-5">+</button>
                </div>
                </p>
                <p class="mb-0">
                    <span class="fw-bold">Total :</span>
                    <span class="c-green"><span id="totalPrice">9,90</span> €</span>
                </p>
                --}}
            </div>
        </div>

        <!--
        <div class="col-12 mt-4">
            <div class="formcard p-3">
                <p class="mb-0 fw-bold h4">Règlement par carte bancaire</p>
            </div>
        </div>
        -->

        <div class="accordion mt-4" id="paymentMethods">
            <div class="accordion-item mb-2">
            <h2 class="accordion-header">
                <button class="title accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Règlement par carte bancaire
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#paymentMethods"><!-- show -->
                <div class="accordion-body">

                    <form class="subscription" id="payment-form" action="{{ route('subscribe.create') }}" method="POST">
                    @csrf
                        <div class="row">
                            <!--
                            <div class="col-lg-5 mb-lg-0 mb-3">
                                <p class="h4 mb-0">Résumé</p>
                                <p class="mb-0"><span class="fw-bold">Service :</span><span class="c-green"> abonnement 1 an au service Les Maternelles</span>
                                </p>
                                <p class="mb-0">
                                    <span class="fw-bold">Prix :</span>
                                    <span class="c-green">9,90 €</span>
                                </p>
                                <p class="mb-0">Abonnement résiliable à tout moment.</p>
                            </div>
                        -->
                            <div class="col-lg-7">

                                <div class="row">
                                    <!--<div class="col-xl-4 col-lg-4">-->
                                    <div>
                                        <div class="form-group">
                                            <label class="pb-1" for="">Nom</label>
                                            <input type="text" name="name" id="card-holder-name" class="form-control" value="" placeholder="Nom du détenteur de la carte">
                                        </div>
                                    </div>
                                </div>
            
                                <div class="row mt-3">
                                    <!--<div class="col-xl-4 col-lg-4">-->
                                    <div>
                                        <div class="form-group">
                                            <label class="pb-1" for="">Détails de la carte</label>
                                            <div id="card-element"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-primary" id="card-button" data-secret="{{ $intent->client_secret }}">Souscrire mon abonnement</button>
                                </div>

                            </div>
                                
                            <div class="mt-4">
                                Paiement sécurisé via <i>Stripe</i><br>
                                <img src="{{ asset('/img/licence/visa.png') }}" height="25"> 
                                <img src="{{ asset('/img/licence/mc.png') }}" height="25">
                            </div>

                            </div>                        
                        </div>
                    </form>

                </div>
            </div>
            </div>

            {{--
            <div class="accordion-item mb-2">
            <h2 class="accordion-header">
                <button class="title accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                PayPal
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#paymentMethods">
                <div class="accordion-body">
                    <div class="row">
                        <div class="col-lg-5 mb-lg-0 mb-3">
                            <p class="h4 mb-0">Résumé</p>
                            <p class="mb-0"><span class="fw-bold">Service :</span><span class="c-green"> abonnement 1 an au service Les Maternelles</span>
                            </p>
                            <p class="mb-0">
                                <span class="fw-bold">Prix :</span>
                                <span class="c-green">9,90 €</span>
                            </p>
                            <p class="mb-0">Abonnement résiliable à tout moment.</p>
                        </div>
                        <div class="col-lg-7">

                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-primary" id="paypal-button">Payer avec PayPal</button>
                            </div>

                        </div>                        
                    </div>
                </div>
            </div>
            </div>

            <div class="accordion-item mb-2">
            <h2 class="accordion-header">
                <button class="title accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Chèque bancaire
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#paymentMethods">
                <div class="accordion-body">
                    <p>Etablissez un chèque d'un montant de 9,90 € à l'ordre de : <strong>Les Maternelles</strong></p>
                    <p>Envoyez le à l'adresse suivante :</p>
                    <p><strong>Les Maternelles, 75 Bd de Strasbourg, 83000 Toulon.</strong></p>
                    <p>A réception votre abonnement sera activé dans les plus brefs délais.</p>                
                </div>
            </div>
            </div>

            <div class="accordion-item mb-2">
                <h2 class="accordion-header">
                    <button class="title accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Virement bancaire
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#paymentMethods">
                    <div class="accordion-body">
                        <h3>Nos coordonnées bancaires pour effectuer un virement</h3>
                        <p>Important : Précisez votre numéro de commande/devis en libellé de l’opération</p>
                        
                        <p>
                        Titulaire du compte : Les Maternelles<br>
                        IBAN : FRXX XXXX XXXX XXXX XXXX XXXX XXX<br>
                        BIC (virement SWIFT) : XXXXXXXXXXX
                        </p>

                        <p>Notre compte en Euros (EUR) étant domicilié en France, nos clients utilisant un compte hors de la zone euro sont invités à établir un virement international.</p>
                        <p>A réception votre abonnement sera activé dans les plus brefs délais.</p>                
                    </div>
                </div>
            </div>
            --}}

        </div>

    </div>
    
@endif

</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ env('STRIPE_KEY') }}')
   
   const elements = stripe.elements()
   const cardElement = elements.create('card')
  
   cardElement.mount('#card-element')
  
   const form = document.getElementById('payment-form')
   const cardBtn = document.getElementById('card-button')
   const cardHolderName = document.getElementById('card-holder-name')
  
   form.addEventListener('submit', async (e) => {
       e.preventDefault()
  
       cardBtn.disabled = true
       const { setupIntent, error } = await stripe.confirmCardSetup(
           cardBtn.dataset.secret, {
               payment_method: {
                   card: cardElement,
                   billing_details: {
                       name: cardHolderName.value
                   }   
               }
           }
       )

       if(error) {
           cardBtn.disabled = false
       } else {
           let token = document.createElement('input')
           token.setAttribute('type', 'hidden')
           token.setAttribute('name', 'token')
           token.setAttribute('value', setupIntent.payment_method)
           form.appendChild(token)
           form.submit();
       }
   })
</script>

@endsection
