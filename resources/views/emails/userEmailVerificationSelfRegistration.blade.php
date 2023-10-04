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
            Bonjour <span class="prenom">{{ ucfirst($prenom) }}</span>,
            <br><br>
            Nous sommes ravis de vous informer que votre compte Les Maternelles a été créé avec succès.
            <br><br>
            <b>Veuillez confirmer votre adresse email en cliquant <a href="{{ $verificationLink }}">sur ce lien.</a> afin de valider votre compte.</b>
            <br><br>
            Si le lien ci-dessus ne fonctionne pas, veuillez copier-coller le lien ci-dessous dans votre navigateur :
            <br><br>
            {{ $verificationLink }}
            <br><br><br><br>
            L'équipe Les Maternelles se tient à votre disposition pour toute question ou assistance supplémentaire.
            <br><br><br>
            <div style="font-style: italic; color: #545454">
                L’équipe Les Maternelles
            </div>
        </p>
    </div>

{{--
<p>Bonjour {{ ucfirst($prenom) }},</p>
<p>Nous vous remercions pour la création de votre compte sur le service lesmaternelles.com et vous souhaitons la bienvenue !</p>
<p>Afin d'activer votre compte merci de cliquer sur le lien ci-dessous :</p>
<p>{{ $verificationLink }}</p>
<p>Si vous avez un problème pour cliquer sur le lien ci-dessus, copier-coller le dans votre navigateur.</p>
<p>Cordialement,</p>
<p>Toute l'équipe lesmaternelles.com</p>
--}}
</body>
</html>