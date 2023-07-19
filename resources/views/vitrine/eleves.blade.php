@extends('layouts.vitrine')

@section('content')

<div class="padding-top padding-bottom about-bottom">
	<div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="rtl d-none d-lg-block pr-4">
                    <img src="{{ asset('img/vitrine/eleves/eleves.jpg') }}" alt="Mes élèves" class="rounded img-fluid">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-content">
                    <div class="section-header left-style mb-olpo">
                        <span class="cate">Mes élèves</span>
                        <h3>Gestion complète de votre classe</h3>
                        <p>A venir...
                        </p>
                    </div>
                    <ul class="about-list">
                        <li>
                            <i class="fa-solid fa-circle-check"></i>Gestion des fiches élèves</span>
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