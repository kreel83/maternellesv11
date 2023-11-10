@extends('layouts.vitrine')

@section('seo')
    <title>Tarif de l'abonnement annuel au service Les Maternelles</title>
    <meta name="description" content="">
@endsection

@section('content')

<div class="padding-top padding-bottom about-bottom">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="rtl d-none d-lg-block pr-4">
					<img src="{{ asset('img/vitrine/tarif/tarif.png') }}" alt="about">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="about-content">
					<div class="section-header left-style mb-olpo">
						<span class="cate">Tarif</span>
						<h3>12,90 € par an tout compris</h3>
						<p>Notre service en ligne <b>{{ env('APP_NAME') }}</b> offre une flexibilité accrue.
						Gérez votre classe depuis votre ordinateur ou votre tablette en toute sécurité. L'application mobile (compagnon) est le 
						complément idéal en classe pour inscrire des notes sur l'instant.
						</p>
					</div>
					<ul class="about-list">
						<li>
							<i class="fa-solid fa-circle-check"></i>Accessible 7/7 24/24H avec une connection Internet</span>
						</li>
						<li>
							<i class="fa-solid fa-circle-check"></i>Connection cryptée et sécurisée</span>
						</li>
						<li>
							<i class="fa-solid fa-circle-check"></i>Stockage des données sécurisé dans notre Datacenter</span>
						</li>
						<li>
							<i class="fa-solid fa-circle-check"></i>Mises à niveau régulières pour un service au Top</span>
						</li>
						<li>
							<i class="fa-solid fa-circle-check"></i>Abonnement annuel tout compris. Aucuns frais cachés</span>
						</li>
					</ul>
					<div class="load-more">
						<a href="{{ route('registration.start') }}" class="custom-button"><span>Créez un compte gratuitement</span></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection