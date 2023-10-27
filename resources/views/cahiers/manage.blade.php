@extends('layouts.mainMenu2', ['titre' => 'Bienvenue', 'menu' => 'accueil'])

@section('content')

@php
$degrades = App\Models\Enfant::DEGRADE;
$lesgroupes = json_decode(Auth::user()->groupes, true);
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

<form action="{{ route('cahierManage.post') }}" method="POST">
    @csrf
        <input type="hidden" name="maxPeriode" value="{{$maxPeriode}}">

        <table class="table align-middle">
            <thead>
                <tr>
                    <th colspan="2">Mes élèves</th>
					<th>Section</th>
                    <th>Groupe</th>
                    <th>Emails parents</th>
                    @for ($periode=1;$periode<=$maxPeriode;$periode++)
                        <th class="text-center align-top" colspan="1">
                            <h5>Période {{$periode}}</h5>
                            @if($displayBtnBulk[$periode])
                                <button name="btnSubmit" value="{{$periode}}" class="btn btn-outline-primary mt-2 mb-2 btn-sm">Envoyer les cahiers</button>
                            @endif
                        </th>
                    @endfor
                </tr>
            </thead>
        <tbody class="table-group-divider">
        @foreach ($enfants as $enfant)
            @php
                $groupe = null;
                if (!is_null($enfant->groupe)){
                    $groupe = $lesgroupes[$enfant->groupe];
                }
            @endphp 
            <tr>
                <td>
                    <div class="m-2 degrade_card_enfant animaux"  style="background-image: {{$degrades[$enfant->background]}}; width: 27px; height: 27px" data-degrade="{{$enfant->background}}"  data-animaux="{{$enfant->photo}}">
                        <img src="{{asset('/img/animaux/'.$enfant->photo)}}" alt="" width="30">    
                    </div>
                </td>
                <td>{{ $enfant->id.' '.$enfant->prenom.' '.$enfant->nom}}</td>
				<td>{{ strtoupper($enfant->psmsgs) }}</td>
                <td align="center">
                    <div class="groupe-terme {{isset($groupe) ? null : 'd-none'}}"  style="background-color: {{ $groupe["backgroundColor"] ?? '' }}; color:{{ $groupe["textColor"] ?? ''}}">{{$groupe["name"] ?? ''}}</div>
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
                                    {!! $statutCahier[$enfant->id][$periode]['msg'] !!} Envoyer
                                    </button>                                
                                </div>
                            </div>
                            <div id="envoierror-{{$enfant->id}}"></div>
                        @else
                            <span style="color:{{$statutCahier[$enfant->id][$periode]['textcolor']}}">{!! $statutCahier[$enfant->id][$periode]['msg'] !!}</span>

                            @if ($statutCahier[$enfant->id][$periode]['status'] == 'ENVOYE')
                                <div id="renvoi-{{$enfant->id}}">
                                    <small><a id="{{$enfant->id}}-{{$periode}}-R" class="envoicahier" href="#">Renvoyer l'email</a></small>
                                </div>
                                <div id="renvoierror-{{$enfant->id}}"></div>
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

@endsection