{{-- A inclure dans les vues qui peuvent afficher des erreurs ou des messages peronnalisés --}}

{{-- 
Gestion des succès / erreurs avec variable session 'status'
    'status' contient le type d'alert
    'msg' est le message affiché dans l'alert 
--}}

@if(session()->has('status'))

    @php
        $iconAlert = array(
            'success' => '<i class="fa-solid fa-circle-check"></i>',
            'info' => '<i class="fa-solid fa-circle-info"></i>',
            'danger' => '<i class="fa-solid fa-circle-exclamation"></i>',
            'warning' => '<i class="fa-solid fa-triangle-exclamation"></i>',
        );
    @endphp

    <div class="alert alert-{{ session('status') }}" role="alert">
        <span class="me-1">{!! $iconAlert[session('status')] !!}</span>
        @if(session()->has('msg'))
            {!! session('msg') !!}
        @endif
    </div>

@endif

{{-- Affiche les erreurs suite à un POST de formulaire --}}
@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <i class="fa-solid fa-circle-exclamation me-1"></i> {{ $error }}<br>
        @endforeach
    </div>
@endif