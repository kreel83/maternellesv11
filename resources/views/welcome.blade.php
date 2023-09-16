@extends('layouts.mainMenu', ['titre' => 'Bienvenue', 'menu' => 'accueil'])

@section('content')

@php
$degrades = App\Models\Enfant::DEGRADE;
$lesgroupes = json_decode(Auth::user()->groupes, true);
@endphp

<style>
.parent {
display: grid;
grid-template-columns: repeat(3, 1fr);
grid-template-rows: 300px 320px 430px;
grid-gap: 30px;
}

.div1 { 
    grid-column: 1;
    grid-row: 1; 
}
.div2 { 
    grid-column: 2;
    grid-row: 1; 
}
.div3 { 
    grid-column: 3;
    grid-row: 1; 
}
.div4 { 
    grid-column: 1;
    grid-row: 2; 
}
.div5 { 
    grid-column: 2;
    grid-row: 2; 
}
.div6 { 
    grid-column: 3;
    grid-row: 2; 
}
.div7 { 
    grid-column: 1/4;
    grid-row: 3; 
    height: fit-content;
}


.cadre_welcome {
    /* //border: 1px solid grey; */
    border-radius: 14px;
    padding: 15px 8px 8px 8px;
    position: relative;
    font-size: 14px;
    background-color: white;
    color: grey;
    
}
.titre_welcome {
    margin-bottom: 20px;
    color: var(--main-color);

    padding: 2px 16px;
    font-size: 18px;
    font-weight: bolder;
    background-color: white;
    border-radius: 15px;
    /* border: 1px solid grey; */
}
.abonnement {
    font-size: 20px;
    color: green;
    font-weight: bolder;
    text-align: center
}
.anniversaire {
    font-size: 20px;
    color: var(--pink);
    font-weight: bolder;
    text-align: center
}
</style>

