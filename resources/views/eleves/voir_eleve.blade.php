@extends('layouts.mainMenu2',['titre' => 'Ma classe', 'menu' => 'eleve'])

@section('content')

@include('eleves.include.voir_eleve')

@endsection
