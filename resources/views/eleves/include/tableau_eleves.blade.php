
                <thead>
                <tr>
                    <td></td>
                    <td>nom</td>
                    <td>prénom</td>
                    <td>age</td>
                    <td>genre</td>
                    <td>groupe</td>
                    <td>action</td>


                </tr>
                </thead>
                <tbody>

                    @foreach ($eleves as $eleve)
                        <tr data-id="{{$eleve->id}}" data-commentaire="{{$eleve->comment}}" data-photo="{{asset($eleve->photoEleve)}}">
                            <td style="width: 40px"><img src="{{asset($eleve->photoEleve)}}" alt="" width="40px"></td>
                            <td data-value="{{$eleve->nom}}">{{$eleve->nom}}</td>
                            <td data-value="{{$eleve->prenom}}">{{$eleve->prenom}}</td>
                            <td data-value="{{$eleve->ddn}}">{{Carbon\Carbon::parse($eleve->ddn)->format('d/m/Y')}}</td>
                            <td data-value="{{$eleve->genre}}">{{ $eleve->genre }}</td>
                            <td data-value="{{$eleve->groupe}}">{{$eleve->groupe}}</td>
                            <td> 
                                <button class="btn btn-sm btn-danger remove">retirer</button>
                            </td>


                        </tr>
                    @endforeach
                </tbody>
          