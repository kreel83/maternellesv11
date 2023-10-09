
<style>
.fiche_eleve_div {
    width: 215px;
    height: 80px;
    border-radius: 15px;
    margin: 4px;
    color: white;
    padding: 5px;
    color: grey;
    font-size: 12px;
    position: relative;
    background-color: var(--back-color);
}

.fiche_eleve_div:hover {
    border-radius: 10px;
    border: 1px solid var(--main-color);
    cursor: pointer;
}


.avatar {
    font-size: 40px;
}

.avatar.pink {
    color: lightpink;
}
.avatar.blue {
    color: lightskyblue;
}

.nom_eleve span {
    color : black;
    font-weight: bold
}

.prof_eleve {
    font-size: 10px;
    background-color: red;
    color: white;
    padding: 2px 4px;
    border-radius: 15px;
}

.new_eleve {

    font-size: 12px;
    background-color: #64d06b;
    color: white;
    padding: 2px 16px;
    border-radius: 8px;
    
    width: 20px;
    height: 20px;;
    display: flex;
    font-weight: 700;
    justify-content: center;
    align-items: center;
}

.sh {

    font-size: 12px;
    background-color: #7769FE;
    color: white;
    padding: 2px 16px;
    border-radius: 8px;

    font-weight: 700;
    cursor: pointer;
    width: 20px;
    height: 20px;;
    display: flex;
    justify-content: center;
    align-items: center;

}

.reussite {

    font-size: 10px;
    background-color: #761d6e;
    color: white;
    padding: 2px 16px;
    border-radius: 8px;

    font-weight: 700;
    cursor: pointer;
    width: 20px;
    height: 20px;;
    display: flex;
    justify-content: center;
    align-items: center;

}

.param_eleve {
    display: flex;
}

</style>
            
            <div class="wrapper">
                <div class="liste_classe d-flex flex-wrap tuto_liste_eleve">
                @foreach ($eleves as $key=>$eleve)
                
                <div class="fiche_eleve_div d-flex position-relative {{$key == 0 ? "selection_eleve" : null}}"  data-prof="{{$eleve->lastProfId()}}" data-id="{{$eleve->id}}" data-donnees="{{json_encode($eleve->toArray())}}">


                    <div class="me-2 position-relative">
                        <div class="position-absolute" style="left: 10px; top: 46px; color: {{$eleve->genre == 'F' ? 'pink' : 'var(--blue)'}}">
                            {{ $eleve->psmsgs}}
                        </div>
                        @if ($eleve->genre == 'F')
                        <div class="avatar pink">
                            <i class="fa-thin fa-user-tie-hair-long"></i>
                        </div>
                        @else
                        <div class="avatar blue">
                            <i class="fa-thin fa-user-tie-hair"></i>
                        </div>
                        @endif


                    </div>
                    <div class="d-flex flex-column pt-2">
                        <div class="nom_eleve"><span>{{$eleve->prenom}}</span> {{$eleve->nom}}</div>
                        <div class="ddn_eleve">{{Carbon\Carbon::parse($eleve->ddn)->format('d/m/Y')}}</div>
                        <div class="param_eleve">
                            @if (!$eleve->lastProfId())
                            <div class="new_eleve me-2" style="">
                                N
                             </div>
                            @endif
                            @if ($eleve->sh == 1)
                            <div class="sh me-2" style="">
                                SH
                             </div>
                            @endif
                            @if ($eleve->reussite == 0)
                            <div class="reussite" style="">
                                Inactif
                             </div>
                            @endif
                        </div>
                        {{-- <div class="prof_eleve">{{$eleve->lastUser()}}</div>                        --}}
                    </div>


                </div>
                @endforeach
            </div>
            </div>
            

          