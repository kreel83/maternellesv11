Bonjour {{ ucfirst($prenom) }},

Nous vous remercions pour la création de votre compte sur le service {{config('app.name')}} et vous souhaitons la bienvenue !

Afin d'activer votre compte merci de cliquer sur le lien ci-dessous :
{{ $verificationLink }}

Si vous avez un problème pour cliquer sur le lien ci-dessus, copier-coller le dans votre navigateur.

Cordialement,
L'équipe {{config('app.name')}}