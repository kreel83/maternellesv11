<style>
    .page-break {
        page-break-after: always;
    }
    h1 {
        text-align: center;
    }
    hr {
        margin: 120px
    }
</style>

@foreach($enfants as $key=>$enfant)
    <div>
        @if ($key % 2 == 1)
            <div class="page-break">

        @endif
                <p>Bonjour</p>
                <p>
                    Voici le mot de passe qui vous permettra d'acceder au cahier de progrès <br>
                    de votre enfant {{$enfant->prenom }} {{$enfant->nom }}

                </p>
                <p>
                    Je vous avertirez par mail quand le pdf sera disponible, ainsi que le lien qui vous permettra de télécharger la cahier de progères
                </p>
                <p>Ce dernier devra être imprimer, signé et remis à la maîtresse.</p>
                <p>Merci</p>
                <br>
                <h1>{{$enfant->mdp }}</h1>


        @if ($key % 2 == 1)
            </div>
            @else
            <hr>
            <br><br><br>
        @endif
    </div>
@endforeach
