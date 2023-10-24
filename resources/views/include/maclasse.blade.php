@php
    $degrades = App\Models\Enfant::DEGRADE;
    $lesgroupes = json_decode(Auth::user()->groupes, true);
@endphp

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
                                <a href="{{ route('voirEleve', ['id' => $eleve->id]) }}">
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
                                <a href="{{ route('voirEleve', ['id' => $eleve->id]) }}">
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
