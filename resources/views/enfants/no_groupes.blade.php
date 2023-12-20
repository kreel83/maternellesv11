@extends('layouts.mainMenu2', ['titre' => 'Ma classe', 'menu' => $type])

@section('content')
<div id="page_enfants" class="mt-5" >
        <div class="w-100 vh-100">
                <div>
                        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>
                        @if ($type == "affectation_groupe")
                        <li class="breadcrumb-item active" aria-current="page">Affectation des groupes</li>
                        @else
                        <li class="breadcrumb-item active" aria-current="page">Liste des enfants</li>
                        @endif
                        </ol>
                        </nav>                
                </div>
                <div class="d-flex justify-content-center align-items-center w-100" style="height: calc(100vh - 200px)">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                                <h3>Aucun groupe défini</h3>
                                <a href="{{route('groupe')}}" class="btnAction">Définir des groupes</a>
                        </div>

                </div>

                
        </div>
</div>
@endsection
        