@php
$degrades = App\Models\Enfant::DEGRADE;
//dd($degrades);
//dd($degrades[$enfant->background]);
@endphp

<!DOCTYPE html>
<html lang="fr">

    <head>

        <style>
            
            @page {
                margin: 0px;    /*60px;*/
            }
            

        @font-face {

            font-family: 'agba';
            src: url({{ storage_path('fonts\Agbalumo-Regular.ttf') }}) format("truetype");

            font-weight: 400; 
            font-style: normal; 
        }

        @font-face {

            font-family: 'script';
            src: url({{ storage_path('fonts\DancingScript-VariableFont_wght.ttf') }}) format("truetype");

            font-weight: 800; 
            font-style: normal; 
        }
        @font-face {

            font-family: 'frenchScript';
            src: url({{ storage_path('fonts\FrenchScriptMT.ttf') }}) format("truetype");

            font-weight: 400; 
            font-style: normal; 
        }



        @font-face {

            font-family: 'roboto';
            src: url({{ storage_path('fonts\Roboto-Regular.ttf') }}) format("truetype");
            f_ont-weight: 400; 
            f_ont-style: normal; 
            }



            .prenom {
                font-family: "Agbalumo";
                letter-spacing: 5px
            }


            .firstpage { 
                height: 100%;
                background-image:url({{ public_path('/img/pdf/cover2.jpg') }});
                background-size: cover;
            }

            .page {
                height: 100%;
                background-image:url({{ public_path('/img/pdf/page2.png') }});
                background-size: cover;
            }

            .body {
                padding: 60px 50px 20px 55px;
                font-family: "roboto";
                font-size: 13px;
            }

            .contenu {
                padding: 0px 50px 0px 50px;
            }

            header {
                position: fixed;
                top: 10px;  /*-60px*/
                left: 45px;
                right: 45px;
                height: 40px;
                font-size: 14px !important;
                text-align: center;
                line-height: 35px;
                width: 700px;
                b_order-bottom: 1px solid #000;
            }

            footer {
                position: fixed; 
                bottom: -11px;   /*-60px; */
                left: 0px; 
                right: 0px;
                height: 50px; 
                font-size: 12px !important;
                color: #7a9945;
                text-align: center;
                line-height: 30px;
                /*border-top: 1px solid #000;*/
            }
            .footerimgleft{
                position: fixed;
                left: 0px;
                bottom: 0px;
            }

            .pagenum:after {
                content: '{{ env('APP_NAME') }} - Page ' + counter(page);
            }

            Body {
                color: rgba(20, 20, 20, 0.98);
            }
            
            .cover {
                margin: 0px;
                height: 100%;
                background-image:url({{ public_path('/img/pdf/cover.jpg') }});
                background-repeat:no-repeat;
                background-position:left top;                
            }

            

            .titre {
                border-radius: 15px; 
                padding-top: 10px; 
                padding-bottom: 10px; 
                text-align: center; 
                font-size: 20px;
            }

            .titre-header {
                border-radius: 10px; 
                p_adding-top: 5px; 
                padding-bottom: 8px; 
                text-align: center; 
                font-size: 18px;
            }

            /* .titre-page {
                border-radius: 10px; 
                padding: 32px 8px 32px 8px;
                margin-bottom: 25px;
                text-align: left; 
                font-size: 22px;
                width: 560px
            } */

            .titre-page {
                margin-left: auto;
                margin-right: auto;
                border-radius: 10px; 
                padding: 32px 8px 32px 8px;
                margin-bottom: 25px;
                text-align: center; 
                font-size: 26px;
                width: 663px;
                font-family: 'script';
            }

            .table-carte {
                margin-left: auto;
                margin-right: auto;
                margin-bottom: 20px;
            }

            .text-container {
                margin-left: auto;
                margin-right: auto;
                width: 663px;
                text-align: left;
            }
            
            {{ $customClass }}

            p {
                margin: 0;
            }

            .page-break {
                page-break-after: always;
            }

            .card-pdf {
                width: 100%;
                height: 235px; /*250px;*/
                border: 2px solid grey;
                border-radius: 15px;
                position: relative;
            }

            .card-pdf .body {
                position: absolute;
                top: 150px;
                left: 0;
                font-size: 12px;
                padding: 4px;
                text-align: center;
                margin-top:15px;
                line-height: 12px;
            }

            .card-pdf .haut_carte {
                position: absolute;
                border-top-left-radius: 12px;
                border-top-right-radius: 12px;
                width: 100%;
                height: 45px;
                top:-1px;
                left:0
            }

            .card-pdf .titre1 {
                font-size: 10px;
                padding: 4px;
                font-weight: bold;
                text-align: center;
                color: white;
            }

            td:before  {
                content: "";
            }

            .image_card {
                position: absolute;
                top: 50px;
                left:0;
                width: 100%;
                height: 110px;
            }

            .equipe {
                font-size: 30px;
                font-weight: 400;
                text-align: center;
                margin-bottom: 30px;
                color: lightgrey;
            }
            .card-equipe {
                position: relative;
                height: 100px;
                width: 230px;
                float: left;
            }

            .card-equipe .nom {
                position: absolute;
                top: 10px;
                left: 10px;
                text-align: center;
                width: 230px;
            }
            .card-equipe .nom span {
                color: lightgrey;
            }
            .card-equipe .fonction {
                position: absolute;
                top: 60px;
                left: 10px;
                width: 230px;
                text-align: center;
            }

            .enfant {
                font-size: 40px;
                font-weight: 600;
                text-align: center;
                margin-bottom: 34px;
                margin-top: 6px;
                color: lightgrey;
            }

            .periode {
                font-size: 25px;
                font-weight: 400;
                text-align: center;
                margin-top: -2px;
                color: grey;
                /* width: 250px; */
            }
            .annee {
                font-size: 15px;
                font-weight: 800;
                text-align: center;
                margin-top: -40px;
                color: grey;
                /* width: 250px; */
            }

            .section {
                font-size: 25px;
                font-weight: 800;
                text-align: center;
                
                margin-top: 25px;
                color: black;
            }
            .enfant span {
                font-size: 60px;
            }
            .photo_enfant{
                width: 160px;
                height: 160px;
                text-align: center;
                margin: 0 auto;
                margin-bottom: 80px;
                border: 4px solid #6759FF;
                padding: 10px;
                border-radius: 50%;
                /*background-color: white;*/
                overflow: hidden;
                /*background-image: {{ $degrades[$enfant->background]}}*/
            }

            .equipes {
                margin-bottom: 100px;
            }

            .signature {
                margin-top: 50px;
            }
            .signature_title {
                font-size: 30px;
                font-weight: 400;
                text-align: center;
                margin-bottom: 10px;
                color: lightgrey;
            }

            .contenu_signature {
                height: 150px;
                width: 100%;
                border: 1px solid lightgrey;
                text-align: center;
                font-size: 12px;
            }

            .initiale {
                color:#6759FF;
            }
            .nom_ecole {
                font-size: 16px;
            }
            .adresse_ecole, .text_directeur {
                color: #000;
                font-size: 14px;
            }
            .nom_directeur {
                color: grey;
            }

            .position-equipe {
                position: absolute;
                top: 750px;
                left: 250px;
            }
            .position-adresse-ecole {
                position: absolute;
                top: 915px;
                left:0px;
                width: 100%;
                text-align: center;
                color: #EF5E61;
                font-weight: 600;
                /* left: 290px; */
            }
            /* .position-avatar {
                position: absolute;
                top: 480px;
                left: 400px;
            } */
            .position-prenom {
                position: absolute;
                top: 480px;
                left: 50%;
                /* transform: translate(-50%); */
            }

            
            .position-periode {
                position: absolute;
                top: 630px;
                left: 45%;
                /* transform: translate(-50%); */
            }
            .position-annee {
                position: absolute;
                top: 660px;
                left: 45%;
                /* transform: translate(-50%); */
            }

            .position-section {
                position: absolute;
                top: 550px;
                left: 50%;
                /* transform: translate(-50%); */
            }

            .equipe_array {
                width: 100vw;
            }
            .equipe_array tr {
                width: 100vw;
            }
            .equipe_array tr td {
                width: 50%;
            }

        </style>

    </head>
    <body>

