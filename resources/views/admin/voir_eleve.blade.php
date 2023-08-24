@extends('layouts.admin', ['titre' => 'Bienvenue sur votre espace administration', 'menu' => 'dashboard'])

@section('content')

@include('eleves.include.voir_eleve')

@endsection
