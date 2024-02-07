@extends('layouts.mainMenu2', ['titre' => 'Les paramètres', 'menu' => 'mails'])

@section('content')
<div id="phrasesView" class="mt-5">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>        
        <li class="breadcrumb-item active" aria-current="page">Personalisation des mails</li>
        <span class="help position-absolute" data-location="phrases.creation.main"><i class="fa-light fa-message-question"></i></span>
      </ol>
    </nav>



  

@endsection
