@extends('layouts.vitrine')

@section('seo')
    <title>Conditions d'utilisation du service Les Maternelles</title>
    <meta name="description" content="">
@endsection

@section('content')

<div class="padding-top padding-bottom about-bottom">
	<div class="container">

		{{-- https://www.legalplace.fr/contrats/conditions-generales-d-utilisation/creer --}}

		<h3>Conditions d'utilisation du service</h3>

		<p>En vigueur au 01/01/2023</p>

		<p>Les présentes conditions générales d'utilisation (dites « CGU ») ont pour objet l'encadrement juridique
		des modalités de mise à disposition du site et des services par {{ config('app.name') }} et de définir les
		conditions d’accès et d’utilisation des services par « l'Utilisateur ».</p>

		<p>Les présentes CGU sont accessibles sur le site à la rubrique « Conditions d'utilisation ».</p>

		<p>Toute inscription ou utilisation du site implique l'acceptation sans aucune réserve ni restriction des
		présentes CGU par l’utilisateur. Lors de l'inscription sur le site via le Formulaire d’inscription, chaque
		utilisateur accepte expressément les présentes CGU en cochant la case précédant le texte suivant : «
		Je reconnais avoir lu et compris les CGU et je les accepte ».</p>

		<p>En cas de non-acceptation des CGU stipulées dans le présent contrat, l'Utilisateur se doit de renoncer
		à l'accès des services proposés par le site.</p>

		<p>{{ config('app.url') }} se réserve le droit de modifier unilatéralement et à tout moment le
		contenu des présentes CGU.</p>

		<h4>Article 1 : Les mentions légales</h4>

		<p>L’édition et la direction de la publication du site {{ config('app.url') }} est assurée par Les
		Maternelles, domicilié Toulon.<br>
		Numéro de téléphone est 0606060606<br>
		Adresse e-mail contact@.<br>
		La personne est assujetie au RCS avec le numéro d'inscription 123456789 et son numéro de TVA
		intracommunautaire est le _______________
		</p>

		<p>L'hébergeur du site {{ config('app.url') }} est la société Planethoster, dont le siège social
		est situé au 4416 Louis-B.-Mayer Laval, Québec Canada H7P 0G1, avec le numéro de téléphone :
		+33176604143.</p>

		<h4>ARTICLE 2 : Accès au site</h4>

		<p>Le site {{ config('app.url') }} permet à l'Utilisateur un accès gratuit aux services suivants :
		Le site internet propose les services suivants :</p>
		
		<p><strong>La gestion d'une classe de maternelle (toutes sections).</strong></p>

		<p>Le site est accessible gratuitement en tout lieu à tout Utilisateur ayant un accès à Internet. Tous les
		frais supportés par l'Utilisateur pour accéder au service (matériel informatique, logiciels, connexion
		Internet, etc.) sont à sa charge.</p>
		
		<p>L’Utilisateur non membre n'a pas accès aux services réservés. Pour cela, il doit s’inscrire en
		remplissant le formulaire. En acceptant de s’inscrire aux services réservés, l’Utilisateur membre
		s’engage à fournir des informations sincères et exactes concernant son état civil et ses coordonnées,
		notamment son adresse email.</p>

		<p>Pour accéder aux services, l’Utilisateur doit ensuite s'identifier à l'aide de son adresse e-mail et de son mot
		de passe qu'il aura indiquer au moment de son inscription.</p>

		<p>Tout Utilisateur membre régulièrement inscrit pourra également solliciter sa désinscription en se
		rendant à la page dédiée sur son espace personnel. Celle-ci sera effective dans un délai raisonnable.
		Tout événement dû à un cas de force majeure ayant pour conséquence un dysfonctionnement du site
		ou serveur et sous réserve de toute interruption ou modification en cas de maintenance, n'engage pas
		la responsabilité de {{ config('app.url') }}. Dans ces cas, l’Utilisateur accepte ainsi ne pas
		tenir rigueur à l’éditeur de toute interruption ou suspension de service, même sans préavis.</p>

		<p>L'Utilisateur a la possibilité de contacter le site par messagerie électronique à l’adresse email de
		l’éditeur communiqué à l’ARTICLE 1.</p>

		<h4>ARTICLE 3 : Collecte des données</h4>

		<p>Le site assure à l'Utilisateur une collecte et un traitement d'informations personnelles dans le respect
		de la vie privée conformément à la loi n°78-17 du 6 janvier 1978 relative à l'informatique, aux fichiers
		et aux libertés.</p>

		<p>En vertu de la loi Informatique et Libertés, en date du 6 janvier 1978, l'Utilisateur dispose d'un droit
		d'accès, de rectification, de suppression et d'opposition de ses données personnelles. L'Utilisateur
		exerce ce droit :</p>

		<p>· via un formulaire de contact ;</p>

		<h4>ARTICLE 4 : Propriété intellectuelle</h4>

		<p>Les marques, logos, signes ainsi que tous les contenus du site (textes, images, son…) font l'objet
		d'une protection par le Code de la propriété intellectuelle et plus particulièrement par le droit d'auteur.
		L'Utilisateur doit solliciter l'autorisation préalable du site pour toute reproduction, publication, copie des
		différents contenus. Il s'engage à une utilisation des contenus du site dans un cadre strictement privé,
		toute utilisation à des fins commerciales et publicitaires est strictement interdite.</p>

		<p>Toute représentation totale ou partielle de ce site par quelque procédé que ce soit, sans l’autorisation
		expresse de l’exploitant du site Internet constituerait une contrefaçon sanctionnée par l’article L 335-2
		et suivants du Code de la propriété intellectuelle.</p>

		<p>Il est rappelé conformément à l’article L122-5 du Code de propriété intellectuelle que l’Utilisateur qui
		reproduit, copie ou publie le contenu protégé doit citer l’auteur et sa source.</p>

		
		<h4>ARTICLE 5 : Responsabilité</h4>

		<p>Les sources des informations diffusées sur le site {{ config('app.url') }} sont réputées
		fiables mais le site ne garantit pas qu’il soit exempt de défauts, d’erreurs ou d’omissions.</p>

		<p>Les informations communiquées sont présentées à titre indicatif et général sans valeur contractuelle.
		Malgré des mises à jour régulières, le site {{ config('app.url') }} ne peut être tenu
		responsable de la modification des dispositions administratives et juridiques survenant après la
		publication. De même, le site ne peut être tenue responsable de l’utilisation et de l’interprétation de
		l’information contenue dans ce site.</p>

		<p>L'Utilisateur s'assure de garder son mot de passe secret. Toute divulgation du mot de passe, quelle
		que soit sa forme, est interdite. Il assume les risques liés à l'utilisation de son identifiant et mot de
		passe. Le site décline toute responsabilité.</p>

		<p>Le site {{ config('app.url') }} ne peut être tenu pour responsable d’éventuels virus qui
		pourraient infecter l’ordinateur ou tout matériel informatique de l’Internaute, suite à une utilisation, à
		l’accès, ou au téléchargement provenant de ce site.</p>
		
		<p>La responsabilité du site ne peut être engagée en cas de force majeure ou du fait imprévisible et
		insurmontable d'un tiers.</p>

		<h4>ARTICLE 6 : Liens hypertextes</h4>

		<p>Des liens hypertextes peuvent être présents sur le site. L’Utilisateur est informé qu’en cliquant sur ces
		liens, il sortira du site {{ config('app.url') }}. Ce dernier n’a pas de contrôle sur les pages
		web sur lesquelles aboutissent ces liens et ne saurait, en aucun cas, être responsable de leur
		contenu.</p>

		<h4>ARTICLE 7 : Cookies</h4>

		<p>L’Utilisateur est informé que lors de ses visites sur le site, un cookie peut s’installer automatiquement
		sur son logiciel de navigation.</p>

		<p>Les cookies sont de petits fichiers stockés temporairement sur le disque dur de l’ordinateur de
		l’Utilisateur par votre navigateur et qui sont nécessaires à l’utilisation du site
		{{ config('app.url') }}. Les cookies ne contiennent pas d’information personnelle et ne
		peuvent pas être utilisés pour identifier quelqu’un. Un cookie contient un identifiant unique, généré
		aléatoirement et donc anonyme. Certains cookies expirent à la fin de la visite de l’Utilisateur, d’autres
		restent.</p>

		<p>L’information contenue dans les cookies est utilisée pour améliorer le site
		{{ config('app.url') }}. En naviguant sur le site, L’Utilisateur les accepte.</p>
		
		<p>L’Utilisateur pourra désactiver ces cookies par l’intermédiaire des paramètres figurant au sein de son
		logiciel de navigation.</p>

		<p><a href="{{ route('vitrine.cookies') }}">Voir notre rubrique dédiée à l'utilisation des cookies.</a></p>

		<h4>ARTICLE 8 : Droit applicable et juridiction compétente</h4>

		<p>La législation française s'applique au présent contrat. En cas d'absence de résolution amiable d'un
		litige né entre les parties, les tribunaux français seront seuls compétents pour en connaître.
		Pour toute question relative à l’application des présentes CGU, vous pouvez joindre l’éditeur aux
		coordonnées inscrites à l’ARTICLE 1.</p>
		
	</div>
</div>

@endsection