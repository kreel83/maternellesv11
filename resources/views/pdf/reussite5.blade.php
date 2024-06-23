<!DOCTYPE html>
<html lang="fr">

    <head>
        <link rel="icon" href="{{ asset('favicon/favicon.ico') }}">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            
            @page {
                margin: 0px;    /*60px;*/
            }
            

        @font-face {

            font-family: 'agba';
            src: url({{ storage_path('fonts/Agbalumo-Regular.ttf') }}) format("truetype");

  
            font-style: normal; 
        }

        @font-face {

            font-family: 'script';
            src: url({{ storage_path('fonts/DancingScript-VariableFont_wght.ttf') }}) format("truetype");

       
            font-style: normal; 
        }
        @font-face {

            font-family: 'frenchScript';
            src: url({{ storage_path('fonts/FrenchScriptMT.ttf') }}) format("truetype");

            font-style: normal; 
        }



        @font-face {

            font-family: 'roboto';
            src: url({{ storage_path('fonts/Roboto-Regular.ttf') }}) format("truetype");
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
                content: '{{ config('app.name') }} - Page ' + counter(page);
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
                margin-left: auto;
                margin-right: auto;
                border-radius: 10px; 
                padding: 32px 8px 32px 8px;
                margin-bottom: 25px;
                text-align: center; 
                font-size: 26px;
                width: 663px;
                font-family: 'script';
            } */

            .titre-page-1-ligne {
                margin-left: auto;
                margin-right: auto;
                border-radius: 10px; 
                padding: 28px 8px 32px 8px;
                margin-bottom: 25px;
                text-align: center; 
                font-size: 27px;
                width: 663px;
                font-family: 'script';
            }

            .titre-page-2-lignes {
                margin-left: auto;
                margin-right: auto;
                border-radius: 10px; 
                padding: 9px 8px 14px 8px;
                margin-bottom: 25px;
                text-align: center; 
                font-size: 27px;
                width: 663px;
                font-family: 'script';
            }

            .table-carte {
                m_argin-left: auto;
                m_argin-right: auto;
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
                background-color: white;
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
                font-size: 12px;
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

            /* .enfant {
                font-size: 40px;
                font-weight: 600;
                text-align: center;
                margin-bottom: 34px;
                margin-top: 6px;
                color: lightgrey;
            } */
            .enfant {
                text-align: center;
                font-family:'script';
                font-size:80px;
            }

            .section {
                font-size: 25px;
                text-align: center;
                margin-top: 25px;
                color: black;
                font-family: frenchScript; 
                font-size:50px;
            }

            .periode {
                margin-top: -2px;
                text-align: center;
                color: grey;
                font-family: 'frenchScript';
                font-size: 50px;
            }

            .annee {
                text-align: center;
                margin-top: -40px;
                color: grey;
                font-family: 'frenchScript';
                font-size: 50px;
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
                <td>
                    {{-- <div class="enfant" style="font-family:'script';font-size:80px"> --}}
                    <div class="enfant">
                        {!! $enfant->formatPdf() !!}
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    {{-- <div class="section" style="font-family: frenchScript; font-size:50px"> --}}
                    <div class="section">
                        {{$enfant->section()}}
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    {{-- <div class="periode" style="font-family: frenchScript; font-size: 50px"> --}}
                    <div class="periode">
                        {{$periode}}
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    {{-- <div class="annee" style="font-family:'frenchScript';font-size:50px"> --}}
                    <div class="annee">
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
                        @if ($classeUsers)
                            @foreach ($classeUsers as $classeUser)
                                <tr>
                                @if ($classeUser->civilite == 'Mme')
                                    <td style="font-weight: bolder; color: black">
                                        La maitresse<br>
                                        @if ($classeUser->role == 'co')
                                            cotitulaire
                                        @else
                                            suppléante
                                        @endif
                                    </td>
                                @else
                                    <td style="font-weight: bolder; color: black">
                                        Le maître<br>
                                        @if ($classeUser->role == 'co')
                                            cotitulaire
                                        @else
                                            suppléant
                                        @endif
                                    </td>
                                @endif
                                <td style='padding-left: 15px'>{{ucfirst(strtolower($classeUser->prenom))}} {{strtoupper($classeUser->name)}}</td>
                                </tr>
                            @endforeach
                        @endif
                        @if ($equipes)
                            
                            @foreach ($equipes as $equipe)
                                <tr>
                                @if ($equipe[1] == 'aesh' )
                                    @if ($enfant->sh == 1) 
                                        <td style="font-weight: bolder; color: black">{{App\Models\Equipe::FONCTIONS[$equipe[1]]}}</td>
                                        <td style='padding-left: 15px'>{{$equipe[0]}}</td>
                                    @endif
                                @else
                                    <td style="font-weight: bolder; color: black">{{App\Models\Equipe::FONCTIONS[$equipe[1]]}}</td>
                                    <td style='padding-left: 15px'>{{$equipe[0]}}</td>
                                @endif
                                </tr>
                            @endforeach
                        @endif


                        @if ($classe->directeur())
                        <tr>
                            <td style="font-weight: bolder; color: black">{{$classe->directeur()->civilite == 'M.' ? 'Le directeur' : 'La directrice'}}</td>
                            <td style='padding-left: 15px'>{{$classe->directeur()->prenom.' '.$classe->directeur()->nom}}</td>
                        </tr>
                        @endif

                    </table>
                </td>
            </tr>

        </table>
        
        <div class="position-adresse-ecole">
            <div class="nom_ecole">{{$ecole->nom_etablissement}}</div>
            <div class="adresse_ecole">{{$ecole->adresse_1}}</div>
            <div class="adresse_ecole">{{$ecole->adresse_2}}</div>
            <div class="adresse_ecole">{{$ecole->adresse_3}}</div>
        </div>

    </div>
</div>

<div class="page-break"></div>

@foreach($resultats as $k => $section)

    <div class="page">
        <div class="body">

            <div class="{{ $sections[$k]['class'] }}">{!! $sections[$k]['name'] !!}</div>

            @php
                $carte = 1;
            @endphp

                <table class="table-carte" cellpadding="0">
                <tr>
                @foreach ($section as $key => $resultat)
                    <td style="width: 160px; padding-right: 10px; padding-bottom:10px">
                        <div class="card-pdf" style="border-color: {{$resultat['color']}}">
                            <div class="haut_carte" style="background-color: {{$resultat['color']}}">
                                <p class="titre1 " >{{$resultat['section2']}}</p>
                            </div>
                            <div class="bas_carte">
                                @if ($resultat['image_nom'])
                                    <img width="160" height="120" src="{{public_path('storage/items/'.$resultat["section_id"].DIRECTORY_SEPARATOR.$resultat['image_nom'])}}" class="image_card">
                                @else
                                    <img src="{{public_path('storage/items/none/'.$resultat["section_id"].'-none-color.png')}}" class="image_card">
                                @endif
                                <p class="body">{{$resultat['name']}}</p>                            
                            </div>

                        </div>
                    </td>
                    @if ($key != 0 && (($key - 3)  % 4 == 0))
                        </tr>
                        {{-- Saut de page si 12 fiches sur la page ET d'autres fiches a imprimer --}}
                        @if ($carte % 12 == 0 && count($section) > 12)
                            @php
                                $carte = 1;
                            @endphp
                            </table>
                            </div>  <!-- class="body"> -->
                            </div>  <!-- class="page"> -->

                            <div class="page-break"></div>

                            <div class="page">
                            <div class="body">

                                <div class="{{ $sections[$k]['class'] }}">{!! $sections[$k]['name'] !!}</div>
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

    @if (Auth::user()->classe_active()->textes_dans_pdf == 'between')
        <div class="page-break"></div>

        <div class="page">
            <div class="body">

                <div class="{{ $sections[$k]['class'] }}">{!! $sections[$k]['name'] !!}</div>
                <div class="text-container">{!! str_replace(chr(13), '<br>', $reussiteSections[$k]) !!}</div>
                
            </div>  <!-- class="body"> -->
        </div> <!-- class="page"> -->
    @endif

    <footer class="pagenum"></footer>

    <div class="page-break"></div>

@endforeach

@if (Auth::user()->classe_active()->textes_dans_pdf == 'bottom')
    
    <div class="page">
        <div class="body">

            @php
                $compteur_resultats = 1;
                $compteur = 0;
                $compteur_max = 35;
            @endphp

            @foreach($resultats as $k => $section)
{{-- {{ $reussiteSections[$k] }} --}}
                @php
                    $lignes = explode('</p>', $reussiteSections[$k]);
                    $compteur = $compteur + 5;              // titre de la section
                @endphp
                @if ($compteur > $compteur_max)
                    </div>  <!-- class="body"> -->
                    </div> <!-- class="page"> -->
                    <div class="page-break"></div>
                    <div class="page">
                    <div class="body">
                    @php
                        $compteur = 0;
                    @endphp
                @endif

                <div class="{{ $sections[$k]['class'] }}">{!! $sections[$k]['name'] !!}</div>

                @foreach ($lignes as $ligne)
                    <div class="text-container">
                        {!! $ligne.'</p>' !!}
                    </div>
                    @php
                        $compteur = $compteur + 1;
                    @endphp
                    @if ($compteur > $compteur_max && $compteur_resultats != count($resultats))
                        </div>  <!-- class="body"> -->
                        </div> <!-- class="page"> -->
                        <div class="page-break"></div>
                        <div class="page">
                        <div class="body">
                        @php
                            $compteur = 0;
                        @endphp
                    @endif
                @endforeach

                {{-- <div class="text-container">{!! str_replace(chr(13), '<br>', $reussiteSections[$k]) !!}</div> --}}
                <br>
                @php
                    $compteur_resultats = $compteur_resultats + 1;
                @endphp

            @endforeach
            
        </div>  <!-- class="body"> -->
    </div> <!-- class="page"> -->

    <footer class="pagenum"></footer>

@endif

{{-- Commentaire général --}}
<div class="page">
    <div class="body">

        <div class="titre-page-1-ligne titre0">Commentaire général et signature</div>

        {!! $reussite->commentaire_general !!}

        <div class="signature">
            <div class="signature_title">Les signatures</div>
            <table style="border-spacing: 10px; width:100%">
                <tr>
                    <td style="">
                        <div class="contenu_signature">
                            {{ $user->civilite == 'Mme' ? 'La maîtresse' : 'Le maître' }}
                        </div>
                    </td>

                    <td style="">
                        <div class="contenu_signature">
                            {{ $classe->directeur_civilite() == 'Mme' ? 'La directrice' : 'Le directeur' }}
                        </div>
                    </td>

                    <td style="">
                        <div class="contenu_signature">
                            Les parents
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

</body>
</html>