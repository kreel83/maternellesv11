
<style>
.fiche_eleve_div {
    width: 200px;
    height: 80px;
    border-radius: 15px;
    margin: 4px;
    color: white;
    padding: 5px;
    color: grey;
    font-size: 12px;
}

.fiche_eleve_div:hover {
    border-radius: 10px;
    border: 1px solid #6759FF;
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
    top: -5px; left: 5px;
    font-size: 18px;
    color: purple;
    cursor: pointer;
    width: 20px;
    height: 20px;;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
}

</style>
            
            <div class="wrapper">
                <div class="liste_classe d-flex flex-wrap">
                @foreach ($eleves as $eleve)
                
                <div class="fiche_eleve_div d-flex position-relative"  data-prof="{{$eleve->lastProfId()}}" data-id="{{$eleve->id}}" data-donnees="{{json_encode($eleve->toArray())}}">
                    @if (!$eleve->lastProfId())
                    <div class="position-relative new_eleve" style="">
                        N
                     </div>
                     @endif

                    <div class="me-2">
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
                        {{-- <div class="prof_eleve">{{$eleve->lastUser()}}</div>                        --}}
                    </div>


                </div>
                @endforeach
            </div>
            </div>
            

          