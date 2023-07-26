<style>



    .section0 {
        background-color: #3fbafe;
    }
    .section1 {
        background-color: #fa99b2;
    }
    .section2 {
        background-color: #58d5c9;
    }
    .section3 {
        background-color: #c0a3e5;
    }
    .section4 {
        background-color: #e5dd62;
    }
    .section5 {
        background-color: rgba(86, 88, 84, 0.98);
    }
    .section6 {
        background-color: rgba(202, 126, 49, 0.98);
    }



    p {
        margin: 0;
    }

    .page-break {
        page-break-after: always;
    }
    .card-pdf {
        width: 100%;
        height: 250px;
        border: 2px solid grey;
        border-radius: 15px;
        position: relative;
    }

    .card-pdf .titre2 {
        position: absolute;
        top: 150px;
        left: 0;
        font-size: 12px;
        padding: 4px;
        text-align: center;
        margin-top:15px;
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
        margin-bottom: 50px;
        color: lightgrey;
    }
    .card-equipe {
        position: relative;
        height: 300px;
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
        top: 230px;
        left: 10px;
        width: 230px;
        text-align: center;

    }
    .card-equipe .photo{
        position: absolute;
        top: 60px;
        left: 50px;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        overflow: hidden;

    }
    .card-equipe .photo img{
        width: 150px;
        height: 150px;
    }

    .enfant {
        font-size: 40px;
        font-weight: 600;
        text-align: center;
        margin-bottom: 50px;
        color: lightgrey;

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
        border: 4px solid grey;
        padding: 10px;
        border-radius: 50%;

        overflow: hidden;


    }

    .equipes {
        margin-bottom: 100px;
    }

    .signature {
        margin-top: 60px;
    }
    .contenu_signature {
        height: 150px;
        width: 100%;
        border: 1px solid lightgrey;
        text-align: center;
        font-size: 12px;
    }

    .initiale {
        color: grey;
    }
    .nom_ecole {
        font-size: 16px;
    }
    .adresse_ecole, .text_directeur {
        color: lightgrey;
        font-size: 14px;
    }
    .nom_directeur {
        color: grey;
    }
</style>


{{--<div style="position: relative">--}}
    {{--<img src="{{public_path('img/deco/fond.png')}}" alt="" class="fond" width="100%" height="100%" >--}}
    {{--<div style="position: absolute; top:200px; left:50%; transform: translateX(-120px); font-size: 30px; text-align: center">--}}
        {{--Cahier de progrès<br>--}}
        {{--de<br>--}}
        {{--<h2>{{$enfant->prenom}}</h2>--}}

    {{--</div>--}}
{{--</div>--}}

<div>
    <div class="enfant">Cahier de réussites <br> de <br>
        <span class="initiale"> {{$enfant->prenom[0]}}</span><span>{{substr($enfant->prenom,1)}}</span>
    </div>
    @if ($enfant->photo)
    <div class="photo_enfant">
        <img src="{{public_path('storage/'.$enfant->photo)}}" alt="">
    </div>
    @endif
    <div class="equipes">
        <div class="equipe" >L'équipe pédagogigue</div>
        <div class="card-equipe">
            <div class="nom">{{$user->prenom}}<br><span>{{$user->nom}}</span></div>
            <div class="photo">
                <img src="{{public_path('storage/'.$user->photo)}}" alt="">
            </div>
            <div class="fonction">~ La maitresse ~</div>
        </div>


            @foreach ($equipes as $equipe)
                <div class="card-equipe">
                    <div class="nom">{{$equipe->prenom}}<br><span>{{$equipe->name}}</span></div>
                    <div class="photo">
                        <img src="{{public_path('storage/'.$equipe->photo)}}" alt="">
                    </div>
                    <div class="fonction">~ {{$equipe->fonction}} ~</div>
                </div>


            @endforeach
    </div>

    <div>
        <div class="nom_ecole">{{$user->nom_ecole}}</div>
        <div class="adresse_ecole">{!! nl2br($user->adresse_ecole)  !!}</div>
        <div class="texte_directeur">{{$user->directeur == 0 ? 'Directeur ' : 'Directrice '}} : <span class="nom_directeur">{{$user->directeur == 0 ? 'Monsieur ' : 'Madame '}}{{$user->nom_directeur}}</span></div>
    </div>
</div>

<div class="page-break"></div>
@foreach($resultats as $k=>$section)


    <h3>{{$sections[$k]['name']}}</h3>
    <table style="border-spacing: 10px">
        <tr>
        @foreach ($section as $key =>$resultat)


            <td style="width: 160px">
                <div class="card-pdf" style="border-color: {{$resultat['color']}}">
                    <div class="haut_carte" style="background-color: {{$resultat['color']}}">
                        <p class="titre1 " >{{$resultat['name_section']}}</p>
                    </div>

                    <img src="{{public_path($resultat['image'])}}" alt="" class="image_card" >
                    <p class="titre2">{{$resultat['name']}}</p>
                </div>
            </td>
            @if ($key != 0 && (($key - 3)  % 4 == 0))
                </tr>
                <tr>
            @endif
        @endforeach
    </table>
    <div class="page-break"></div>
@endforeach

{{--<img src="{{public_path('img/deco/Commentaires.png')}}" alt="">--}}

{!! $reussite !!}
<div class="page-break"></div>
<div class="signature">
    <div class="equipe">Les signatures</div>
    <table style="border-spacing: 10px; bordert: 1px solid lightgray">
        <tr>
            <td style="width: 210px"><div class="contenu_signature">la maitresse</div></td>
            @if ($user->directeur == 0)
                <td style="width: 210px"><div class="contenu_signature">Le directeur</div></td>
            @else
                <td style="width: 210px"><div class="contenu_signature">La directrice</div></td>
            @endif
            <td style="width: 210px"><div class="contenu_signature">Les parents</div></td>
        </tr>
    </table>
</div>
