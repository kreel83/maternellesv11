@extends('layouts.vitrine')

@section('seo')
    <title>Nous contacter</title>
    <meta name="description" content="">
@endsection

@section('content')

<section class="bg_img padding-bottom padding-top">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="rtl d-none d-lg-block pr-4">
					<img src="{{ asset('img/vitrine/contact/contact.png') }}" alt="about">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="about-content">

                    <!-- Validation Errors -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

					<div class="section-header left-style mb-olpo">
						<span class="cate">Nous contacter</span>
						<h3 class="title">Envoyez nous votre message</h3>
						<p>Notre équipe est à votre service du lundi au vendredi de 9H à 17H. Nous nous efforçons de répondre dans les plus brefs délais.
						</p>
					</div>
					<form class="contact-form" id="contact_form_submit" action="{{ route('vitrine.contact.send') }}" method="post">
                    @csrf
						<div class="form-group">
							<input type="text" placeholder="Votre nom" id="name" name="name">
						</div>
						<div class="form-group">
							<input type="text" placeholder="Votre email" id="email" name="email">
						</div>
						<div class="form-group">
							<input type="text" placeholder="Numéro de téléphone" id="phone" name="phone">
						</div>
						<div class="form-group">
							<input type="text" placeholder="Sujet" id="subject" name="subject">
						</div>
						<div class="form-group w-100">
							<textarea id="message" name="message" placeholder="Votre message"></textarea>
						</div>
						<div class="form-group w-100 text-center">
							<button class="custom-button"><span>Envoyer</span></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection