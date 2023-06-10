<table class="table table-bordered table-hover table-striped mt-5"  id="tableau_tous">
                <thead>
                <tr>
                    <td>
                    <input class="form-check-input" type="checkbox" value="" id="allSelectEleve">

                    </td>
                    <td></td>
                    <td>nom</td>
                    <td>prénom</td>
                    <td>age</td>
                    <td>genre</td>
                </tr>
                </thead>
                <tbody>

                    @foreach ($tous as $eleve)
                        @php
                     
                        @endphp

                        <tr data-prof="{{$eleve->user_n1_id}}" data-id="{{$eleve->id}}" data-commentaire="{{$eleve->comment}}" data-photo="{{asset($eleve->photoEleve)}}" {{ ( ($professeur== 'null') || ($prof == $eleve->user_n1_id)) ?  null : 'd-none' }}>
                            <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" >
                            </div>
                            </td>
                            <td style="width: 40px"><img src="{{asset($eleve->photoEleve)}}" alt="" width="40px"></td>
                            <td data-value="{{$eleve->nom}}">{{$eleve->nom}}</td>
                            <td data-value="{{$eleve->prenom}}">{{$eleve->prenom}}</td>
                            <td data-value="{{$eleve->ddn}}">{{Carbon\Carbon::parse($eleve->ddn)->format('d/m/Y')}}</td>
                            <td data-value="{{$eleve->genre}}">{{ $eleve->genre }}</td>
                            

                        </tr>
                    @endforeach
                </tbody>
            </table>
