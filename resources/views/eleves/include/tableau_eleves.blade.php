
<style>
.fiche_eleve_div {
    width: 200px;
    height: 100px;
    border-radius: 15px;
    background-color: red;
    margin: 4px;
    color: white;
    padding: 5px;
}
.bloc_rose {
    background-image: linear-gradient(to top, #fdcbf1 0%, #fdcbf1 1%, #e6dee9 100%);
}
.bloc_bleu {
    background-image: linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%);
}
</style>
            
            <div class="wrapper">
                <div class="liste_classe d-flex flex-wrap">
                @foreach ($eleves as $eleve)
                
                <div class="fiche_eleve_div d-flex flex-column {{$eleve->genre == 'F' ? 'bloc_rose' : 'bloc_bleu'}}" data-id="{{$eleve->id}}" data-donnees="{{json_encode($eleve->toArray())}}">
                    

                    <div class="nom_eleve">{{$eleve->nom}} {{$eleve->prenom}}</div>
                    <div class="ddn_eleve">{{Carbon\Carbon::parse($eleve->ddn)->format('d/m/Y')}}</div>
                    <div class="prof_eleve">{{$eleve->lastUser()}}</div>

                </div>
                @endforeach
            </div>
            </div>
            

          