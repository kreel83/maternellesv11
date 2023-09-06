@extends('layouts.mainMenu', ['titre' => 'Ma classe', 'menu' => 'cahier'])

@php
    $degrades = App\Models\Enfant::DEGRADE;
@endphp

@section('content')

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


<div id="page_enfants" class="row d-flex p-5 " >
        
        <div class="col-md-12 d-flex flex-wrap">
                @foreach ($enfants as $enfant)
                @include('cards.enfant',['type' => 'reussite'])
                @endforeach                
        </div>

</div>

@endsection
