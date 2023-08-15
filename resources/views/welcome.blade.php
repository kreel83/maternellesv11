@extends('layouts.mainMenu', ['titre' => 'Bienvenue', 'menu' => 'accueil'])

@section('content')

<style>
.parent {
display: grid;
grid-template-columns: repeat(3, 1fr);
grid-template-rows: repeat(2, 1fr);
grid-column-gap: 0px;
grid-row-gap: 0px;
}

.div1 { grid-area: 1 / 1 / 2 / 2; }
.div2 { grid-area: 1 / 2 / 2 / 3; }
.div3 { grid-area: 1 / 3 / 2 / 4; }
.div4 { grid-area: 2 / 1 / 3 / 2; }
.div5 { grid-area: 2 / 2 / 3 / 3; }
.div6 { grid-area: 2 / 3 / 3 / 4; }
</style>

<div class="container mt-5">

    <div class="parent">
        <div class="div1"> 
            @if ($anniversaires->isEmpty())
                <h1>non !!</h1>
            @else
                <div class="">Les anniversaires du mois de <br> {{$moisActuel}}</div>
                <div class="anniversaires">
                    @foreach($anniversaires as $enfant)
                        <div class="anniversaire">
                            <div class="day" style="background-color: {{$enfant->genre == 'F' ? 'var(--pink)' : 'var(--blue)'}}">{{$enfant->jour}}</div>
                            <div class="name">{{$enfant->prenom}}</div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="div2"> 
            <div class="">Les 5 élèves les plus avancés</div>
            <div class="">
                @foreach($top5ElevesLesPlusAvances as $enfant)
                    <div class="">
                        <!--<div class="day" style="background-color: {{$enfant->genre == 'F' ? 'var(--pink)' : 'var(--blue)'}}">{{$enfant->jour}}</div>-->
                        <div class="name">{{ $enfant->prenom.' '.$enfant->nom.' ('.$enfant->total.' disciplines)'}}</div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="div3"> 
            <div class="">Les 5 élèves les plus en retard</div>
            <div class="">
                @foreach($top5ElevesLesMoinsAvances as $enfant)
                    <div class="">
                        <!--<div class="day" style="background-color: {{$enfant->genre == 'F' ? 'var(--pink)' : 'var(--blue)'}}">{{$enfant->jour}}</div>-->
                        <div class="name">{{ $enfant->prenom.' '.$enfant->nom.' ('.$enfant->total.' disciplines)'}}</div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="div4"> 
            <div class="">Les 5 disiplines les plus avancées</div>
            <div class="">
                @foreach($top5DisciplinesLesPlusAvances as $discipline)
                    <div class="">
                        <div class="name">{{ $discipline->name.' ('.$discipline->total.' élèves)' }}</div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="div5"> 
            <div class="">Les 5 disiplines les moins avancées</div>
            <div class="">
                @foreach($top5DisciplinesLesMoinsAvances as $discipline)
                    <div class="">
                        <div class="name">{{ $discipline->name.' ('.$discipline->total.' élèves)' }}</div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="div6"> Nouvel emplacement...</div>
    </div>

    <!-- Liste des élèves -->
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th class="table-primary text-center" colspan="4">Ma classe</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach($listeDesEleves as $eleve)
            <tr>
                <td><a href="{{ route('voirEleve', ['id' => $eleve->id]) }}">{{ $eleve->prenom.' '.$eleve->nom }}</a></td>
                <td>{{ $eleve->genre }}</td>
                <td>{{Carbon\Carbon::parse($eleve->ddn)->format('d/m/Y')}} <small>({{ $eleve->age }})</small></td>
                <td>{{ $eleve->groupe }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Fin de la liste des élèves -->

    @if (!$finsouscription)
        <h4 class="text-center">
            <div class="alert alert-warning" role="alert">
                Vous n'avez pas d'abonnement en cours. <a class="alert-link" href="{{ route('subscribe.index') }}">Cliquez ici</a> pour vous abonner
            </div>
        </h4>
    @else
        <h4 class="text-center">
            <div class="alert alert-success" role="alert">
                Votre abonnement se termine le {{ Carbon\Carbon::parse($finsouscription)->format('d/m/Y')}}
            </div>
        </h4>
    @endif
    
    @if ($anniversaires->isEmpty())
        <h1>non !!</h1>
    @else
        <div class="anniversaire_texte">Les anniversaires du mois de <br> {{$moisActuel}}</div>
        <div class="anniversaires">
            @foreach($anniversaires as $enfant)
                <div class="anniversaire">
                    <div class="day" style="background-color: {{$enfant->genre == 'F' ? 'var(--pink)' : 'var(--blue)'}}">{{$enfant->jour}}</div>
                    <div class="name">{{$enfant->prenom}}</div>
                </div>
            @endforeach
        </div>
    @endif

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
