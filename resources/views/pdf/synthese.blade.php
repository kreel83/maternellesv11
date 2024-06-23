@php
    use App\Models\AcquisScolaire;
    use App\Models\Synthese;
@endphp

<style>
    .page_break { page-break-before: always; }

    #syntheseArray,
    {
    font-size: 10px;
    border-collapse: collapse;

    }

    #syntheseArray td,
    #syntheseArray th {
        text-align: center;
        padding: 4px;

        border: 1px solid white;
    }

    #syntheseArray .left {
        text-align: left !important;
    }

    #syntheseObsArray,
    {
    font-size: 10px;
    border-collapse: collapse;

    }

    #syntheseObsArray td,
    #syntheseObsArray th {
        text-align: center;

        border: 1px solid white;
    }

    #syntheseObsArray .left {
        text-align: left !important;
    }




    .full-height {
        height: 100%;
        width: 100%;
        min-height: 100% !important;
        border: 1px solid orangered;
        font-size: 12px;
        text-align: left;
        padding: 8px;
        border-radius: 6px
    }

    .full-height.full-height:focus {
        border-width: 2px !important;
        outline-color: 2px !important;
        outline-color: orangered;
    }

    .orangered {
        color: orangered !important;

    }

    /* Cibler la dernière colonne pour enlever les bordures */
    .transparent {
        background-color: transparent !important;
        border-color: transparent !important;
        border-width: 0 transparent !important;
    }

    .saving {
        background-color: transparent !important;
        border: none !important;
    }

    .bleu_tres_clair {
        background-color: #DBE5F1;
    }

    .bleu {
        background-color: #C7E1F5;
    }

    .bleu_turquoise {
        background-color: #ACD4F1;
    }

    .bleu_fonce {
        background-color: #91C9ED;
    }


    .bleu_transparent {
        background-color: #DBE5F1;
        min-height: 80px;
    }

    .div_bleu_transparent {
        
        min-height: 35px;
    }

    .bleu_section {
        background-color: #DBE5F1;
    }

    .bleu_section_titre {
        background-color: #DBE5F1;
        color: blue;
        font-weight: bold;
        
        padding: 8px 12px;
    }

    .image_card {
        width: 160px
    }
</style>

<img src="{{ public_path('img/deco/ministere.png') }}" class="image_card">
<h5 style="text-align: center">Synthèse des acquis scolaires de l'élève à l'issue de la dernière année de la scolarité à
    l'école maternelle</h5>

<table class="table" id="syntheseArray">
    <tr>
        <th style="width: 40%; text-align: left;font-size: 9px">
            <div>
                Ecole : {{ $ecole }}
            </div>
            <div>
                Prénom et nom de l'enfant : {{ $enfant->prenom }} {{ $enfant->nom }}
            </div>

        </th>
        <th class="bleu" style="width: 10%">{{ $enfant->prenom }} ne réussit pas encore</th>
        <th class="bleu_turquoise" style="width: 10%">{{ $enfant->prenom }} est en voie de réussite</th>
        <th class="bleu_fonce" style="width: 10%">{{ $enfant->prenom }} réussit souvent</th>
        <th class="bleu_transparent" style="width: 30%">Points forts et besoins à prendre en compte</th>

    </tr>
    @foreach ($acquis as $key => $section)
        <tr>
            <td></td>
            <td class="left bleu_section_titre" colspan="4">{{ AcquisScolaire::getDescriptionSection($key) }}</td>

        </tr>
        <tr>

            <td class="left bleu_tres_clair">{{ $section[0]['description'] }}</td>
            <td class="bleu">{{ $acquis[$key][0]['note'] === 0 ? 'X' : null }} </td>
            <td class="bleu_turquoise">{{ $acquis[$key][0]['note'] === 1 ? 'X' : null }} </td>
            <td class="bleu_fonce">{{ $acquis[$key][0]['note'] === 2 ? 'X' : null }} </td>
            <td class="bleu_transparent" rowspan="{{ sizeof($section) }}" style="position: relative; padding: 4px; text-align: left; vertical-align: top">
                                    {!! nl2br($observations[$key] ?? null)  !!}
             

            </td>

        </tr>
        @foreach ($section as $k => $ligne)
            @if ($k != 0)
                <tr>
                    <td class="left bleu_tres_clair">{{ $ligne['description'] }}</td>
                    <td class="bleu">{{ $ligne['note'] === 0 ? 'X' : null }}</td>
                    <td class="bleu_turquoise">{{ $ligne['note'] === 1 ? 'X' : null }}</td>
                    <td class="bleu_fonce">{{ $ligne['note'] === 2 ? 'X' : null }}</td>
                    <td class="transparent"></td>
                </tr>
            @endif
        @endforeach
    @endforeach

</table>

<style>
    #syntheseObsArray {

    }
</style>

<div class="page_break"></div>

<table class="table bleu_transparent" id="syntheseObsArray" style="width: 100%">
    @foreach ($autres as $key => $section)
        <tr>
            <td class="bleu_section_titre">
                

                    {{ AcquisScolaire::getDescriptionSection($key) }}
                
            </td>
                
            <td class="bleu_section_titre">
            
                    Observations réalisées par l’enseignant(e)
                
            </td>

        </tr>


        @foreach ($section as $k => $ligne)
            <tr>
                <td style="width: 50%"  class="left">{{ $ligne['description'] }}</td>
                <td style="width: 50%;position: relative; padding: 0">
                    <div class="div_bleu_transparent" style="text-align: left; padding: 4px;">
                        {!! nl2br($ligne['observation'] ?? null) !!}
                    </div>

                    
                </td>


            </tr>
        @endforeach

    @endforeach
</table>

<style>
    #signature {
        margin-top: 50px;
        font-size: 12px;
        background-color: #FBD4B4;
        border-collapse: collapse;
        width: 100%;
        color: grey;

    }

    #signature table {
        border-collapse: collapse;

    }

    #signature th {
        font-size: 10px;
        border: 1px solid white;
    }

    #signature td {
        border: 1px solid white;
    }

    #signature .date {
        margin-top: 10px;
    }

    #signature .nom {
        margin-top: 8px;
    }

    #signature .signature {
        margin: 40px 0;
    }
</style>

<table id="signature">
    <tr>
        <th>Visa de l'enseignante / de l'enseignant de la classe</th>
        <th>Visa de la directrice / du directeur de l’école</th>
        <th>Visa des parents / responsables légaux</th>
    </tr>
    <tr>
        <td>
            <div>
                <div class="date">Date............</div>
                <div class="nom">Nom ............</div>
                <div class="signature">Signature</div>
            </div>
        </td>
        <td>
            <div>
                <div class="date">Date............</div>
                <div class="nom">Nom ............</div>
                <div class="signature">Signature</div>
            </div>
        </td>
        <td>
            <div>
                <div class="date">Date............</div>
                <div class="nom">Nom ............</div>
                <div class="signature">Signature</div>
            </div>
        </td>
    </tr>

</table>
