@extends('layouts.mainMenu2', ['titre' => 'Les paramètres', 'menu' => 'mails'])

@section('content')

<div id="phrasesView" class="mt-5">

    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>        
        <li class="breadcrumb-item active" aria-current="page">Personnalisation des mails</li>
        <span class="help position-absolute" data-location="phrases.creation.main"><i class="fa-light fa-message-question"></i></span>
      </ol>
    </nav>    

    <div class="mt-3">

      <div class="d-flex" id="customMailStatus"></div>


      <p>Vous pouvez créer le mail qui sera envoyé aux parents avec le lien de téléchargement du cahier de réussites.</p>
      <p>Si vous laissez cette zone vide, notre mail par défaut sera utilisé.</p>
      <div id="customMail" data-origine="true"  style="min-height: 100px; height: auto;max-width: 820px; min-height: 400px" class="ql-container ql-snow customMail position-relative">
        {!! $message !!}
      </div>
      <button class="btnAction" id="saveCustoMail">Sauvegarder</button>

    </div>

</div>

@endsection
