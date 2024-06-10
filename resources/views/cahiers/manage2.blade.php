@extends('layouts.mainMenu2', ['titre' => 'Bienvenue', 'menu' => 'accueil'])

@section('content')

@php
$degrades = App\Models\Enfant::DEGRADE;
$lesgroupes = json_decode(Auth::user()->groupes(), true);

@endphp

<div class="d-none d-md-block">
    <div class="container my-5 page">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb position-relative my-3">
              <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>
              <li class="breadcrumb-item"><a href="{{route('enfants',['type' => "ciu"])}}">Liste des élèves</a></li>
              <li class="breadcrumb-item active" aria-current="page">Gestion des cahiers de réussites</li>
              <span class="help position-absolute" data-location="eleves.reussite.main"><i class="fa-light fa-message-question"></i></span>
            </ol>
          </nav>

          <div class="d-flex justify-content-between w-75 my-3">
            {{-- <div><span style="color:green"><i class="fa-solid fa-circle-check"></i></span> :  Cahier prêt à être envoyé aux parents.</div> --}}
            <div><span style="color:orange"><i class="fa-solid fa-circle-exclamation"></i></span> :  Le cahier n'est pas encore prêt à l'envoi.</div>
            <div><span style="color:red"><i class="fa-solid fa-circle-question"></i></span> :  Le cahier n'est pas encore créé pour la période.</div>
          </div>

          <div class="my-3">
            <i class="fa-regular fa-circle-info me-1"></i>
            @switch(Auth::user()->classe_active()->textes_dans_pdf)
                @case('bottom')
                    Les commentaires associés aux domaines d'activités <strong>seront affichés en fin de cahier</strong>.
                    @break
                @case('between')
                    Les commentaires associés aux domaines d'activités <strong>seront affichés après chaque domaine</strong> dans le cahier.
                    @break
                @default
                    Les commentaires associés aux domaines d'activités <strong>ne seront pas affichés</strong> dans le cahier.
            @endswitch
            Pour changer cette option, veuillez <a href="{{ route('parametresClasse').'/#textespdf' }}">cliquer ici</a>.
          </div>


    @if(session()->has('success'))
        @if(session('success'))
            <div class="mt-2 alert alert-success" role="alert">Les cahiers de réussites ont été envoyés.</div>
        @else
            <div class="mt-2 alert alert-danger" role="alert">
                {!! implode('<br>', session('error')) !!}
            </div>
        @endif
    @endif

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="mt-2 alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <form id="bulkForm" action="{{ route('cahierManage.post') }}" method="POST">
        @csrf
            {{--<input type="hidden" name="maxPeriode" value="{{$maxPeriode}}">--}}
            <input type="hidden" id="periode" name="periode">
            <table class="table align-middle white  table-responsive">
                <thead>
                    <tr>
                        <th colspan="2">Mes élèves <span class="ms-2 ordreArray" style="cursor: pointer" data-ordre="prenom"><i class="fa-solid fa-arrow-down"></i></span></th>
                        
                            <th>Section <span class="ms-2 ordreArray" style="cursor: pointer" data-ordre="psmsgs"><i class="fa-solid fa-arrow-down"></i></span></th>

                        
                        <th>Groupe <span class="ms-2 ordreArray" style="cursor: pointer" data-ordre="groupe"><i class="fa-solid fa-arrow-down"></i></span></th>
                        <th>Emails parents</th>
                        @for ($periode=1; $periode <= $maxPeriode; $periode++)
                            <th class="text-center align-top" colspan="1">
                                <h6 style="color: var(--main-color)">Période {{$periode}}</h6>
                                @if($displayBtnBulk[$periode])
                                    {{-- <button id="btnSubmit{{$periode}}" type="button" value="{{$periode}}" class="mx-auto btnAction inverse mt-2 mb-2 bulk">Envoyer les cahiers</button> --}}
                                    @php
                                        $token = md5(Auth::user()->email.$periode.env('HASH_SECRET'));
                                    @endphp
                                    <a href="{{ route('cahierManage.bulk.confirm', ['periode' => $periode, 'token' => $token]) }}" class="mx-auto btnAction inverse mt-2 mb-2">Envoyer les cahiers</a>
                                @endif
                            </th>
                        @endfor
                    </tr>
                </thead>
            <tbody class="table-group-divider">
            @foreach ($enfants as $enfant)
                @php
                    $groupe = null;
                    if (!is_null($enfant->groupe) && $lesgroupes){
                        $groupe = $lesgroupes[$enfant->groupe];
                    }
                @endphp 
                <tr>
                    <td>
                        <div class="m-2 degrade_card_enfant animaux"  style="background-image: {{$degrades[$enfant->background]}}; width: 27px; height: 27px" data-degrade="{{$enfant->background}}"  data-animaux="{{$enfant->photo}}">
                            <img src="{{asset('/img/animaux/'.$enfant->photo)}}" alt="" width="30">    
                        </div>
                    </td>


                    {{-- <td>{{ $enfant->prenom.' '.$enfant->nom}}</td> --}}
                    <td><a href="{{ route('voirEleve', ['enfant_id' => $enfant->id]) }}">{{ $enfant->prenom.' '.$enfant->nom}}</a></td>

                    <td>{{ strtoupper($enfant->psmsgs) }}</td>
                    <td class="mx-auto">
                        <div class="text-center groupe-terme {{isset($groupe) ? null : 'd-none'}}" style="border-radius: 4px; background-color: {{ $groupe["backgroundColor"] ?? '' }}; color:{{ $groupe["textColor"] ?? ''}} ; border: 1px solid {{$groupe["textColor"] ?? 'transparent'}}">
                            {{$groupe["name"] ?? ''}}
                        </div>
                    </td>

                    <td>
                        <span style="color:{{$statutEmail[$enfant->id]['textcolor']}}">{!! $statutEmail[$enfant->id]['msg'] !!}</span>
                    </td>
                    
                    @for ($periode=1; $periode<=$maxPeriode; $periode++)
                        <td class="text-center">
                            @if ($statutCahier[$enfant->id][$periode]['status'] == 'PRET')
                                <div id="cahier-{{$enfant->id}}">
                                    <div class="btn-group" role="group" aria-label="Actions">
                                        <a class="btn btn-outline-info btn-sm" type="button" href="{{ route('cahierApercu', ['token' => 0, 'enfant_id' => $enfant->id, 'periode' => $periode]) }}" target="_blank" title="Voir le cahier de réussites"><i class="fa-regular fa-eye"></i> Aperçu</a>
                                        <button id="{{$enfant->id}}-{{$periode}}-E" type="button" class="btn {{ $statutEmail[$enfant->id]['success'] ? 'btn-outline-success' : 'btn-outline-secondary'}} btn-sm envoicahier" role="button" title="Envoyer le cahier de réussites" {{ $statutEmail[$enfant->id]['success'] ? '' : 'disabled'}}>
                                        {!! $statutCahier[$enfant->id][$periode]['msg'] !!}
                                        </button>                                
                                    </div>
                                </div>
                                <div id="envoierror-{{$enfant->id}}"></div>
                            @else
                                @if ($statutCahier[$enfant->id][$periode]['status'] == 'ENVOYE')

                                    <div class="btn-group" role="group" aria-label="Actions">
                                        <a class="btn btn-outline-info btn-sm" type="button" href="{{ route('cahierApercu', ['token' => 0, 'enfant_id' => $enfant->id, 'periode' => $periode]) }}" target="_blank" title="Voir le cahier de réussites"><i class="fa-regular fa-eye"></i> Aperçu</a>
                                        <button id="{{$enfant->id}}-{{$periode}}-R" type="button" class="btn btn-success btn-sm renvoicahier" title="{{ $statutCahier[$enfant->id][$periode]['msg'] }}"><i class="fa-solid fa-envelope-circle-check fa-lg"></i> Renvoyer</button>
                                    </div>
                                    <div id="renvoi-{{$enfant->id}}"></div>
                                    {{--
                                    <div id="renvoi-{{$enfant->id}}">
                                        <small><a id="{{$enfant->id}}-{{$periode}}-R" class="envoicahier" href="#">Renvoyer l'email</a></small>
                                    </div>                                
                                    <div id="renvoierror-{{$enfant->id}}"></div>
                                    --}}
                                @else
                                    <span style="color:{{$statutCahier[$enfant->id][$periode]['textcolor']}}" title="{{$statutCahier[$enfant->id][$periode]['title']}}">{!! $statutCahier[$enfant->id][$periode]['msg'] !!}</span>
                                @endif
                            @endif
                        </td>
                    @endfor
                </tr>
            @endforeach
            </tbody>
            </table>
            
        </form>
    </div>
