@extends('layouts.mf')

@section('seo')
    <title>Mentions légales</title>
    <meta name="description" content="Les mentions légales du site internet {{ config('app.name') }}">
@endsection

@section('content')
    <!-- start preloader area -->
    <div class="preloader">
        <div class="circle1"></div>
        <div class="circle2"></div>
    </div>
    <!-- end preloader area -->

    <!-- start top-tp button area -->
    <button class="top-btn">
        <i class="fas fa-chevron-up"></i>
    </button>
    <!-- end top-tp button area -->



    <!-- start banner area -->
    <section class="inner-page banner" data-img="{{asset('assets/images/inner/banner-legal.jpg')}}">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content text-center mx-auto titre_banner">
                            <h2>Les mentions légales</h2>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end banner area -->

    <!-- start feature area -->
    <section class="home1 service-page feature pt-120 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                    <div class="section-title wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1s">
                        <h2>Mentions légales {{ config('app.name') }}</h2>
                        {{-- <p>En vigueur au 01/01/2024</p> --}}
                    </div>
                </div>
                <div class="col-lg-12">

                    {{-- https://www.legalplace.fr/ --}}

                    <p>Conformément aux dispositions des Articles 6-III et 19 de la Loi n°2004-575 du 21 juin 2004 pour la
                    Confiance dans l’économie numérique, dite L.C.E.N., il est porté à la connaissance des utilisateurs et
                    visiteurs, ci-après l""Utilisateur", du site {{ config('app.url') }} , ci-après le "Site", les
                    présentes mentions légales.</p>

                    <p>La connexion et la navigation sur le Site par l’Utilisateur implique l'acceptation intégrale et sans réserve
                    des présentes mentions légales.</p>

                    <p>Ces dernières sont accessibles sur le Site à la rubrique « Mentions légales ».</p>

                    <h5 class="mt-3">1 - Responsable du site</h5>

                    <p>ET BAM Solutions, SAS au capital de 1000 euros<br>
                    Siège social : 33 Rue Claire Joie - 83200 Toulon<br>
                    Tél : 06 64 17 41 99<br>
                    Adresse e-mail : {{ config('mail.from.address') }}<br>
                    RCS de TOULON, n° 983 750 118<br>
                    N° de TVA intracommunautaire : FR49983750118<br>
                    </p>

                    <h5 class="mt-3">2 - Directeur de la publication</h5>
                    Marc Borgna<br>
                    ET BAM Solutions - Responsable développement<br>
                    33 Rue Claire Joie<br>
                    83200 Toulon<br>
                    Tél : 06 70 92 93 20<br>
                    <a href="{{ route('mf.contact') }}">Contactez-nous</a>


                    <h5 class="mt-3">3 - Fournisseur d'hébergement du site</h5>

                    <p>LIGNE WEB SERVICES<br>
                    10 rue de Penthièvre<br>
                    75008 PARIS<br>
                    Tél : 01 77 62 30 03<br>
                    <a href="https://www.lws.fr" target="_blank">lws.fr</a><br>
                    </p>

                    <h5 class="mt-3">4 - Propriété intellectuelle</h5>
                    <p>Le Site est la propriété exclusive de ET BAM Solutions. ET BAM Solutions est titulaire de l'ensemble des droits de propriété intellectuelle relatifs au Site et notamment de tous les éléments graphiques, sonores, textuels, logiciels, y compris la technologie sous-jacente, ou de toute autre nature, composant le Site.</p>
                    <p>ET BAM Solutions est également titulaire des marques ayant fait l'objet de dépôts auprès de l'INPI et des noms de domaine régulièrement enregistrés.</p>
                    <p>L'Utilisateur s'engage ainsi à ne pas porter atteinte aux droits de propriété intellectuelle de ET BAM Solutions et s'interdit, à ce titre, de reproduire, de représenter ou de diffuser, même partiellement, tout élément protégé par un droit de propriété intellectuelle, à défaut d'en avoir eu préalablement l'autorisation expresse.</p>
                    <p>De même, tout procédé, relevant notamment de la technique du framing ou du deep-linking est formellement prohibé, sauf autorisation expresse, spéciale et écrite délivrée par ET BAM Solutions.</p>

                    {{-- <p>Le Site est accessible en tout endroit, 7j/7, 24h/24 sauf cas de force majeure, interruption
                    programmée ou non et pouvant découlant d’une nécessité de maintenance.</p> 
                    <p>En cas de modification, interruption ou suspension du Site, l'Editeur ne saurait être tenu responsable.</p> --}}

                    <h5 class="mt-3">5 - Portée des contenus</h5>
                    <p>Les informations communiquées sur le site {{ config('app.name') }} sont fournies à titre indicatif. Elles ne sauraient engager la responsabilité de ET BAM Solutions. Elles peuvent être modifiées ou mises à jour sans préavis.</p>
                    <p>La responsabilité de ET BAM Solutions ne saurait être engagée pour tout dommage, de quelque nature qu'il soit, direct ou indirect, toute omission ou erreur ou impossibilité d'accéder au Site.</p>

                    <h5 class="mt-3">6 - Liens hypertexte</h5>
                    <p>La mise en place de liens hypertextes en direction du Site nécessite l'autorisation expresse et préalable de ET BAM Solutions.</p>
                    <p>Il suffit pour cela de nous contacter via le formulaire suivant : <a href="{{ route('mf.contact') }}">Contactez-nous</a>.</p>
                    <p>Pour toute remarque concernant le site, veuillez nous contacter via la rubrique <a href="{{ route('mf.contact') }}">Contactez-nous</a>.</p>
                    <p>Aucune plainte, déclaration ou demande de conseil ne doit être transmise par cette boîte aux lettres électronique, mais uniquement par voie postale.</p>

                    {{-- <p>Le Site assure à l'Utilisateur une collecte et un traitement d'informations personnelles dans le respect
                    de la vie privée conformément à la loi n°78-17 du 6 janvier 1978 relative à l'informatique, aux fichiers
                    et aux libertés.</p>

                    <p>En vertu de la loi Informatique et Libertés, en date du 6 janvier 1978, l'Utilisateur dispose d'un droit
                    d'accès, de rectification, de suppression et d'opposition de ses données personnelles. L'Utilisateur
                    exerce ce droit :</p>
                    <p>· via un formulaire de contact ;</p>

                    <p>Toute utilisation, reproduction, diffusion, commercialisation, modification de toute ou partie du Site,
                    sans autorisation de l’Editeur est prohibée et pourra entraînée des actions et poursuites judiciaires
                    telles que notamment prévues par le Code de la propriété intellectuelle et le Code civil.</p> --}}

                    
                </div>
            </div>
        </div>
    </section>
    <!-- end feature area -->


    <!-- start modal area -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">search here</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="search-area">
                        <input type="search" placeholder="search..." class="inputs">
                        <button class="search-btn"><i class="flaticon-loupe"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal area -->


@endsection