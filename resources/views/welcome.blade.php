@extends('layouts.mainMenu2', ['titre' => 'Bienvenue', 'menu' => 'accueil'])

@section('content')

@php
$degrades = App\Models\Enfant::DEGRADE;
$lesgroupes = json_decode(Auth::user()->groupes, true);
@endphp



<div class="container mt-5 py-4" id="welcome">

    {{-- depuis le midlleware 'abo' --}}
    @if (session('nolicence'))
        <div class="alert alert-danger">
            Cette page n'est pas autorisée. <a href="{{ route('subscribe.cardform') }}" class="alert-link">Cliquez ici</a> pour souscrire un abonnement et profiter de toute la puissance de cette application.
        </div>
    @endif

    @if (Auth::user()->is_abonne())

    <div class="parent">
        <div class="div1 cadre_welcome"> 
            @php
                
            @endphp
            <div class="titre_welcome">Les anniversaires {{ in_array(substr($moisActuel,0,1), ['o','a']) ? "d'" : 'de '}}{{$moisActuel}}</div>
            @if ($anniversaires->isEmpty())
            <div class="anniversaire d-flex justify-content-center align-items-center pt-5">
                Aucun anniversaire ce mois ci.
            </div>
            @else

                <div class="anniversaires1 w-75 d-flex justify-content-between ">
                    <ul class="w-100">
                        @foreach($anniversaires as $enfant)
                            @php
                                $groupe = null;
                                if (!is_null($enfant->groupe)){                    
                                $groupe = $lesgroupes[$enfant->groupe];
                                }
                            @endphp 
                            <li class="d-flex justify-content-between align-items-center w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="m-2 degrade_card_enfant animaux"  style="background-image: {{ ($enfant->background) ? $degrades[$enfant->background] : null }}; width: 27px; height: 27px">
                                        <img src="{{asset('/img/animaux/'.$enfant->photo)}}" alt="" width="30">    
                                    </div>
                                    <div class="name text-start">{{ $enfant->prenom}} {{$enfant->nom}}</div>
                                </div>
                                <div class="ddn">{{Carbon\Carbon::parse($enfant->ddn)->format('d')}}</div>
                            </li>
                        @endforeach                        
                    </ul>

                </div>
            @endif
        </div>

        <div class="div8 cadre_welcome "> 
            @php
                
            @endphp
            <div class="titre_welcome">Les prochains évenements</div>
            @if ($anniversaires->isEmpty())
            <div class="anniversaire d-flex justify-content-center align-items-center pt-5">
                Aucun eventment à venir.
            </div>
            @else

                <div class="anniversaires1 w-100 d-flex justify-content-between">
                    <ul class="w-100 pe-3">
                        @foreach ($conges as $ev )
                            

                        <li class="d-flex justify-content-between align-items-center w-100">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <div class="m-2 degrade_card_enfant animaux" style="width: 27px; height: 27px">
                                    @if ($ev['type'] == 'conges')
                                        <i class="fa-solid fa-plane"></i>
                                    @else
                                    
                                        <i class="fa-solid fa-calendar-check"></i>
                                    @endif    
                                </div>
                                <div class="name text-start">{{ $ev['description']}}</div>
 
                                <div class="">{{Carbon\Carbon::parse($ev['date'])->format('d/m')}}</div>
                            </div>
                         </li>
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
                                <div class="m-2 degrade_card_enfant animaux"  style="background-image: {{ ($enfant->background) ? $degrades[$enfant->background] : null }}; width: 27px; height: 27px">
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
                                <div class="m-2 degrade_card_enfant animaux"  style="background-image: {{ ($enfant->background) ? $degrades[$enfant->background] : null }}; width: 27px; height: 27px">
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


        <div class="div7 cadre_welcome">
            <div class="titre_welcome">Ma classe</div>  
            @include('include.maclasse')

            </div>

        </div>
    </div>

    @else
    <div class="parent">
        <div class="div1 cadre_welcome"> 
            <div class="titre_welcome">Etape 1</div>
            
            <div class="anniversaire d-flex justify-content-center align-items-center pt-5">
                Avant de commencer
            </div>
            <div>
                <ol>
                    {{-- <li><a href="/app/monprofil?state=tuto&tuto_type=direction">nom du directeur de l'école</a></li>
                    <li><a href="/app/monprofil?state=tuto&tuto_type=periodicite">définition de la périodicité des cahiers de réussite</a></li>
                    <li><a href="/app/monprofil?state=tuto&tuto_type=aides">définition des mes aides maternees et AESH</a> </li> --}}
                    <li><a href="/app/monprofil">page "mon profil"</a> </li>
                    <li><a href="/app/groupe">Je crée mes groupes</a> </li>

                </ol>
            </div>

        </div>
        <div class="div2 cadre_welcome"> 
            <div class="titre_welcome">Etape 2</div>
            <div class="anniversaire d-flex justify-content-center align-items-center pt-5">
                Je créé ma classe
            </div>
            <div>
                <ol>
                    <li><a href="/app/eleves">Je créé mes élèves</a></li>
                    <li>Je récupère les élèves de l'année dernière</li>
                    <li>JE corrige les fiche élève si besoin</li>

                </ol>
            </div>
        </div>
        <div class="div3 cadre_welcome">
            <div class="titre_welcome">Etape 3</div> 
            <div class="anniversaire d-flex justify-content-center align-items-center pt-5">
                J'organise ma classe
            </div>
            <div>
                <ol>
                    <li><a href="/app/enfants?type=avatar&tuto_type=modify_avatar">Je choisi les avatars de élève</a></li>
                    <li><a href="/app/enfants?type=affectation_groupe">J'affecte les groupe à mes élèves</a></li>


                </ol>
            </div>

        </div>
        <div class="div4 cadre_welcome"> 
            <div class="titre_welcome">Etape 4</div>
            <div class="anniversaire d-flex justify-content-center align-items-center pt-5">
                Je prepare mon année
            </div>
            <div>
                <ol>
                    <li><a href="/app/fiches">Je choisi les activités que je vais traiter</a></li>
                    <li><a href="/app/fiches/create">Je créé mes propres activités</a></li>
                    <li><a href="/app/parametres/phrases">Je créais mes phrases préétablies</a></li>


                </ol>
            </div>
        </div>
        <div class="div5 cadre_welcome"> 
            <div class="titre_welcome">Etape 5</div>
            <div class="anniversaire d-flex justify-content-center align-items-center pt-5">
                J'évalue mes élèves
            </div>
            <div>
                <ol>
                    <li>Je choisi l'élève à évaluer</li>
                    <li>Je choisi ensuite la discipline</li>
                    <li>Puis l'activité à évaluer</li>
                    <li>J'value enfin l'élève</li>

                </ol>
            </div>
        </div>

        <div class="div6 cadre_welcome"> 
            <div class="titre_welcome">Etape 6</div>
            <div class="anniversaire d-flex justify-content-center align-items-center pt-5">
                J'élabore le cahier de réussite'
            </div>
            <div>
                <ol>
                    <li>Je choisi l'élève</li>
                    <li>Je choisi ensuite la discipline</li>
                    <li>Puis l'activité à évaluer</li>
                    <li>J'value enfin l'élève</li>

                </ol>
            </div>
        </div>



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
                                <a href="{{ route('voirEleve', ['enfant_id' => $eleve->id]) }}">
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
                            <a href="{{ route('voirEleve', ['enfant_id' => $eleve->id]) }}">
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
    @endif




</div>
@endsection
