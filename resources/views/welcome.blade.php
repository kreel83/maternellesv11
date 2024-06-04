@extends('layouts.mainMenu2', ['titre' => 'Bienvenue', 'menu' => 'accueil'])

@section('content')

@php
$degrades = App\Models\Enfant::DEGRADE;


$is_dashboard = true;
@endphp



<div class="container mt-5 py-4" id="welcome">

    @include('include.display_msg_error')

    {{-- depuis le midlleware 'abo' --}}
    @if (!$is_partage_en_cours->isEmpty())
        <div class="alert alert-info">
            Vous avez une demande de partage de classe en attente d'acceptation. <a href="{{route('liste_partage')}}">Accepter le partage</a>
        </div>
    @endif



    <div class="parent">
        <div class="info1 cadre_info d-flex justify-content flex-column align-items-center">
            <div style="font-size: 40px; font-weight: bold">{{ $info[1]}}</div>
            <div>élève{{ $info[1] > 1 ? 's' : null}}</div>
        </div>
        <div class="info2 cadre_info d-flex justify-content flex-column align-items-center">
            <div  style="font-size: 40px; font-weight: bold">{{ $info[2]}}</div>
            <div>activité{{ $info[2] > 1 ? 's' : null}} acquise{{ $info[2] > 1 ? 's' : null}}</div>
            @if ($info[22] > 0)
            <small style="font-weight:bold; font-size: 12px; color: var(--main-color)">dont {{$info[22]}} avec aide</small>
            @endif
        </div>
        <div class="info3 cadre_info d-flex justify-content flex-column align-items-center">
            <div style="font-size: 40px; font-weight: bold">{{ $info[3]}}</div>
            <div>fiche{{ $info[3] > 1 ? 's' : null}}  sélectionnée{{ $info[3] > 1 ? 's' : null}}</div>
        </div>
        <div class="info4 cadre_info">
            @foreach ($sections as $section)
                @if ($section->id == 9 && Auth::user()->classe_active()->desactive_devenir_eleve == 1)
                @else
                <div class="d-flex flex-column align-items-center">

                    <div class="nbSection" style="color: {{$section->color}}">{{ $nombreDeFichesParSection[$section->id] }}</div>
                    <div class='selectSectionFiche selectSectionItem'
                        data-value="{{ $section->id }}" title="{{$section->name}}">
                        <img src="{{ asset('img/illustrations/' . $section->logo) }}" alt="" width="45px"
                            height="45px">
                    </div>

                    <div class="petit_texte" style="color: {{$section->color}}">{{$section->icone}}</div>
            
                </div>
                @endif
            @endforeach
        </div>

        <div class="div1 cadre_welcome"> 
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
                                if (!is_null($enfant->groupe) && !is_null($lesgroupes)){                    
                                $groupe = $lesgroupes[$enfant->groupe];
                                }
                            @endphp 
                            <li class="d-flex justify-content-between align-items-center w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="m-2 degrade_card_enfant animaux"  style="background-image: {{ ($enfant->background) ? $degrades[$enfant->background] : null }}; width: 27px; height: 27px">
                                        <img src="{{asset('/img/animaux/'.$enfant->photo)}}" alt="" width="30">    
                                    </div>
                                    <div class="name text-start">{{ $enfant->prenom}} <span class="{{ config('app.custom.app_demo') && Auth::id() == config('app.custom.app_demo_user') ? 'blur' : null}}">{{$enfant->nom}}</span></div>
                                </div>
                                <div class="ddn">{{Carbon\Carbon::parse($enfant->ddn)->format('d')}}</div>
                            </li>
                        @endforeach                        
                    </ul>

                </div>
            @endif
        </div>

        <div class="div8 cadre_welcome "> 
            <div class="titre_welcome">Les prochains évènements</div>
            @if ($conges->isEmpty())
                <div class="anniversaire d-flex justify-content-center align-items-center pt-5">
                    Aucun évènement à venir.
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
                            if (!is_null($enfant->groupe) && !is_null($lesgroupes)){                   
                            $groupe = $lesgroupes[$enfant->groupe];
                            }
                        @endphp 
                            <li class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="m-2 degrade_card_enfant animaux"  style="background-image: {{ ($enfant->background) ? $degrades[$enfant->background] : null }}; width: 27px; height: 27px">
                                    <img src="{{asset('/img/animaux/'.$enfant->photo)}}" alt="" width="30">    
                                </div>
                                <div class="name text-start">{{ $enfant->prenom}} <span class="{{ config('app.custom.app_demo') && Auth::id() == config('app.custom.app_demo_user') ? 'blur' : null}}">{{$enfant->nom}}</span></div>

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
                    if (!is_null($enfant->groupe) && !is_null($lesgroupes)){                    
                    $groupe = $lesgroupes[$enfant->groupe];
                    }
                @endphp 
                        <li class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="m-2 degrade_card_enfant animaux"  style="background-image: {{ ($enfant->background) ? $degrades[$enfant->background] : null }}; width: 27px; height: 27px">
                                    <img src="{{asset('/img/animaux/'.$enfant->photo)}}" alt="" width="30">    
                                </div>
                                <div class="name text-start">{{ $enfant->prenom}} <span class="{{ config('app.custom.app_demo') && Auth::id() == config('app.custom.app_demo_user') ? 'blur' : null}}">{{$enfant->nom}}</span></div>
 
                            </div>
                             <div>{{$enfant->total}} activité{{$enfant->total > 1 ? 's' : null}}</div>
                         </li>
                    @endforeach                    
                </ul>

            </div>
        </div>

        {{-- Code ci-dessous pour Licence abo / achat --}}
        {{-- <div class="div4 cadre_welcome">
            <div class="titre_welcome">Ma licence</div> 
            <div class="align-items-center pt-5">
                @if ($is_abonne)
                    <div class="abonnement_ok mb-3">
                        <i class="fa-solid fa-circle-check"></i> Licence activée
                    </div>
                    <div class="d-flex justify-content-center">
                        <a class="btnAction" href="{{ route('licence.detail') }}">Voir le détail</a>
                    </div>
                @else
                    <div class="abonnement_notOk mb-3">
                        <i class="fa-solid fa-circle-exclamation"></i> Aucune licence active
                    </div>
                    <div class="d-flex justify-content-center">
                        <a class="btnAction" href="{{ route('licence.index') }}">Acheter une licence</a>
                    </div>
                @endif
            </div> 
        </div> --}}

        {{-- Code ci-dessous pour Licence abo uniquement --}}
        <div class="div4 cadre_welcome">
            <div class="titre_welcome">Votre abonnement</div> 
            <div class="align-items-center pt-5">
                @if ($is_abonne)
                    <div class="abonnement_ok mb-3">
                        <i class="fa-solid fa-circle-check"></i> Abonnement actif
                    </div>
                    <div class="d-flex justify-content-center">
                        <a class="btnAction" href="{{ route('subscribe.index') }}">Voir le détail</a>
                    </div>
                @else
                    <div class="abonnement_notOk mb-3">
                        <i class="fa-solid fa-circle-exclamation"></i> Aucun abonnement
                    </div>
                    <div class="d-flex justify-content-center">
                        <a class="btnAction" href="{{ route('subscribe.index') }}">S'abonner au service</a>
                    </div>
                @endif
            </div> 
        </div>

        <div class="div5 cadre_welcome"> 
            <div class="titre_welcome">Les 5 activités les plus acquises</div>
            <div class="">
                <ul>
                    @foreach($top5DisciplinesLesPlusAvances as $discipline)
                        <div class="d-flex justify-content-between align-items-center border-bottom my-1">
                            <div class="me-2">
                                <img src="{{ asset('img/illustrations/' . $discipline->id.'.png') }}" alt="" width="25px"
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
                @if ($listeDesEnfantsSansNote == 0)
                <ul>
                    @foreach($top5DisciplinesLesMoinsAvances as $discipline)
                        <div class="d-flex align-items-center justify-content-between border-bottom my-1">
                            <div class="me-2">
                                <img src="{{ asset('img/illustrations/' . $discipline->id.'.png') }}" alt="" width="25px"
                                height="25px">
                            </div>
                            <div class="w-75 name">{{ $discipline->name }}</div>
                            <div class="w-25 text-end">{{$discipline->total}} élève{{$discipline->total > 1 ? "s" : null}}</div>
                        </div>
                    @endforeach                    
                </ul>
                @else
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <div style="font-size: 70px; text-align: center">{{$listeDesEnfantsSansNote}}</div>
                    <div style="font-size: 20px; text-align: center">Elèves n'ont pas <br>encore d'évaluation</div>                    
                </div>

                @endif

            </div>
        </div>


        <div class="div7 cadre_welcome">
            <div class="titre_welcome">Ma classe</div>  
            @include('include.maclasse')

            </div>

        </div>
    </div>

   




</div>
@endsection
