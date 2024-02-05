@extends('layouts.parentLayout', ['titre' => 'Téléchargement du cahier de réussites'])

@section('content')


    <style>
        .jour_bloc,
        .mois_bloc,
        .annee_bloc {
            width: 116px;
            height: 120px;
            border: 1px solid grey;
            background-color: white;
            margin: 0 10px;
            border-radius: 15px;
            overflow: hidden;

        }
        .jour_bloc input,
        .mois_bloc input,
        .annee_bloc input {
            width: 108px;
            font-size: 56px;
            padding: 0 10px 0 12px;
            letter-spacing: 12px;
            border-radius: 25px;
            font-weight: bolder;
            color: green;
            caret-color: transparent;
            border: none;
            outline: none;
            padding-left: 12px;
        }
        .jour_bloc.focus,
        .mois_bloc.focus,
        .annee_bloc.focus {
            border: 4px solid green;
        }

        .annee_bloc {
            width: 214px
        }
        .annee_bloc input {
            width: 200px
        }

        #espaceParent {
            width: 100vw;
            height: 100vh;
            display: flex;
            flex-direction: column;
            /* justify-content: center; */
            align-items: center;
            /* background: linear-gradient(135deg, var(--main-color) 10%, var(--third-color) 100%); */
            background: #FFF9F5
        }

        .label_jour {
            background-color: white;
            padding: 2px 4px;
            color: black;
            position: absolute;
            top: 2px;
            left: 35px;
            font-size: 14px;
        }

        .label_mois {
            background-color: white;
            padding: 2px 4px;
            color: black;
            position: absolute;
            top: 2px;
            left: 35px;
            font-size: 14px;
        }

        .label_annee {
            background-color: white;
            padding: 2px 4px;
            color: black;
            position: absolute;
            top: 2px;
            left: 78px;
            font-size: 14px;
        }

        .trait {
            padding: 2px 4px;
            color: black;
            position: absolute;
            left: 0px;
            top: 95px;
            display: flex;
            width: 100px;
            justify-content: space-between;
            padding: 0 12px;

        }

        .trait div {
            width: 30px;
            height: 3px;

            background-color: lightgray;
        }

        .btn-go {
            w_idth: 350px;
            h_eight: 70px;
            border-radius: 40px;
            background-color: green;
            color: white;
            text-align: center;
            l_ine-height: 70px;
            border: none;
            outline: none;
            margin: 0 auto;
            text-decoration: none;
            padding: 10px;
            font-size:20px;
        }
        .btn-go:hover {
            color: white ! important;
        }
        .btn-go.focus {
            border: 2px solid white;    
        }
        .orange {
            background-color: orange !important;
        }
        .bleu {
            background-color: rgb(73, 73, 228) !important;
        }

        .alerte {
            font-size: 20px;
            color: red;
            background-color: white;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
            border-radius: 40px;
            font-weight: bold;

        }
        ::placeholder {
            color: lightgray;
            opacity: 0.3; /* Firefox */
        }
        .trait .focus {
            background-color: green;
        }


        .header {
            padding: 10px;
            background: linear-gradient(135deg, var(--main-color) 10%, var(--third-color) 100%);
        }
        .bulle {
            /* height:100px; */
        }
        .enseignant {
            color: #ffffff;
            text-align: center;
        }
    </style>

    <div class="pt-3" id="e_spaceParent">

        <div class="d-flex justify-content-between align-items-center header mb-3">
            <div>
               <img class="img-fluid" src="{{asset('img/deco/logo.png')}}" width="200">
            </div>
            <div class="enseignant">
                {{ $user->civilite == 'Mme' ? 'La maîtresse' : 'Le maître' }}<br>
                {{ucfirst(strtolower($user->prenom))}} {{strtoupper($user->name)}}
            </div>
        </div>

        <div class="container">

            <div class="text-center">
                <div class="fs-1"><span class="fw-bold">B</span>ienvenue</div>
                <div class="fs-4">dans la section de téléchargement du cahier de réussite de</div>
                <div class="fs-1 fw-bolder">{!! $enfant->formatPdf() !!}</div>
            </div>
        

            @if (session('success'))

                <div class="d-flex justify-content-center mt-4">
                    <a href="{{ route('cahier.seepdf', ['token' => session('token'), 'state' => 'see']) }}" class="btn-go bleu" target="_blank">Voir le cahier de réussite</a>
                </div>         
                <div class="d-flex justify-content-center mt-4">
                    <a href="{{ route('cahier.seepdf', ['token' => session('token'), 'state' => 'download']) }}" class="btn-go orange" target="_blank">Télécharger le cahier de réussite</a>
                </div>         

            @else

                <form class="row justify-content-center" action="{{ route('cahier.predownload.post') }}" method="POST">
                @csrf

                    <input type="hidden" name="token" value="{{ $token }}">
             
                    <p class="text-center">Veuillez renseigner la date de naissance de votre enfant :</p>

                    <div class="d-flex justify-content-center">
                    @include('include.display_msg_error')
                    </div>

                    <div class="col-auto">
                        <input type="number" class="form-control-lg me-2 mt-1" name="jour" placeholder="Jour de naissance" value="{{ old('jour') }}" autofocus>
                    </div>
                    <div class="col-auto">
                        <input type="number" class="form-control-lg me-2 mt-1" name="mois" placeholder="Mois de naissance" value="{{ old('mois') }}">
                    </div>
                    <div class="col-auto">
                        <input type="number" class="form-control-lg me-2 mt-1" name="annee" placeholder="Année de naissance" value="{{ old('annee') }}">
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" class="btn-go w-50">Vérifier</button>
                    </div>

                </form>

            @endif

            <div class="row mb-3 mt-4">

                <div class="col-sm-6 mt-2">
                    <div class="card bulle">
                        <div class="card-body">
                            {{ $enfant->section() }}<br>
                            {{ $periode }}<br>
                            {{ App\utils\Utils::calcul_annee_scolaire_formated() }}
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 mt-2">
                    <div class="card bulle">
                        <div class="card-body">
                            {{$ecole->nom_etablissement}}<br>
                            {{$ecole->adresse_1}}<br>
                            {{$ecole->adresse_3}}
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    
@endsection

