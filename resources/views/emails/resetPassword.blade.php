<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmation d'inscription</title>

    <style>

        img{
            vertical-align: middle;
            border-style: none;
        }
        body {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif !important;
        }

        #BodyMail {
            background-color: #F7FBFF;
            padding: 50px 0px;
        }



        .header {
            text-align: center;
            padding: 2px 12px;
            margin-bottom: 40px;
            width: fit-content;
            margin: 30px auto;
        }
        /*
        .header {
            text-align: center;
            background-color: #184c80;
            border-radius: 10px;
            padding: 2px 12px;
            margin-bottom: 60px;
            color: white;
            font-weight: bolder;
            font-size: 40px;
            width: fit-content;
            margin: 30px auto;
        }
        */

        .header h1 {
            color: white;
            font-weight: bold;
            font-size: 30px;
            letter-spacing: -1px;
        }

        #body {
            margin: 0 7%;
            margin-top: 100px;
            border: 2px solid #c9e1f8ef;
            padding: 20px 30px;
            border-radius: 8px; 
            background-color: white;
            width: 500px;
            margin: 70px auto;
            font-size: 14px;
        }

        #body a {
            color: #1071e0;
        }

        #body .prenom {
            color: #1071e0;
        }

        #MailFooter {
            font-size: 14px;
            text-align: center;
            font-weight: 700;
            letter-spacing: 2px;
            /* En rouge le bck-c ? */
            background-color: #3d6baa;	
            color: white;
            margin: 0 10%;
        }


        .align-items-center {
            align-items: center!important;
        }
        .justify-content-center {
            justify-content:center!important;
        }
        #MailFooter a,.MailFooter a {
            color: white;
        }

    </style>
</head>
<body id="BodyMail">

    <div class="header">
        {{--<h1>Les Maternelles</h1>--}}
        <img src="{{ $message->embed($logo) }}" alt="" width="200">
    </div>

    <div id="body">
        <p>
            Bonjour <span class="prenom">{{ ucfirst($prenom) }}</span>
            <br><br>
            Nous avons reçu une demande de réinitialisation du mot de passe de votre compte {{env('APP_NAME')}}. Veuillez cliquer sur le lien ci-dessous pour le réinitialiser.
            <br><br>
            <a href="{{ $resetLink }}">CHANGER DE MOT DE PASSE</a>
            <br><br>
            Si vous n'avez pas demandé la réinitialisation de votre mot de passe, veuillez ignorer cet e-mail ou contacter notre équipe d'assistance si vous avez des questions.
            <br><br>
            Si vous rencontrez des problèmes avec le lien ci-dessus, veuillez copier-coller l'URL suivante dans votre navigateur Web.
            <br><br>
            {{ $resetLink }}
            <br><br><br><br>
            L'équipe {{env('APP_NAME')}} se tient à votre disposition pour toute question ou assistance supplémentaire.
            <br><br><br>
            <div style="font-style: italic; color: #545454">
                L’équipe {{env('APP_NAME')}}
            </div>
        </p>
    </div>

</body>
</html>