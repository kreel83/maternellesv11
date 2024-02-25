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
        </div>

        <div class="container">

            <div class="text-center">
                <h5 class="mb-3">Oups ! Une erreur est survenue</h5>
                <p>Merci de réessayer ultérieurement.</p>
                <p>Si le problème persiste veuillez contacter l'enseignant(e) de votre enfant.</p>
            </div>

        </div>

    </div>
    
@endsection

