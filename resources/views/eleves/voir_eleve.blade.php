@extends('layouts.mainMenu',['titre' => 'Ma classe', 'menu' => 'eleve'])

@section('content')

@include('eleves.include.voir_eleve')

@endsection
