<html>
<head></head>
<body>
<p>Bonjour {{ ucfirst($prenom) }},</p>
<p>Nous vous remercions pour la création de votre compte sur le service lesmaternelles.com et vous souhaitons la bienvenue !</p>
<p>Afin d'activer votre compte merci de cliquer sur le lien ci-dessous :</p>
<p>{{ $verificationLink }}</p>
<p>Si vous avez un problème pour cliquer sur le lien ci-dessus, copier-coller le dans votre navigateur.</p>
<p>Cordialement,</p>
<p>Toute l'équipe lesmaternelles.com</p>
</body>
</html>