<div class="firstpage">
    <div class="body">


    {{--
    <div class="enfant">Cahier de réussites <br> de <br>
        <span class="initiale"> {{$enfant->prenom[0]}}</span><span>{{substr($enfant->prenom,1)}}</span>
    </div>
    --}}

    {{--
    <div class="photo_enfant position-avatar">
        @if ($enfant->background)
            <div class="m-2 degrade_card_enfant animaux little" data-enfant="{{$enfant->id}}">
                <img src="{{ public_path('/img/animaux/' . $enfant->photo) }}" width="150">
            </div>
        @else
            <img src="{{ public_path('/img/animaux/' . $enfant->photo) }}" width="150">
        @endif
    </div>
    --}}

    <table width="100%" style="margin-top:168px;">
        <tr>
            <td align="center">
                <div class="e_nfant p_osition-prenom">
                    <span class="p_renom" style="font-family:'script';font-size:80px">
                         {!! $enfant->formatPdf() !!}
                    </span>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="section p_osition-section"  style="font-family:'frenchScript';font-size:50px">
                    {{$enfant->section()}}
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="periode p_osition-periode"  style="font-family: frenchScript; font-size: 50px">
                    {{$periode}}
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="annee p_osition-annee"  style="font-family:'frenchScript';font-size:50px">
                    {{App\utils\Utils::calcul_annee_scolaire_formated()}}
                </div>
            </td>
        </tr>
        <tr>
            <td>

                

                <table align="center" class="e_quipe_array" style="font-size: 12px;position: absolute; top: 670px; left: 130px; transform: rotate(3deg)">
                    <tr>
                        @if ($user->civilite == 'Mme')
                            <td style="font-weight: bolder; color: black">La maitresse</td>
                        @else
                            <td style="font-weight: bolder; color: black">Le maître</td>
                        @endif

                        
                        <td style='padding-left: 15px'>{{ucfirst(strtolower($user->prenom))}} {{strtoupper($user->name)}}</td>                
                    </tr>
                    @if ($equipes)
                    @foreach ($equipes as $equipe)
                    <tr>
                    @if ($equipe[2] == 'aesh' )
                        @if ($enfant->sh == 1) 

                            <td style="font-weight: bolder; color: black">{{App\Models\Equipe::FONCTIONS[$equipe[2]]}}</td>
                            <td style='padding-left: 15px'>{{$equipe[0]}}</td>
                    
                        @endif
                    @else
                
                            <td style="font-weight: bolder; color: black">{{App\Models\Equipe::FONCTIONS[$equipe[2]]}}</td>
                            <td style='padding-left: 15px'>{{$equipe[0]}}</td>

                
                    @endif
                        
                        
                    </tr>
                    @endforeach
                    @endif

                    @if ($enfant->directeur())
                    <tr>
                        <td style="font-weight: bolder; color: black">{{$enfant->directeur()[0] == 'mr' ? 'Le directeur' : 'La directrice'}}</td>
                        <td style='padding-left: 15px'>{{$enfant->directeur()[1]}}</td>
                    </tr>
                    @endif
                </table>
            </td>
        </tr>

    </table>


    
    <div class="position-adresse-ecole">
        <div class="nom_ecole">{{$user->name_ecole()->nom_etablissement}}</div>
        <div class="adresse_ecole">{{$user->name_ecole()->adresse_1}}</div>
        <div class="adresse_ecole">{{$user->name_ecole()->adresse_2}}</div>
        <div class="adresse_ecole">{{$user->name_ecole()->adresse_3}}</div>
        {{-- <div class="texte_directeur">{{$user->directeur == 0 ? 'Directeur ' : 'Directrice '}} : <span class="nom_directeur">{{$user->directeur == 0 ? 'Monsieur ' : 'Madame '}}{{$user->nom_directeur}}</span></div> --}}
    </div>

