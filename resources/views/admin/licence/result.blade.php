@extends('layouts.admin', ['titre' => 'Gestion des licences', 'menu' => 'licence'])

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">

            <div class="card-body">

                @if($result == 'succeeded' || $result == 'true')

                    <div class="alert alert-success">
                        @if($method == 'purchase')
                            <p>Merci. Les nouvelles licences ont été ajoutées à votre compte.</p>
                        @else
                            <p>Merci. Les licences sélectionnées ont bien été renouvelées.</p>
                        @endif
                    </div>

                @else

                    <div class="alert alert-danger">
                        Une erreur est survenue : {{ $result }}
                    </div>

                @endif

                <p>Retrouvez toutes vos licences en <a href="{{ route('admin.licence.index') }}">cliquant ici</a>.</p>

            </div>
        </div>
    </div>
</div>

@endsection
