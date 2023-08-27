@extends('layouts.mainMenu', ['titre' => 'Bienvenue', 'menu' => 'accueil'])

@section('content')

<style>
.parent {
display: grid;
grid-template-columns: repeat(3, 1fr);
grid-template-rows: 200px 250px 400px;
grid-gap: 15px;
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
}


.cadre_welcome {
    border: 1px solid grey;
    border-radius: 8px;
    padding: 24px 8px 8px 8px;
    position: relative;
    font-size: 14px;
}
.titre_welcome {
    position: absolute;
    top: -14px;
    left: 30px;
    padding: 2px 16px;
    background-color: #F4F9FF;
}
</style>

<div class="container mt-3">

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
                <h1>non !!</h1>
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
                        <li class="d-flex justify-content-between">
                            <!--<div class="day" style="background-color: {{$enfant->genre == 'F' ? 'var(--pink)' : 'var(--blue)'}}">{{$enfant->jour}}</div>-->
                            <div class="name">{{ $enfant->prenom}} {{$enfant->nom}}</div>
                            <div>{{$enfant->total}} activités</div>
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
                    <li class="d-flex justify-content-between">
                            <!--<div class="day" style="background-color: {{$enfant->genre == 'F' ? 'var(--pink)' : 'var(--blue)'}}">{{$enfant->jour}}</div>-->
                            <div class="name">{{ $enfant->prenom.' '.$enfant->nom}}</div>
                            <div>{{$enfant->total}} activités</div>
                        </li>
                    @endforeach                    
                </ul>

            </div>
        </div>
        <div class="div4 cadre_welcome">
            <div class="titre_welcome">Votre abonnement</div>  
            @if (!$finsouscription)
            <h4 class="text-center">
                <div class="alert alert-warning" role="alert">
                    Vous n'avez pas d'abonnement en cours. <a class="alert-link" href="{{ route('subscribe.cardform') }}">Cliquez ici</a> pour vous abonner
                </div>
            </h4>
        @else
            <h4 class="text-center">
                <div class="alert alert-success" role="alert">
                    Votre abonnement <br> se termine le <br>{{ Carbon\Carbon::parse($finsouscription)->format('d/m/Y')}}
                </div>
            </h4>
        @endif
        </div>
        <div class="div5 cadre_welcome"> 
            <div class="titre_welcome">Les 5 disciplines les plus acquises</div>
            <div class="">
                <ul>
                    @foreach($top5DisciplinesLesPlusAvances as $discipline)
                        <div class="d-flex justify-content-between border-bottom my-1">
                            <div class="name w-75">{{ $discipline->name}}</div>
                            <div class="w-25 text-end">{{$discipline->total}} élèves</div>

                        </div>
                        @endforeach
                        
                                      
                </ul>

            </div>
        </div>
        <div class="div6 cadre_welcome"> 
            <div class="titre_welcome">Les 5 disiplines les moins avancées</div>
            <div class="">
                <ul>
                    @foreach($top5DisciplinesLesMoinsAvances as $discipline)
                        <div class="d-flex justify-content-between border-bottom my-1">
                            <div class="w-75 name">{{ $discipline->name }}</div>
                            <div class="w-25 text-end">{{$discipline->total}} élèves</div>
                        </div>
                    @endforeach                    
                </ul>

            </div>
        </div>

        <div class="div7 cadre_welcome">
            <div class="titre_welcome">Ma classe</div>  
            <div class="row">
                <div class="col-md-6">
            <table class="table table-striped table-sm">
                <tbody>
                    @foreach($listeDesEleves->take(12) as $eleve)
                    <tr>
                        <td><a href="{{ route('voirEleve', ['id' => $eleve->id]) }}">{{ $eleve->prenom.' '.$eleve->nom }}</a></td>
                        <td>{{ $eleve->genre }}</td>
                        <td>{{Carbon\Carbon::parse($eleve->ddn)->format('d/m/Y')}} <small>({{ $eleve->age }})</small></td>
                        <td>{{ $eleve->groupe }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                </div>
                <div class="col-md-6">

            <table class="table table-striped table-sm">
                <tbody>
                    @foreach($listeDesEleves->skip(12) as $eleve)
                    <tr>
                        <td><a href="{{ route('voirEleve', ['id' => $eleve->id]) }}">{{ $eleve->prenom.' '.$eleve->nom }}</a></td>
                        <td>{{ $eleve->genre }}</td>
                        <td>{{Carbon\Carbon::parse($eleve->ddn)->format('d/m/Y')}} <small>({{ $eleve->age }})</small></td>
                        <td>{{ $eleve->groupe }}</td>
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
