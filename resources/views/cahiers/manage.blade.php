@extends('layouts.mainMenu2', ['titre' => 'Bienvenue', 'menu' => 'accueil'])

@section('content')

<div class="container my-5 page">

{{-- Retour assignation licence --}}
@if(session()->has('success'))
    @if(session('success'))
        <div class="alert alert-success" role="alert">Les cahiers de réussite ont été envoyés.</div>
    @else
        <div class="alert alert-danger" role="alert">
            {!! implode('<br>', session('error')) !!}
        </div>
    @endif
@endif

<!-- Validation Errors -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('cahierManage.post') }}" method="POST">
    @csrf

        <button class="btn btn-primary mb-3">Envoyer les cahiers de réussite</button>

        <table class="table">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll"></th>
                    <th>Nom</th>
                    <th>Emails</th>
                    @for ($i=1;$i<=$maxPeriode;$i++)
                        <th class="text-center">Période {{$i}}</th>
                    @endfor
                </tr>
            </thead>
        <tbody class="table-group-divider">
        @foreach ($enfants as $enfant)
        @php
            //dd($enfant);
        @endphp
        <tr>
            <td>
                <input type="checkbox" id="enfantSelection" name="enfantSelection[]" value="{{ $enfant->id }}">
            </td>
            <td>{{ $enfant->prenom.' '.$enfant->nom}}</td>
            <td>
                @if (filter_var($enfant->mail1, FILTER_VALIDATE_EMAIL) || filter_var($enfant->mail2, FILTER_VALIDATE_EMAIL))
                    {{$enfant->mail1}} ; {{$enfant->mail2}}
                @else
                    Aucun email défini
                @endif
            </td>
            @for ($periode=1; $periode<=$maxPeriode; $periode++)
                <td class="text-center">
                    {{ $datesEnvois[$enfant->id][$periode] }}
                    @if (!empty($datesEnvois[$enfant->id][$periode]))
                        <br><a href="{{ route('renvoiCahier', ['id' => $enfant->id, 'periode' => $periode]) }}">Renvoyer l'email</a>
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