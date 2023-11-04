@php
    $degrades = App\Models\Enfant::DEGRADE;
    $lesgroupes = json_decode(Auth::user()->groupes, true);
@endphp


    <nav class="my5" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
    aria-label="breadcrumb">
    
    
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('depart') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ma classe</li>
    </ol>
    
    </nav>

    <div class="mb-3">
        <a href="{{ route('addEleve') }}" class="btn btn-primary">Ajouter un élève</a>
        <a href="#" class="btn btn-primary">Importer un élève</a>
    </div>

<div class="row">
    <div class="col-md-6">
        <table class="table  table-sm classe_dashboard">
            <tbody>
                @foreach ($listeDesEleves->take($middle) as $eleve)
                    @php
                        $groupe = null;
                        if (!is_null($eleve->groupe)) {
                            $groupe = $lesgroupes[$eleve->groupe];
                        }
                    @endphp
                    <tr class="">
                        <td>
                            <div class="m-2 degrade_card_enfant animaux"
                                style="background-image: {{ $degrades[$eleve->background] ?? $degrades['b1'] }}; width: 27px; height: 27px"
                                data-degrade="{{ $eleve->background }}" data-animaux="{{ $eleve->photo }}">
                                <img src="{{ asset('/img/animaux/' . $eleve->photo) }}" alt="" width="30">
                            </div>
                        </td>
                        <td class="name {{ $eleve->genre }}">
                            <div>
                                <a href="{{ route('voirEleve', ['enfant_id' => $eleve->id]) }}">
                                    {{ $eleve->prenom . ' ' . $eleve->nom }}
                                </a>

                            </div>
                            <div style="color: lightgrey;">
                                {{ Carbon\Carbon::parse($eleve->ddn)->format('d/m/Y') }}
                                <small>({{ $eleve->age }})</small>
                            </div>
                        </td>

                        <td>
                            @if (!$eleve->mail)
                                <div class="dashboard_mail">

                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                            @endif

                        </td>
                        <td>
                            <div class="groupe-terme {{ isset($groupe) ? null : 'd-none' }}"
                                style="background-color: {{ $groupe['backgroundColor'] ?? '' }}; color:{{ $groupe['textColor'] ?? '' }}">
                                {{ $groupe['name'] ?? '' }}</div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>




    </div>
    <div class="col-md-6">



        <table class="table table-sm classe_dashboard">
            <tbody>
                @foreach ($listeDesEleves->skip($middle) as $eleve)
                    @php
                        $groupe = null;
                        if (!is_null($eleve->groupe)) {
                            $groupe = $lesgroupes[$eleve->groupe];
                        }
                    @endphp
                    <tr class="">
                        <td>
                            <div class="m-2 degrade_card_enfant animaux"
                                style="background-image: {{ $degrades[$eleve->background] }}; width: 27px; height: 27px"
                                data-degrade="{{ $eleve->background }}" data-animaux="{{ $eleve->photo }}">
                                <img src="{{ asset('/img/animaux/' . $eleve->photo) }}" alt="" width="30">
                            </div>
                        </td>
                        <td class="name {{ $eleve->genre }}">
                            <div>
                                <a href="{{ route('voirEleve', ['enfant_id' => $eleve->id]) }}">
                                    {{ $eleve->prenom . ' ' . $eleve->nom }}
                                </a>

                            </div>
                            <div style="color: lightgrey;">
                                {{ Carbon\Carbon::parse($eleve->ddn)->format('d/m/Y') }}
                                <small>({{ $eleve->age }})</small>
                            </div>
                        </td>

                        <td>
                            @if (!$eleve->mail)
                                <div class="dashboard_mail">

                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                            @endif

                        </td>
                        <td>
                            <div class="groupe-terme {{ isset($groupe) ? null : 'd-none' }}"
                                style="background-color: {{ $groupe['backgroundColor'] ?? '' }}; color:{{ $groupe['textColor'] ?? '' }}">
                                {{ $groupe['name'] ?? '' }}</div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
