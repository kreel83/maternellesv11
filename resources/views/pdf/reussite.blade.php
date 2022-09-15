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
</style>


<div style="position: relative">
    <img src="{{public_path('img/deco/fond.png')}}" alt="" class="fond" width="100%" height="100%" >
    <div style="position: absolute; top:200px; left:50%; transform: translateX(-120px); font-size: 30px; text-align: center">
        Cahier de progrès<br>
        de<br>
        <h2>{{$enfant->prenom}}</h2>

    </div>
</div>


@foreach($resultats as $k=>$section)
    <h3>{{$sections[$k]->name}}</h3>
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
            @if ($key != 0 && $key - 3  % 4 == 0)
                </tr>
                <tr>
            @endif
        @endforeach
    </table>
    <div class="page-break"></div>
@endforeach


{!! $reussite !!}
