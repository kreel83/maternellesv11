@extends('layouts.vitrine')

@section('seo')
    <title>Politique de confidentialité</title>
    <meta name="description" content="">
@endsection

@section('content')

<div class="padding-top padding-bottom about-bottom">
	<div class="container">

        <h3>Politique de Confidentialité</h3>

    <p>Version en vigueur à partir du : 01/01/2023</p>

    <h4>1. Introduction</h4>

    <p>Merci de visiter notre site Internet. Chez [Les Maternelles], nous accordons une grande importance à la protection de vos données personnelles et nous nous engageons à respecter la réglementation en vigueur, notamment le Règlement Général sur la Protection des Données (RGPD).</p>

    <h4>2. Collecte des données</h4>

    <p>Les informations que nous collectons sont les suivantes :</p>

    <h5>a) Données que vous nous fournissez directement :</h5>

    <p>[nom, prénom, adresse e-mail, numéro de téléphone]</p>

    <h5>b) Données collectées automatiquement :</h5>

    <p>[cookies]</p>

    <h4>3. Utilisation des données</h4>

    <p>Nous utilisons les données que nous collectons pour :</p>

    <ul>
        <li>Vous fournir les informations, produits ou services demandés ;</li>
        <li>Améliorer notre site Internet et son contenu ;</li>
        <li>Personnaliser votre expérience utilisateur ;</li>
        <li>Vous contacter par e-mail, téléphone ou courrier pour vous informer de nos nouveautés, promotions, etc. (vous pouvez vous désabonner à tout moment) ;</li>
        <li>Analyser l'utilisation de notre site et recueillir des informations statistiques.</li>
    </ul>
    <p></p>
    <h4>4. Partage des données</h4>

    <p>Nous ne partagerons pas vos données personnelles avec des tiers sans votre consentement explicite, sauf dans les cas prévus par la loi.</p>

    <h4>5. Vos droits</h4>

    <p>Vous disposez des droits suivants concernant vos données personnelles :</p>

    <ul>
        <li>Accéder à vos données et obtenir des informations sur leur utilisation ;</li>
        <li>Rectifier vos données si elles sont inexactes ou incomplètes ;</li>
        <li>Effacer vos données dans certaines circonstances ;</li>
        <li>Vous opposer au traitement de vos données pour des raisons légitimes ;</li>
        <li>Demander la limitation du traitement de vos données ;</li>
        <li>Recevoir vos données dans un format structuré, couramment utilisé et lisible par machine (portabilité des données) ;</li>
        <li>Retirer votre consentement à tout moment lorsque le traitement est basé sur celui-ci.</li>
    </ul>
    <p></p>

    <h4>6. Sécurité des données</h4>

    <p>Nous prenons la sécurité de vos données personnelles au sérieux et mettons en place des mesures appropriées pour les protéger contre tout accès, divulgation, altération ou destruction non autorisée.</p>

    <h4>7. Modification de la politique de confidentialité</h4>

    <p>Nous pouvons mettre à jour cette politique de confidentialité à tout moment. Nous vous conseillons de consulter cette page régulièrement pour rester informé des éventuelles modifications.</p>

    <h4>8. Nous contacter</h4>

    <p>Si vous avez des questions, des commentaires ou des demandes concernant cette politique de confidentialité, veuillez nous contacter en <a href="{{ route('vitrine.contact') }}">cliquant ici</a>.</p>
		
	</div>
</div>

@endsection