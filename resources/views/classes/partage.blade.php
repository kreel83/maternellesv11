@extends('layouts.mainMenu2',['titre' => 'Partage de classe', 'menu' => 'createClasse'])

@php
    // dd($resultats);
@endphp

@section('content')
@include('partage.include_partage')
@endsection