<div class="container mt-5 py-4">

    {{-- depuis le midlleware 'abo' --}}
    @if (session('nolicence'))
        <div class="alert alert-danger">
            Cette page n'est pas autorisée. <a href="{{ route('subscribe.cardform') }}" class="alert-link">Cliquez ici</a> pour souscrire un abonnement et profiter de toute la puissance de cette application.
        </div>
    @endif

    <div class="parent">
        <div class="div1 cadre_welcome"> 
            <div class="titre_welcome">Les anniversaires du mois</div>
            @if ($anniversaires->isEmpty())
            <div class="anniversaire d-flex justify-content-center align-items-center pt-5">
                Aucun anniversaire ce mois ci.
            </div>
            @else
                <div class="text-center fs-2">{{$moisActuel}}</div>
                <div class="anniversaires1 w-75 d-flex justify-content-center ">
                    <ul>
                        @foreach($anniversaires as $enfant)
                            <div class="d-flex justify-content-between">
                                <div class="day1 me-5" style="background-color: {{$enfant->genre == 'F' ? 'var(--pink)' : 'var(--blue)'}}">{{$enfant->jour}}</div>
                                <div class="name1">{{$enfant->prenom}}</div>
                            </div>
                        @endforeach                        
                    </ul>

                </div>
            @endif
        </div>
        <div class="div2 cadre_welcome"> 
            <div class="titre_welcome">Les 5 élèves les plus avancés</div>
            <div class="">
                <ul>
                    @foreach($top5ElevesLesPlusAvances as $enfant)

                    @php
                        $groupe = null;
                        if (!is_null($enfant->groupe)){                    
                        $groupe = $lesgroupes[$enfant->groupe];
                        }
                    @endphp 
                        <li class="d-flex justify-content-between align-items-center">
                           <div class="d-flex align-items-center">
                               <div class="m-2 degrade_card_enfant animaux"  style="background-image: {{$degrades[$enfant->background]}}; width: 27px; height: 27px">
                                   <img src="{{asset('/img/animaux/'.$enfant->photo)}}" alt="" width="30">    
                               </div>
                               <div class="name text-start">{{ $enfant->prenom}} {{$enfant->nom}}</div>

                           </div>
                            <div>{{$enfant->total}} activité{{$enfant->total > 1 ? 's' : null}}</div>
                        </li>
                    @endforeach                    
                </ul>

            </div>
        </div>
        <div class="div3 cadre_welcome"> 
            <div class="titre_welcome">Les 5 élèves les plus en retard</div>
            <div class="">
                <ul>
                    @foreach($top5ElevesLesMoinsAvances as $enfant)
                    @php
                    $groupe = null;
                    if (!is_null($enfant->groupe)){                    
                    $groupe = $lesgroupes[$enfant->groupe];
                    }
                @endphp 
                        <li class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="m-2 degrade_card_enfant animaux"  style="background-image: {{$degrades[$enfant->background]}}; width: 27px; height: 27px">
                                    <img src="{{asset('/img/animaux/'.$enfant->photo)}}" alt="" width="30">    
                                </div>
                                <div class="name text-start">{{ $enfant->prenom}} {{$enfant->nom}}</div>
 
                            </div>
                             <div>{{$enfant->total}} activité{{$enfant->total > 1 ? 's' : null}}</div>
                         </li>
                    @endforeach                    
                </ul>

            </div>
        </div>
        <div class="div4 cadre_welcome">
            <div class="titre_welcome">Votre abonnement</div> 
            <div class="d-flex justify-content-center align-items-center pt-5">
            @if (!$finsouscription)
  
                    <div class="abonnement">
                        Vous n'avez pas d'abonnement en cours. <a class="alert-link" href="{{ route('subscribe.cardform') }}">Cliquez ici</a> pour vous abonner
                    </div>

            @else
 
                    <div class="abonnement">
                        Votre abonnement <br> se termine le <br>{{ Carbon\Carbon::parse($finsouscription)->format('d/m/Y')}}
                    </div>
        
            @endif                
            </div> 

        </div>
        <div class="div5 cadre_welcome"> 
            <div class="titre_welcome">Les 5 activités les plus acquises</div>
            <div class="">
                <ul>
                    @foreach($top5DisciplinesLesPlusAvances as $discipline)
                    @php
                        // dd($discipline);
                    @endphp
                        <div class="d-flex justify-content-between align-items-center border-bottom my-1">
                            <div class="me-2">
                                <img src="{{ asset('img/illustrations/' . $discipline->logo) }}" alt="" width="25px"
                                height="25px">
                            </div>
                            <div class="name w-75">{{ $discipline->name}}</div>
                            <div class="w-25 text-end">{{$discipline->total}} élève{{$discipline->total > 1 ? 's' : null }}</div>

                        </div>
                        @endforeach
                        
                                      
                </ul>

            </div>
        </div>
        <div class="div6 cadre_welcome"> 
            <div class="titre_welcome">Les 5 activités les moins avancées</div>
            <div class="">
                <ul>
                    @foreach($top5DisciplinesLesMoinsAvances as $discipline)
                        <div class="d-flex align-items-center justify-content-between border-bottom my-1">
                            <div class="me-2">
                                <img src="{{ asset('img/illustrations/' . $discipline->logo) }}" alt="" width="25px"
                                height="25px">
                            </div>
                            <div class="w-75 name">{{ $discipline->name }}</div>
                            <div class="w-25 text-end">{{$discipline->total}} élève{{$discipline->total > 1 ? "s" : null}}</div>
                        </div>
                    @endforeach                    
                </ul>

            </div>
        </div>

                    <style>
                        .classe_dashboard a {
                            text-decoration: none;
                            
                        }
                        .classe_dashboard tr {
                            cursor: pointer;
                        }
                        .classe_dashboard tr:hover {
                            transform: scale(1.02)
                        }
                        .classe_dashboard .name.G a {
                            color: var(--blue) !important;
                            
                        }
                        .classe_dashboard .name.F a {
                            color: var(--rose) !important;
                            
                        }
                        .dashboard_mail {
                            font-size: 20px;
                            color: red;
                        }
                    </style>
        <div class="div7 cadre_welcome">
            <div class="titre_welcome">Ma classe</div>  
            <div class="row">
                <div class="col-md-6">
            <table class="table  table-sm classe_dashboard">
                <tbody>
                    @foreach($listeDesEleves->take(12) as $eleve)
                    @php
                        $groupe = null;
                        if (!is_null($eleve->groupe)){
                        
                        $groupe = $lesgroupes[$eleve->groupe];
                        }
                    @endphp 
                    <tr class="">
                        <td>
                            <div class="m-2 degrade_card_enfant animaux"  style="background-image: {{$degrades[$eleve->background] ?? $degrades['b1']}}; width: 27px; height: 27px" data-degrade="{{$eleve->background}}"  data-animaux="{{$eleve->photo}}">
                                <img src="{{asset('/img/animaux/'.$eleve->photo)}}" alt="" width="30">    
                            </div>
                        </td>
                        <td class="name {{$eleve->genre}}">
                            <div>
                                <a href="{{ route('voirEleve', ['id' => $eleve->id]) }}">
                                {{ $eleve->prenom.' '.$eleve->nom }}
                                </a>

                            </div>
                            <div style="color: lightgrey;">
                                {{Carbon\Carbon::parse($eleve->ddn)->format('d/m/Y')}} <small>({{ $eleve->age }})</small>
                            </div>
                        </td>

                        <td>
                            @if (!$eleve->mail)
                            <div class="dashboard_mail">

                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            @endif

                        </td>
                        <td>
                            <div class="groupe-terme {{isset($groupe) ? null : 'd-none'}}"  style="background-color: {{ $groupe["backgroundColor"] ?? '' }}; color:{{ $groupe["textColor"] ?? ''}}">{{$groupe["name"] ?? ''}}</div>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                </div>
                <div class="col-md-6">



            <table class="table table-sm classe_dashboard">
                <tbody>
                    @foreach($listeDesEleves->skip(12) as $eleve)
                    @php
                    $groupe = null;
                    if (!is_null($eleve->groupe)){
                    
                    $groupe = $lesgroupes[$eleve->groupe];
                    }
                @endphp 
                <tr class="">
                    <td>
                        <div class="m-2 degrade_card_enfant animaux"  style="background-image: {{$degrades[$eleve->background]}}; width: 27px; height: 27px" data-degrade="{{$eleve->background}}"  data-animaux="{{$eleve->photo}}">
                            <img src="{{asset('/img/animaux/'.$eleve->photo)}}" alt="" width="30">    
                        </div>
                    </td>
                    <td class="name {{$eleve->genre}}">
                        <div>
                            <a href="{{ route('voirEleve', ['id' => $eleve->id]) }}">
                            {{ $eleve->prenom.' '.$eleve->nom }}
                            </a>

                        </div>
                        <div style="color: lightgrey;">
                            {{Carbon\Carbon::parse($eleve->ddn)->format('d/m/Y')}} <small>({{ $eleve->age }})</small>
                        </div>
                    </td>

                    <td>
                        @if (!$eleve->mail)
                        <div class="dashboard_mail">

                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        @endif

                    </td>
                    <td>
                        <div class="groupe-terme {{isset($groupe) ? null : 'd-none'}}"  style="background-color: {{ $groupe["backgroundColor"] ?? '' }}; color:{{ $groupe["textColor"] ?? ''}}">{{$groupe["name"] ?? ''}}</div>

                    </td>
                </tr>
                    @endforeach
                </tbody>
            </table>
                </div>
            </div>

        </div>
    </div>


    <!-- Fin de la liste des élèves -->


    


    {{--
    <div class="row text-center">
        <div class="col"><a href="{{ route('subscribe.index') }}" class="btn btn-primary">Souscrire un abonnement</a></div>
        <div class="col"><a href="{{ route('subscribe.cancel') }}" class="btn btn-primary">Résilier mon abonnement</a></div>
        <div class="col"><a href="{{ route('subscribe.resume') }}" class="btn btn-primary">Réactiver mon abonnement</a></div>
        <div class="col"><a href="{{ route('subscribe.invoice') }}" class="btn btn-primary">Mes factures</a></div>
    </div>
    --}}

</div>
@endsection
