

            
            <div class="wrapper">
                <ul class="liste_classe">
                @foreach ($eleves as $eleve)
                <li class="fiche_eleve d-flex w-100" data-id="{{$eleve->id}}" data-donnees="{{json_encode($eleve->toArray())}}">
                    
                    <div class="genre_eleve" style="color: {{$eleve->genre == 'F' ? 'pink' : 'blue'}}">
                        <i class="fa-solid fa-circle"></i>
                    </div>
                    <div class="nom_eleve">{{$eleve->nom}} {{$eleve->prenom}}</div>
                    <div class="ddn_eleve">{{Carbon\Carbon::parse($eleve->ddn)->format('d/m/Y')}}</div>
                    <div class="prof_eleve">{{$eleve->lastUser()}}</div>

                </li>
                @endforeach
                </ul>
            </div>
            

          