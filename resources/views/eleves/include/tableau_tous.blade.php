<div class="wrapper">

    <table style="font-size: 12px" class="table table-bordered table-hover">
        
        <tbody>
            
            @foreach ($tous as $eleve)


                <tr data-prof="{{$eleve->user_n1_id}}" data-id="{{$eleve->id}}" data-commentaire="{{$eleve->comment}}" data-photo="{{asset($eleve->photoEleve)}}" {{ ( ($professeur== 'null') || ($prof == $eleve->user_n1_id)) ?  null : 'd-none' }}>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" >
                        </div>
                    </td>
                    <td data-value="{{$eleve->nom}}">{{$eleve->nom}} {{$eleve->prenom}}</td>
                    <td data-value="{{$eleve->ddn}}">{{Carbon\Carbon::parse($eleve->ddn)->format('d/m/Y')}}</td>
                    <td data-value="{{$eleve->genre}}" style="color: {{$eleve->genre == 'F' ? 'pink' : 'blue'}}"><i class="fa-solid fa-circle"></i></td>
                    
                    
                </tr>
            @endforeach
            
        </tbody>
    </table>
    <button class="custom_button" id="ajouterEleves" ><i class="fa-light fa-left me-2"></i>Ajouter à ma classe</button>
</div>
