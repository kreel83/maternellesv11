@extends('layouts.vitrine')

@section('seo')
    <title>Le calendrier</title>
    <meta name="description" content="">
@endsection

@section('content')

<div class="padding-top padding-bottom about-bottom">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="rtl d-none d-lg-block pr-4">
					<img src="{{ asset('img/vitrine/calendrier/calendrier.jpg') }}" alt="Mon calendrier" class="rounded img-fluid">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="about-content">
					<div class="section-header left-style mb-olpo">
						<span class="cate">Le calendrier</span>
						<h3>Pour ne rien oublier</h3>
						<p>Un anniversaire, une sortie scolaire, un évènement important : le calendrier est la pour vous rappeller 
						toutes les dates importantes dans votre classe.
						</p>
					</div>
					<ul class="about-list">
						<li>
							<i class="fa-solid fa-circle-check"></i>Gestion facile des dates</span>
						</li>
						<li>
							<i class="fa-solid fa-circle-check"></i>Point 2</span>
						</li>
						<li>
							<i class="fa-solid fa-circle-check"></i>Point 3</span>
						</li>
						<li>
							<i class="fa-solid fa-circle-check"></i>Point 4</span>
						</li>
						<li>
							<i class="fa-solid fa-circle-check"></i>Point 5</span>
						</li>
					</ul>
					<div class="load-more">
						<a href="#" class="custom-button"><span>Commencez maintenant</span></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection