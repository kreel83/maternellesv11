@extends('layouts.vitrine')

@section('seo')
    <title>Le compagnon</title>
    <meta name="description" content="">
@endsection

@section('content')

<div class="padding-top padding-bottom about-bottom">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="rtl d-none d-lg-block pr-4">
					<img src="{{ asset('img/vitrine/compagnon/compagnon.jpg') }}" alt="about" class="rounded img-fluid">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="about-content">
					<div class="section-header left-style mb-olpo">
						<span class="cate">Le Compagnon</span>
						<h3>L'application mobile qui vous suit partout</h3>
						<p>L'application mobile disponible sur Google Play et App Store, vous permet d'évaluer vos élèves tout au long de la journée de classe depuis votre mobile ou une tablette. 
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
						<a href="{{ route('registration.start') }}" class="custom-button"><span>Commencez maintenant</span></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection