@extends('layouts.mainMenu2', ['titre' => 'Ma classe', 'menu' => $type])
@php
    $degrades = App\Models\Enfant::DEGRADE;
@endphp

@section('content')

<div id="page_enfants" class="mt-5" >

    <div class="position-relative mx-5">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>
                    @if ($type == "affectation_groupe")
                        <li class="breadcrumb-item active" aria-current="page">Affectation des groupes</li>                                
                        <span class="help position-absolute" data-location="eleves.liste.groupe"><i class="fa-light fa-message-question"></i></span>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">Liste des enfants</li>
                        @if ($type == "avatar")
                            <span class="help position-absolute" data-location="eleves.liste.avatar"><i class="fa-light fa-message-question"></i></span>
                        @endif
                        @if ($type == "evaluation")
                            <span class="help position-absolute" data-location="eleves.liste.evaluation"><i class="fa-light fa-message-question"></i></span>
                        @endif
                        @if ($type == "reussite")
                            <span class="help position-absolute" data-location="eleves.liste.reussite"><i class="fa-light fa-message-question"></i></span>
                        @endif
                    @endif
            </ol>
        </nav>                
    </div>

        <div class="d-flex align-items-center mx-5">
            @if ($type == 'reussite')
                <div>
                    <a class="btnAction mt-0" href="{{ route('cahierManage') }}">Gestion des cahiers de réussites</a> 
                </div>
            @endif

            <form action="{{route('enfants')}}">
                <input type="hidden" value="{{$type}}" name="type">
                <div class="form-group my-5 d-flex align-items-center">
                    <select style="font-size: 14px" name="ordre" id="ordre" class="custom-select ms-3" onchange="this.form.submit()">
                            <option value="alpha" {{$ordre == 'alpha' ? 'selected' : null}}>Par ordre alphabétique</option>
                            <option value="groupe" {{$ordre == 'groupe' ? 'selected' : null}}>Par groupe</option>
                            <option value="age" {{$ordre == 'age' ? 'selected' : null}}>Par âge</option>
                    </select>                
                </div>                
            </form>                
        </div> 

        <div class="row gx-0">
                @if ($ordre == 'groupe')
                <div class="col-md-12 d-flex flex-column">
                        @foreach ( $enfants as $key=>$groupes )
                        <div class="d-flex flex-wrap my-5">
                                @foreach ($groupes as $kE=>$enfant)
                                @include('cards.enfant',['type' => $type])
                                @endforeach                                
                        </div>                              
                        @endforeach
                </div>
                @else
                        <div class="col-md-12 d-flex flex-wrap ps-5 card_enfant_container">
                                @foreach ($enfants as $kE=>$enfant)
                                @include('cards.enfant',['type' => $type,'kE' => $kE])
                                @endforeach                
                        </div>
                @endif

        </div>






 
</div>


@endsection
