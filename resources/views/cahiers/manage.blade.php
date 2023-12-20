@extends('layouts.mainMenu2', ['titre' => 'Bienvenue', 'menu' => 'accueil'])

@section('content')

@php
$degrades = App\Models\Enfant::DEGRADE;
$lesgroupes = json_decode(Auth::user()->groupes(), true);

@endphp

<div class="container my-5 page">

<div><span style="color:green"><i class="fa-solid fa-circle-check"></i></span> :  Cahier prêt à être envoyé aux parents.</div>
<div><span style="color:orange"><i class="fa-solid fa-circle-check"></i></span> :  Cahier pas encore terminé (non définitif).</div>
<div><span style="color:red"><i class="fa-solid fa-circle-check"></i></span> :  Le cahier n'est pas encore crée pour la période.</div>

{{-- Retour assignation licence --}}
@if(session()->has('success'))
    @if(session('success'))
        <div class="mt-2 alert alert-success" role="alert">Les cahiers de réussite ont été envoyés.</div>
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
                    @for ($periode=1;$periode<=$maxPeriode;$periode++)
                        <th class="text-center align-top" colspan="1">
                            <h5>Période {{$periode}}</h5>
                            @if($displayBtnBulk[$periode])
                                {{--<button name="btnSubmit" value="{{$periode}}" class="btn btn-outline-primary mt-2 mb-2 btn-sm">Envoyer les cahiers</button>--}}
                                <button id="btnSubmit{{$periode}}" type="button" value="{{$periode}}" class="btn btn-outline-primary mt-2 mb-2 btn-sm bulk">Envoyer les cahiers</button>
                            @endif
                        </th>
                    @endfor
                </tr>
            </thead>
        <tbody class="table-group-divider">
        @foreach ($enfants as $enfant)
            @php
                $groupe = null;
                // dd($lesgroupes);
                
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

                <td>{{ $enfant->prenom.' '.$enfant->nom}}</td>
				<td>{{ strtoupper($enfant->psmsgs) }}</td>
                <td class="mx-auto">
                    <div class="text-center groupe-terme {{isset($groupe) ? null : 'd-none'}}"  style="background-color: {{ $groupe["backgroundColor"] ?? '' }}; color:{{ $groupe["textColor"] ?? ''}} ; border: 1px solid {{$groupe["textColor"] ?? 'transparent'}}">{{$groupe["name"] ?? ''}}</div>

                </td>

                <td>
                    <span style="color:{{$statutEmail[$enfant->id]['textcolor']}}">{!! $statutEmail[$enfant->id]['msg'] !!}</span>
                </td>
                
                @for ($periode=1; $periode<=$maxPeriode; $periode++)
                    <td class="text-center">
                        @if ($statutCahier[$enfant->id][$periode]['status'] == 'PRET')
                            <div id="cahier-{{$enfant->id}}">
                                <div class="btn-group" role="group" aria-label="Actions">
                                    <a class="btn btn-outline-info btn-sm" type="button" href="{{ route('cahierApercu', ['token' => 0, 'enfant_id' => $enfant->id, 'periode' => $periode]) }}" target="_blank"><i class="fa-regular fa-eye"></i> Aperçu</a>
                                    <button id="{{$enfant->id}}-{{$periode}}-E" type="button" class="btn {{ $statutEmail[$enfant->id]['success'] ? 'btn-outline-success' : 'btn-outline-secondary'}} btn-sm envoicahier" role="button" {{ $statutEmail[$enfant->id]['success'] ? '' : 'disabled'}}>
                                    {!! $statutCahier[$enfant->id][$periode]['msg'] !!}
                                    </button>                                
                                </div>
                            </div>
                            <div id="envoierror-{{$enfant->id}}"></div>
                        @else
                            @if ($statutCahier[$enfant->id][$periode]['status'] == 'ENVOYE')

                                <div class="btn-group" role="group" aria-label="Actions">
                                    <a class="btn btn-outline-info btn-sm" type="button" href="{{ route('cahierApercu', ['token' => 0, 'enfant_id' => $enfant->id, 'periode' => $periode]) }}" target="_blank"><i class="fa-regular fa-eye"></i> Aperçu</a>
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
                                <span style="color:{{$statutCahier[$enfant->id][$periode]['textcolor']}}">{!! $statutCahier[$enfant->id][$periode]['msg'] !!}</span>
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
            <button type="button" class="btn btn-primary" id="confirmationRenvoiMail">Renvoyer le Mail</button>
            <input type="hidden" id="confirmationRenvoiMailId">
        </div>
        </div>
    </div>
</div>

<!-- Modal pour l'envoi en masse des cahiers (bouton sous periode) -->
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