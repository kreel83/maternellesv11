@extends('layouts.mainMenu', ['titre' => 'Détail de mon abonnement', 'menu' => 'detail'])

@section('content')
<div class="container mt-5">
    
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">

            <h1>Détail de mon abonnement</h1>

            <p>Statut : {{ $status }}</p>
            
            @if($status == 'actif')
                <p>Votre abonnement se terminera le {{ Carbon\Carbon::parse($expirationDate)->format('d/m/Y')}}.</p>
            @endif

            <p>{{ $message }}</p>
            <p>{{ $msgIfCanceled }}</p>



        </div>
    </div>

</div>
@endsection
