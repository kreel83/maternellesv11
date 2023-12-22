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

        .code {
            font-weight: bold;
            font-size: 18px;
            letter-spacing: 2px;
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
            Bonjour,
            <br><br>
            Pour télécharger le cahier de réussites de votre enfant veuillez cliquer sur le lien ci-dessous :
            <br><br>
            <a href="{{ $url }}">Accéder à votre espace de téléchargement</a>
            <br><br>
            Je me tiens à votre disposition pour toute question ou assistance supplémentaire.
            <br><br><br>
            <div style="font-style: italic; color: #545454">
                {{ Auth::user()->prenom.' '.Auth::user()->name }}
            </div>
        </p>
    </div>

</body>
</html>