</div>
<div class="d-block d-md-none">
    <div class="justify-content-center align-item-center vh-95 vw-100 d-flex p-5">
        <div class="text-center pt-5 ">
            <div class="mb-3">
                <i class="fa-solid fa-laptop fs-2"></i>
                <i class="fa-light fa-tablet fs-2"></i>
            </div>
            Cette vue n'est disponible qu'en mode navigateur
        </div>
    </div>
</div>

<!-- Modal pour le renvoi de l'email -->
<div class="modal fade" id="renvoiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Renvoyer le mail aux parents</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Un email contenant le lien de téléchargement du cahier de réussites va être renvoyé à tous les contacts de l'élève.
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <button type="button" class="btn btn-primary" id="confirmationRenvoiMail"  data-bs-dismiss="modal">Renvoyer le Mail</button>
            <input type="hidden" id="confirmationRenvoiMailId">
        </div>
        </div>
    </div>
</div>

<!-- Modal pour l'envoi en masse des cahiers (bouton sous période) -->
<div class="modal fade" id="envoiTousLesCahiersModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Renvoyer le mail aux parents</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Un email contenant le lien de téléchargement du cahier de réussites va être renvoyé à tous les contacts de l'élève.
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <button type="button" class="btn btn-primary" id="confirmationEnvoiTousLesCahiers">Confirmer</button>
            {{--<input type="hidden" id="periodeBulkEnvoi">--}}
        </div>
        </div>
    </div>
</div>

@endsection