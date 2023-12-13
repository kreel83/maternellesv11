@php
    $degrades = App\Models\Enfant::DEGRADE;
    $lesgroupes = json_decode(Auth::user()->groupes(), true);

@endphp

    @if (!isset($is_dashboard))
    <nav class="my5" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
    aria-label="breadcrumb">
    
    
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('depart') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ma classe</li>
    </ol>
    
    </nav>
    @endif

    @if (!isset($is_dashboard) || $listeDesEleves->isEmpty())
    <div class="row mb-3 d-flex align-items-center justify-content-between">
        <div class="col-xs-12 col-xl-4 d-flex ">
            <a href="{{ route('addEleve') }}" class="btnAction me-3">Ajouter un élève</a>
            <a href="{{route('import')}}" class="btnAction ">Importer un élève</a>
        </div>
        {{-- <form action="{{ route('modifyclasse') }}" method="post" class="col-xs-12 col-xl-8 d-flex align-items-end justify-content-end">
            @csrf
            <input type="hidden" name="id" value="{{Auth::user()->classe_active()->id}}">
        
            <div class="me-4">

                <input type="text" name="description" class="form-control input-sm" style="width: 300px" value="{{Auth::user()->classe_active()->description}}">
            </div>
            <div class="form-group">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="ps" name="section[]" {{ Auth::user()->classe_active()->ps == 1 ? 'checked' : null}}>
                    <label class="form-check-label" for="inlineCheckbox1">PS</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="ms" name="section[]" {{ Auth::user()->classe_active()->ms == 1 ? 'checked' : null}}>
                    <label class="form-check-label" for="inlineCheckbox2">MS</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="gs" name="section[]" {{ Auth::user()->classe_active()->gs == 1 ? 'checked' : null}}>
                    <label class="form-check-label" for="inlineCheckbox3">GS</label>
                </div>
            </div>
            <button class="btnAction" type="submit">Sauvegarder la classe</button>

               
    </form> --}}
    </div>

    @endif

<div class="row">
    <div class="col-md-6">
        <table class="table  table-sm classe_dashboard white">
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
                                @if (env('APP_DEMO'))
                                <a href="{{ route('voirEleve', ['enfant_id' => $eleve->id]) }}">                                   
                                    {{$eleve->prenom. ' ' }}
                                    <span class="blur">{{$eleve->nom}}</span>
                                </a>
                                @else
                                <a href="{{ route('voirEleve', ['enfant_id' => $eleve->id]) }}">
                                    {{$eleve->prenom . ' ' . $eleve->nom}}
                                </a>
                                @endif

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



        <table class="table table-sm classe_dashboard white">
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

                                @if (env('APP_DEMO'))
                                <a href="{{ route('voirEleve', ['enfant_id' => $eleve->id]) }}">                                   
                                    {{$eleve->prenom. ' ' }}
                                    <span class="blur">{{$eleve->nom}}</span>
                                </a>
                                @else
                                <a href="{{ route('voirEleve', ['enfant_id' => $eleve->id]) }}">
                                    {{$eleve->prenom . ' ' . $eleve->nom}}
                                </a>
                                @endif

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
                                style="background-color: {{ $groupe['backgroundColor'] ?? '' }}; color:{{ $groupe['textColor'] ?? '' }} ; border: 1px solid {{$groupe["textColor"] ?? 'transparent'}}" >
                                {{ $groupe['name'] ?? '' }}</div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
