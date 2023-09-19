<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Demande de contact</title>
</head>
<body>

    <p>Nom : {{ $user->name }}</p>
    <p>Prénom : {{ $user->prenom }}</p>
    <p>Rôle : {{ $user->role }}</p>
    <p>Etablissement : {{ $user->ecole_identifiant_de_l_etablissement }}</p>
    <p>Message : {{ $body }}</p>

</body>
</html>