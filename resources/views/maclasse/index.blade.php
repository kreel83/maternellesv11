@extends('layouts.mainMenu2', ['titre' => 'Mes fiches','menu' => 'maclasse'])

@section('content')

<div id="maclasse" class="mt-5">

    <h1>ma classe</h1>
    @include('include.maclasse')
</div>

@endsection