</div>
</div>


<div class="page-break"></div>

@foreach($resultats as $k => $section)

    {{-- <header><div class="titre-header titre{{$k}}">{{$sections[$k]['name']}}</div></header> --}}

    <div class="page">
    <div class="body">

        <div class="titre-page titre{{$k}}">{{$sections[$k]['name']}}</div>

        @php
            $carte = 1;
        @endphp
        {{-- <table style="margin-top:20px; border-spacing: 10px"> --}}
            {{-- <table style="margin-top:20px;" cellpadding="0"> --}}
                <table class="table-carte" cellpadding="0">
            <tr>
            @foreach ($section as $key =>$resultat)
                <td style="width: 160px; padding-right: 10px; padding-bottom:10px">
                    <div class="card-pdf" style="border-color: {{$resultat['color']}}">
                        <div class="haut_carte" style="background-color: {{$resultat['color']}}">
                            <p class="titre1 " >{{$resultat['name_section']}}</p>
                        </div>
                        @if ($resultat['image_nom'])
                        <img src="{{public_path('storage/items/'.$resultat["section_id"].'\\'.$resultat['image_nom'])}}" class="image_card">
                        @else
                        <img src="{{public_path('storage/items/none/'.$resultat["section_id"].'-none-color.png')}}" class="image_card">
                        @endif
                        <p class="body">{{$resultat['name']}}</p>
                    </div>
                </td>
                @if ($key != 0 && (($key - 3)  % 4 == 0))
                    </tr>
                    @if ($carte % 12 ==0)
                        @php
                            $carte = 1;
                        @endphp
                        </table>
                        </div>  <!-- class="body"> -->
                        </div>  <!-- class="page"> -->
                        <div class="page-break"></div>
                        {{-- <header><div class="titre-header titre{{$k}}">{{$sections[$k]['name']}}</div></header> --}}
                        <div class="page">
                        <div class="body">
                            <div class="titre-page titre{{$k}}">{{$sections[$k]['name']}}</div>
                            <table class="table-carte" cellpadding="0">
                    @endif
                    <tr>
                @endif
                @php
                    $carte++;
                @endphp
            @endforeach
            </tr>
        </table>

        </div>

    </div>  <!-- class="body"> -->
    </div> <!-- class="page"> -->
    <div class="page-break"></div>

    <div class="page">
    <div class="body">
    <div class="titre-page titre{{$k}}">{{$sections[$k]['name']}}</div>
    
    <div class="text-container">{!! $textesParSection[$k] !!}</div>

        {{-- @if ($carte > 8 )
            <!-- Si + de 8 cartes sur la page en cours on change de page pour écrire le commentaire -->
            </div>  <!-- class="body"> -->
            </div> <!-- class="page"> -->
            <div class="page-break"></div>
            <header><div class="titre-header titre{{$k}}">{{$sections[$k]['name']}}</div></header>
            <div class="page">
            <div class="body">
            <div class="titre-page titre{{$k}}">{{$sections[$k]['name']}}</div>
            {!! $textesParSection[$k] !!}
        @else
            <div class="contenu">
            {!! $textesParSection[$k] !!}
            </div>
        @endif --}}
        
    </div>  <!-- class="body"> -->
    </div> <!-- class="page"> -->

    <footer class="pagenum"></footer>
    {{-- <img src="{{ public_path('/img/pdf/gauche.jpg') }}" class="footerimgleft" height="50"> --}}

    <div class="page-break">
    </div>
    </div>

@endforeach

<!-- Commentaire général -->
{{-- <header><div class="titre-header titre0">{{ $enfant->prenom }}</div></header> --}}
<div class="page">
<div class="body">
    {{-- <div class="titre-page titre0">{{ $enfant->prenom }}</div> --}}
    <div class="titre-page titre0">Commentaire général</div>

    {!! $textesParSection[0] !!}

    <div class="signature">
        <div class="signature_title">Les signatures</div>
        <table style="border-spacing: 10px; bordert: 1px solid lightgray">
            <tr>
                @if ($user->civilite == 'Mme')
                    <td style="width: 210px"><div class="contenu_signature">la maîtresse</div></td>
                @else
                    <td style="width: 210px"><div class="contenu_signature">le maître</div></td>
                @endif
                @if ($user->directeur == 0)
                    <td style="width: 210px"><div class="contenu_signature">Le directeur</div></td>
                @else
                    <td style="width: 210px"><div class="contenu_signature">La directrice</div></td>
                @endif
                <td style="width: 210px"><div class="contenu_signature">Les parents</div></td>
            </tr>
        </table>
    </div>
</div>
</div>

</body>
</html>