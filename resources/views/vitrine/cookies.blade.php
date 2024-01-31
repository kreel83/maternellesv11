@extends('layouts.vitrine')

@section('seo')
    <title>Politique de cookies</title>
    <meta name="description" content="">
@endsection

@section('content')

{{-- https://www.cookiepolicygenerator.com/live.php?token=sd5pgoaRFSIeOtkmxsHNYrZheEgndGtd --}}

<div class="padding-top padding-bottom about-bottom">
	<div class="container">

        <h3>Politique en matière de cookies pour Les maternelles</h3>

        <p>Voici la politique en matière de cookies du site Les maternelles, accessible à partir de {{ config('app.url') }}</p>

        <p><strong>Qu'est-ce qu'un cookie ?</strong></p>

        <p>Comme la plupart des sites professionnels, ce site utilise des cookies, qui sont de minuscules fichiers téléchargés sur votre ordinateur, afin d'améliorer votre expérience. Cette page décrit les informations qu'ils recueillent, comment nous les utilisons et pourquoi nous avons parfois besoin de stocker ces cookies. Nous vous expliquons également comment vous pouvez empêcher ces cookies d'être stockés, mais cela peut entraîner une dégradation ou une interruption de certains éléments de la fonctionnalité du site.</p>

        <p><strong>Comment nous utilisons les cookies</strong></p>

        <p>Nous utilisons des cookies pour diverses raisons détaillées ci-dessous. Malheureusement, dans la plupart des cas, il n'existe pas d'options standard pour désactiver les cookies sans désactiver complètement les fonctionnalités et les caractéristiques qu'ils ajoutent à ce site. Il est recommandé de laisser tous les cookies activés si vous n'êtes pas sûr d'en avoir besoin ou non, au cas où ils seraient utilisés pour fournir un service que vous utilisez.</p>

        <p><strong>Désactivation des cookies</strong></p>

        <p>Vous pouvez empêcher l'installation de cookies en réglant les paramètres de votre navigateur (voir l'aide de votre navigateur pour savoir comment procéder). Sachez que la désactivation des cookies affectera la fonctionnalité de ce site et de nombreux autres sites que vous visitez. La désactivation des cookies entraîne généralement la désactivation de certaines fonctionnalités et caractéristiques de ce site. Il est donc recommandé de ne pas désactiver les cookies.</p>

        <p><strong>Les cookies que nous installons</strong></p>

        <p>Cookies liés au compte</p>
        <p>Si vous créez un compte chez nous, nous utiliserons des cookies pour gérer le processus d'inscription et l'administration générale. Ces cookies sont généralement supprimés lorsque vous vous déconnectez. Toutefois, dans certains cas, ils peuvent être conservés par la suite pour se souvenir de vos préférences sur le site lorsque vous vous déconnectez.</p>
        
        <p>Cookies liés à la mesure de l'audience</p>
        <p>Nous pouvons utiliser des cookies strictement limités à la seule mesure de l’audience du site (mesure des performances, détection de problèmes de navigation, optimisation des performances techniques ou de son ergonomie, estimation de la puissance des serveurs nécessaires, analyse des contenus consulté), pour un usage interne uniquement. </p>

        <p>Cookies liés aux données statistiques</p>
        <p>Nous pouvons utiliser des cookies strictement limités à produire des données statistiques anonymes uniquement.</p>

        {{--
        <p>Cookies liés à la connexion</p>
        <p>Nous utilisons des cookies lorsque vous êtes connecté afin de nous en souvenir. Cela vous évite d'avoir à vous connecter à chaque fois que vous visitez une nouvelle page. Ces cookies sont généralement supprimés ou effacés lorsque vous vous déconnectez afin de garantir que vous ne puissiez accéder à des fonctions et zones restreintes que lorsque vous êtes connecté.</p>
            
        <p>Cookies liés aux bulletins d'information électroniques</p>
        <p>Ce site propose des services d'abonnement à des lettres d'information ou à des courriels et des cookies peuvent être utilisés pour se souvenir si vous êtes déjà inscrit et pour afficher certaines notifications qui peuvent n'être valables que pour les utilisateurs abonnés ou désabonnés.</p>
            
        <p>Cookies liés aux formulaires</p>
        <p>Lorsque vous soumettez des données au moyen d'un formulaire, comme ceux que l'on trouve sur les pages de contact ou les formulaires de commentaires, des cookies peuvent être mis en place pour mémoriser vos coordonnées d'utilisateur en vue d'une correspondance ultérieure.</p>
            
        <p>Cookies relatifs aux préférences du site</p>
        <p>Afin de vous offrir une expérience agréable sur ce site, nous vous offrons la possibilité de définir vos préférences quant au fonctionnement de ce site lorsque vous l'utilisez. Afin de mémoriser vos préférences, nous devons installer des cookies pour que ces informations puissent être appelées chaque fois que vous interagissez avec une page affectée par vos préférences.</p>
        
        --}}

        <p></p>

        {{--
        <p><strong>Cookies de tiers</strong></p>
        <p>Dans certains cas particuliers, nous utilisons également des cookies fournis par des tiers de confiance. La section suivante détaille les cookies de tiers que vous pouvez rencontrer sur ce site.</p>

        <p>Ce site utilise Google Analytics, l'une des solutions d'analyse les plus répandues et les plus fiables sur le web, pour nous aider à comprendre comment vous utilisez le site et comment nous pouvons améliorer votre expérience. Ces cookies peuvent suivre des éléments tels que le temps que vous passez sur le site et les pages que vous visitez afin que nous puissions continuer à produire un contenu attrayant.</p>
        <p>Pour plus d'informations sur les cookies de Google Analytics, consultez la page officielle de Google Analytics.</p>
        
        <p>Nous utilisons également des boutons de médias sociaux et/ou des plugins sur ce site qui vous permettent de vous connecter à votre réseau social de différentes manières. Pour que ces boutons fonctionnent, les sites de médias sociaux suivants, y compris Facebook, Twitter, Instagram, placeront des cookies par l'intermédiaire de notre site qui peuvent être utilisés pour améliorer votre profil sur leur site ou contribuer aux données qu'ils détiennent à diverses fins décrites dans leurs politiques de confidentialité respectives.</p>
    
        <p></p>
        --}}

        <p><strong>Informations complémentaires</strong></p>

        <P>Nous espérons avoir clarifié les choses pour vous et, comme nous l'avons mentionné précédemment, si vous n'êtes pas sûr d'avoir besoin de quelque chose, il est généralement plus prudent de laisser les cookies activés au cas où ils interagiraient avec l'une des fonctions que vous utilisez sur notre site.</P>

        <p>Toutefois, si vous souhaitez obtenir davantage d'informations, vous pouvez nous contacter par l'une de nos méthodes de contact préférées :</p>

        <p>Courriel : <a href="{{ route('vitrine.contact') }}">cliquez ici</a></p>
		
	</div>
</div>

@endsection