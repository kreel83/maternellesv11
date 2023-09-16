@extends('layouts.MainMenu', ['titre' => 'Formulaire de contact', 'menu' => 'contact'])

@section('content')

@include('contact.include.contact-form')

@endsection