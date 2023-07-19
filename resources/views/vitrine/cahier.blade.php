@extends('layouts.vitrine')

@section('content')

<div class="padding-top padding-bottom about-bottom">
	<div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="rtl d-none d-lg-block pr-4">
                    <img src="{{ asset('img/vitrine/cahier/cahier.png') }}" alt="Le cahier de progrès" class="rounded img-fluid">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-content">
                    <div class="section-header left-style mb-olpo">
                        <span class="cate">Le cahier de progrès</span>
                        <h3>Le coeur de l'application</h3>
                        <p>Le cahier de progrès est une tâche chronophage lorsqu'il est effectué manuellement. Dans notre application, 
                        le cahier de progrès est généré en quelques secondes pour l'intégralité de la classe, basé sur tous les éléments 
                        notés au cours de la vie scolaire de l'élève.
                        </p>
                    </div>
                    <ul class="about-list">
                        <li>
                            <i class="fa-solid fa-circle-check"></i>Création en 1-clic depuis votre tableau de bord</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-circle-check"></i>Reprend l'ensemble de vos notes pour chaque élève</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-circle-check"></i>Généré sous forme de document PDF</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-circle-check"></i>Facilement transmissible aux parents</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-circle-check"></i>Gain de temps et d'erreurs</span>
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