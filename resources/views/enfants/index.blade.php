@extends('layouts.mainMenu', ['titre' => 'Ma classe', 'menu' => $type])
@php
    $degrades = App\Models\Enfant::DEGRADE;
@endphp
@section('content')
<div id="page_enfants" class="" >
        @if ($type == "reussite")
                @if($canSendPDF)
                <div class="alert alert-success" role="alert">
                        <div class="row d-flex">
                                <div class="col">
                                                Tous les cahiers de réussite sont prêts. 
                                </div>
                                <div class="col">
                                                <a href="{{ route('envoiCahier') }}" class="btn btn-success text-right">Envoyer aux parents</a>
                                </div>
                        </div>
                </div>
                @else
                        <div class="alert alert-warning" role="alert">
                                <div class="row d-flex">
                                        <div class="col">
                                                        Tous les cahiers de réussite ne sont pas prêts. 
                                        </div>		
                                </div>
                        </div>
                @endif
        @endif
        <div class="d-flex justify-content-center w-100">
                <form action="{{route('enfants')}}">
                        <input type="hidden" value="{{$type}}" name="type">
                        <div class="form-group my-5 d-flex align-items-center">
                                <div for="ordre">Classement</div>
                                <select name="ordre" id="ordre" class="custom-select ms-3" onchange="this.form.submit()">
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
                                @foreach ($groupes as $enfant)
                                @include('cards.enfant',['type' => $type])
                                @endforeach                                
                        </div>                              
                        @endforeach
                </div>
                @else
                        <div class="col-md-12 d-flex flex-wrap">
                                @foreach ($enfants as $enfant)
                                @include('cards.enfant',['type' => $type])
                                @endforeach                
                        </div>
                @endif

        </div>






 
</div>


@endsection
