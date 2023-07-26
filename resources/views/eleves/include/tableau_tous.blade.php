<div class="wrapper">

    <table style="font-size: 12px" class="table table-cours">
        
        <tbody>
            
            @foreach ($tous as $eleve)



                <tr data-prof="{{$eleve->user_n1_id}}" data-id="{{$eleve->id}}" data-commentaire="{{$eleve->comment}}" data-photo="{{asset($eleve->photoEleve)}}" {{ ( ($professeur== 'null') || ($prof == $eleve->user_n1_id)) ?  null : 'd-none' }}>
                    <td data-value="{{$eleve->genre}}" style="color: {{$eleve->genre == 'F' ? 'pink' : 'blue'}}">
                        <div class="form-check">
                            @if ($eleve->genre == 'F')
                                <i class="fa-thin fa-user-tie-hair-long pink fs-5 pt-1"></i>
                                @else
                                <i class="fa-thin fa-user-tie-hair blue fs-5 blue pt-1"></i>

                            @endif
                            <input class="form-check-input d-none" type="checkbox" value="" >
                        </div>
                    </td>
                    <td data-value="{{$eleve->nom}}">{{$eleve->nom}} {{$eleve->prenom}}</td>
                    <td data-value="{{$eleve->ddn}}">{{Carbon\Carbon::parse($eleve->ddn)->format('d/m/Y')}}</td>
                    <td data-value="{{$eleve->ddn}}">
                        <div class="custom-badge">{{$eleve->lastUser(true)}}</div>
                    </td>
                   
                    
                    
                </tr>
            @endforeach
            
        </tbody>
    </table>
    <button class="custom_button" id="ajouterEleves" ><i class="fa-light fa-left me-2"></i>Ajouter à ma classe</button>
</div>
