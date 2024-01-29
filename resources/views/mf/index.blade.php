@extends('layouts.mf')

@section('seo')
    <title>Gestion de votre classe de maternelle en ligne</title>
    <meta name="description" content="Les Maternelles est un service en ligne pour optimiser la gestion d'une classe de maternelle">
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

    <!-- start header area -->

    <!-- end header area -->

    <style>
        .button_cherche_ecole {
            font-size: 16px;
            padding: 8px 16px;
            color: black;
            background-color: white;
            margin-top: 120px
        }
    </style>

    <!-- start banner area -->
    <section class="home1 banner" data-img="{{asset('assets/images/home1/banner/banner-bg.png')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content">
                        <div class="row">
                            <div class="col-lg-10 order-1 order-lg-0">
                                <div class="text-area">
                                    <h1 class="wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">L'application conçue pour vous</h1>
                                    <h1 class="wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="1s">simplifier la conception des </h1>
                                    <h1 class="wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="1s">cahiers de réussites</h1>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('mf.etablissement') }}" class="button_cherche_ecole">Chercher votre établissement</a>
                            </div>
                            
                            {{-- <label class="mb-2" for="searchSchoolOnHomepage" style="font-size:1.2em; color: white">Chercher votre école parmi plus de 36,000 établissements référencés :</label>
                            <div class="d-flex">
                                <input type="text" class="form-control" name="searchSchoolOnHomepage" id="searchSchoolOnHomepage" placeholder="Code établissement, code postal, nom école, mot clé...">
                                <a class="btn btn-primary boutonSearchSchoolOnHomepage">Chercher votre école</a>
                            </div>

                            <div id="afficheLaListeDesEtablissementsHomepage" class="mt-3" style="display:none; overflow: auto; height: 150px; color:white">
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end banner area -->

    <!-- start feature area -->
    <section class="home1 feature p-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                    <div class="section-title wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1s">
                        <h2>Comment ca marche ?</h2>
                        <p>C'est simple ! Il suffit juste de suivre les étapes suivantes</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-6">
                            <div class="item wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s"  >

                                <span>01</span>
                                <h4>Créer <br> votre classe</h4>
                                <p>Saisissez vos élèves ou récupérer la classe de l'année précédente d'un professeur de votre école.</p>
                                <a href="service-detail.html"><i class="flaticon-arrow-pointing-to-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="item wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="1s">

                                <span>02</span>
                                <h4>Choisissiez <br> vos activités</h4>
                                <p>Sélectionnez les fiches d'activités que vous allez traiter pendant l'année scolaire parmi les 8 domaines du programme officiel.</p>
                                <a href="service-detail.html"><i class="flaticon-arrow-pointing-to-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="item wow fadeInUp" data-wow-delay="0.6s" data-wow-duration="1s">

                                <span>03</span>
                                <h4>Evaluer <br> vos élèves</h4>
                                <p>Notez vos élèves au cours de l'année sur 3 critères : Acquis, Acquis avec aide, En voie d'acquisition.</p>
                                <a href="service-detail.html"><i class="flaticon-arrow-pointing-to-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="item wow fadeInUp" data-wow-delay="0.6s" data-wow-duration="1s">

                                <span>04</span>
                                <h4>Editer vos cahiers <br>de réussites</h4>
                                <p>Complétez vos cahiers de réussites qui seront générés automatiquement en fonction des activités acquises.</p>
                                <a href="service-detail.html"><i class="flaticon-arrow-pointing-to-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end feature area -->

    <!-- start counter area -->
    <section class="home1 counter p-100" data-img="assets/images/home1/count/bg.jpg">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="item item1 text-center wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">
                            <div class="icon">
                                <i class="flaticon-cloud"></i>
                            </div>
                            <h4>domaines d'activités</h4>
                            <h2 class="odometer odometer-auto-theme" data-count="8">0000</h2>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="item item2 text-center wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="1s">
                            <div class="icon">
                                <i class="flaticon-pointed-star"></i>
                            </div>
                            <h4>Catégories</h4>
                            <h2 class="odometer odometer-auto-theme" data-count="32">0000</h2>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="item item3 text-center wow fadeInUp" data-wow-delay="0.6s" data-wow-duration="1s">
                            <div class="icon">
                                <i class="flaticon-customer-service"></i>
                            </div>
                            <h4>Activités</h4>
                            <h2 class="odometer odometer-auto-theme" data-count="194">000</h2>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- end counter area -->

    <!-- start about area -->
    <section class="home1 about p-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                    <div class="section-title wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1s">
                        <h2>Fonctionalités clés</h2>
                        <p>Ces fonctionnalités garantissent une expérience fluide et efficace pour les enseignant(e)s de maternelle, leur permettant de se concentrer pleinement sur l'éducation et le développement de leurs élèves.</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <div class="image text-center wow fadeInLeft" data-wow-delay="0.3s" data-wow-duration="1s">
                                <img src="assets/images/home1/about/img1.jpg" alt="About">
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="content wow fadeInRight" data-wow-delay="0.3s" data-wow-duration="1s">
                                <ul>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-ribbon"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Gestion de la Classe Simplifiée</h6>
                                            <p>Créez votre classe en quelques clics. La maîtresse peut facilement saisir les détails de sa classe, définir les paramètres, et commencer rapidement.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-ribbon"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Importation de Classes Antérieures</h6>
                                            <p>Gagnez du temps en important les données de votre classe de l'année précédente. Un processus simple pour garantir une continuité fluide d'une année à l'autre.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-24-hours"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Ajout Facile d'Élèves</h6>
                                            <p>Pour les nouveaux arrivants, ajoutez rapidement de nouveaux élèves à votre liste. Un processus intuitif pour assurer une mise à jour constante de la composition de la classe.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-24-hours"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Mode multi-classes</h6>
                                            <p>Un professeur peut gérer plusieurs classes.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-24-hours"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Classes Partagées</h6>
                                            <p>Notre système de partage de classe permet à un professeur titulaire de partager la gestion de sa classe avec un professeur co-titulaire ou suppléant</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 pt-120">
                    <div class="row align-items-center">
                        <div class="col-lg-7 order-1 order-lg-0">
                            <div class="content wow fadeInLeft" data-wow-delay="0.3s" data-wow-duration="1s">
                                                               <ul>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-mobile-app-developing"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Catalogue d'Activités Étendu</h6>
                                            <p>Choisissez parmi une liste complète de 192 activités soigneusement réparties dans 32 catégories. Des options variées pour s'adapter à tous les aspects du programme éducatif.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-mobile-app-developing"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Création et personnalisation de ses propres activités</h6>
                                            <p>Choisissez parmi une liste complète de 192 activités soigneusement réparties dans 32 catégories. Des options variées pour s'adapter à tous les aspects du programme éducatif.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-setup"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Suivi des Activités Tout au Long de l'Année</h6>
                                            <p>Enregistrez les progrès des élèves sur chaque activité tout au long de l'année. Un moyen efficace de documenter les réussites individuelles et de suivre le développement global de la classe.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-setup"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Notation Intuitive</h6>
                                            <p>Donnez des notes aux élèves avec facilité. Un système de notation intuitif qui permet à la maîtresse de documenter les performances des élèves de manière détaillée et compréhensible.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-5 order-0 order-lg-1">
                            <div class="image text-center wow fadeInRight" data-wow-delay="0.3s" data-wow-duration="1s">
                                <img src="assets/images/home1/about/img2.jpg" alt="About">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end about area -->

    <!-- start portfolio area -->
    <section class="home1 portfolio pt-120 pb-90" id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                    <div class="section-title wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1s">
                        <h2>Un Petit Tour d'Horizon</h2>
                        <p>Un rapide aperçu des différentes vues de l'application</p>
                    </div>
                </div>
                <!-- <div class="col-lg-12">
                    <ul class="project-menu d-flex justify-content-center wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1s">
                        <li class="active"><a href="#!" data-mixitup-control data-filter="all">all</a></li>
                        <li><a href="#!" data-mixitup-control data-filter=".ios">IOS</a></li>
                        <li><a href="#!" data-mixitup-control data-filter=".and">android</a></li>
                        <li><a href="#!" data-mixitup-control data-filter=".mar">marketing</a></li>
                        <li><a href="#!" data-mixitup-control data-filter=".des">designer</a></li>
                        <li><a href="#!" data-mixitup-control data-filter=".app">app</a></li>
                    </ul>
                </div> -->
            </div>
        </div>
        <div class="container">
            <div class="row filters">
                <div class="col-xl-4 col-lg-4 col-md-6 mix ios des">
                    <div class="item wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">
                        <img src="assets/images/home1/project/01-dashboard.png" alt="Project">
                        <div class="overlay">
                            <div class="text">
                                <h6>Le tableau de bord</h6>
                                
                            </div>  
                            <a href="project-detail.html"><i class="flaticon-right-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 mix and app">
                    <div class="item wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="1s">
                        <img src="assets/images/home1/project/02-cahier.png" alt="Project">
                        <div class="overlay">
                            <div class="text">
                                <h6>Le cahier de réussite</h6>
                                <p>La page de garde</p>
                            </div>  
                            <a href="project-detail.html"><i class="flaticon-right-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 mix and mar">
                    <div class="item wow fadeInUp" data-wow-delay="0.6s" data-wow-duration="1s">
                        <img src="assets/images/home1/project/03-avatar.png" alt="Project">
                        <div class="overlay">
                            <div class="text">
                                <h6>J'affecte un avatar à mon élève</h6>
                                
                            </div>  
                            <a href="project-detail.html"><i class="flaticon-right-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 mix des app">
                    <div class="item wow fadeInUp" data-wow-delay="0.8s" data-wow-duration="1s">
                        <img src="assets/images/home1/project/04-calendrier.png" alt="Project">
                        <div class="overlay">
                            <div class="text">
                                <h6>Le calendrier</h6>
                                <p>des vacances scolaires, des anniversaires et des événements</p>
                            </div>  
                            <a href="project-detail.html"><i class="flaticon-right-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 mix ios and">
                    <div class="item wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">
                        <img src="assets/images/home1/project/05-activite.png" alt="Project">
                        <div class="overlay">
                            <div class="text">
                                <h6>Je sélectionne mes activités</h6>
                                <p>Il est aussi pobbible de créer ses propres fiches d'activité</p>
                            </div>  
                            <a href="project-detail.html"><i class="flaticon-right-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 mix des mar">
                    <div class="item wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="1s">
                        <img src="assets/images/home1/project/06-redaction.png" alt="Project">
                        <div class="overlay">
                            <div class="text">
                                <h6>Je rédige mon cahier de réussite</h6>
                                <p>Les commentaires de section qui émanne des activités acquises sont déjà présents</p>
                            </div>  
                            <a href="project-detail.html"><i class="flaticon-right-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 mix des app">
                    <div class="item wow fadeInUp" data-wow-delay="0.8s" data-wow-duration="1s">
                        <img src="assets/images/home1/project/07-parametres.png" alt="Project">
                        <div class="overlay">
                            <div class="text">
                                <h6>Je gère les paramètres de ma classe</h6>
                                <p>Ma classe est entièrement personnalisable</p>
                            </div>  
                            <a href="project-detail.html"><i class="flaticon-right-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 mix ios and">
                    <div class="item wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">
                        <img src="assets/images/home1/project/08-evaluation.png" alt="Project">
                        <div class="overlay">
                            <div class="text">
                                <h6>J'évalue mes élèves</h6>
                                <p>Activité acquise en autonomie ou avec aide et en voie d'acquisition</p>
                            </div>  
                            <a href="project-detail.html"><i class="flaticon-right-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 mix des mar">
                    <div class="item wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="1s">
                        <img src="assets/images/home1/project/09-groupes.png" alt="Project">
                        <div class="overlay">
                            <div class="text">
                                <h6>J'affecte un groupe à mes élèves</h6>
                                <p>Après avoir créer vos groupes</p>
                            </div>  
                            <a href="project-detail.html"><i class="flaticon-right-1"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- end portfolio area -->

    <!-- start team area -->
    {{-- <section class="home1 team p-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                    <div class="section-title wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1s">
                        <h2>professional team</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod te incididunt ut labore et dolore magna aliqua. Ut enim ad minim to eismud </p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6">
                            <div class="item wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1s">
                                <div class="image">
                                    <img src="assets/images/home1/team/img1.jpg" alt="Team">
                                </div>
                                <a href="team-detail.html">
                                    <h6>Sarrison Samuel</h6>
                                </a>
                                <p>Marketing Officer</p>
                                <ul class="d-flex justify-content-center">
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="item wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="1s">
                                <div class="image">
                                    <img src="assets/images/home1/team/img2.jpg" alt="Team">
                                </div>
                                <a href="team-detail.html">
                                    <h6>warrison Samuel</h6>
                                </a>
                                <p>CEO & founder</p>
                                <ul class="d-flex justify-content-center">
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="item wow fadeInUp" data-wow-delay="0.6s" data-wow-duration="1s">
                                <div class="image">
                                    <img src="assets/images/home1/team/img3.jpg" alt="Team">
                                </div>
                                <a href="team-detail.html">
                                    <h6>harrison Samuel</h6>
                                </a>
                                <p>support member</p>
                                <ul class="d-flex justify-content-center">
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- end team area -->

    <!-- start mobile area -->
    <section class="home1 mobile">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bg wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1s">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="image">
                                    <img src="assets/images/home1/mobile.png" alt="Mobile">
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="content">
                                    <h3>Télécharger l'application mobile</h3>
                                    <p>L'application mobile vous permet de noter vos élèves directement dans votre classe ou tout simplement, quand vous le voulez :) </p>
                                    <ul class="d-flex">
                                        <li>
                                            <a href="#!">
                                                <img src="{{asset('assets/images/inner/google-play-badge.png')}}" alt="Apple Store" width="194">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#!">
                                                <img src="{{asset('assets/images/inner/appstore.png')}}" alt="Play Store"  width="194">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end mobile area -->

    <!-- start video area -->
    <section class="home1 video" data-img="assets/images/home1/bear.png">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content text-center">
                            <a class="vid-icon venobox" data-autoplay="true" data-vbtype="video" href="https://www.youtube.com/watch?v=LCmsrVOXzZc">
                                <i class="fas fa-play"></i>
                            </a>
                            <p>working video</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end video area -->

    <!-- start client area -->
    <!-- <section class="home1 client p-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                    <div class="section-title wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1s">
                        <h2>customers love</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod te incididunt ut labore et dolore magna aliqua. Ut enim ad minim to eismud </p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row align-items-center">
                        <div class="col-lg-5 position-relative">
                            <div class="wow fadeInLeft" data-wow-delay="0.4s" data-wow-duration="1s">
                                <div class="shape"></div>
                                <div class="client-img-slider swiper-container">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="image">
                                                <img src="assets/images/home1/client/img1.jpg" alt="Client">
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="image">
                                                <img src="assets/images/home1/client/img2.jpg" alt="Client">
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="image">
                                                <img src="assets/images/home1/client/img3.jpg" alt="Client">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="wow fadeInRight" data-wow-delay="0.4s" data-wow-duration="1s">
                                <div class="client-slider swiper-container">
                                    <div class="swiper-wrapper">
                                        <div class="item swiper-slide">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmd tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim ve quisnostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis autein irure dolor in reprehenderit in voluptate velit esse cilleu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non </p>
                                            <h6>Zachary Farmer</h6>
                                            <p class="designation">developer</p>
                                        </div>
                                        <div class="item swiper-slide">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmd tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim ve quisnostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis autein irure dolor in reprehenderit in voluptate velit esse cilleu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non </p>
                                            <h6>graham bell</h6>
                                            <p class="designation">designer</p>
                                        </div>
                                        <div class="item swiper-slide">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmd tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim ve quisnostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis autein irure dolor in reprehenderit in voluptate velit esse cilleu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non </p>
                                            <h6>packary Farmer</h6>
                                            <p class="designation">manager</p>
                                        </div>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- end client area -->

    <!-- start brand area -->
    <!-- <section class="home1 brand p-100">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="brand-logo text-center wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">
                        <a href="#!"><img src="assets/images/home1/brand/brand-logo1.png" class="img-fluid" alt="Brand Logo" /></a>
                    </div>
                </div>
                <div class="col">
                    <div class="brand-logo text-center wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="1s">
                        <a href="#!"><img src="assets/images/home1/brand/brand-logo2.png" class="img-fluid" alt="Brand Logo" /></a>
                    </div>
                </div>
                <div class="col mt-sm-30">
                    <div class="brand-logo text-center wow fadeInUp" data-wow-delay="0.6s" data-wow-duration="1s">
                        <a href="#!"><img src="assets/images/home1/brand/brand-logo3.png" class="img-fluid" alt="Brand Logo" /></a>
                    </div>
                </div>
                <div class="col mt-sm-30">
                    <div class="brand-logo text-center wow fadeInUp" data-wow-delay="0.7s" data-wow-duration="1s">
                        <a href="#!"><img src="assets/images/home1/brand/brand-logo4.png" class="img-fluid" alt="Brand Logo" /></a>
                    </div>
                </div>
                <div class="col mt-sm-30">
                    <div class="brand-logo text-center wow fadeInUp" data-wow-delay="0.8s" data-wow-duration="1s">
                        <a href="#!"><img src="assets/images/home1/brand/brand-logo5.png" class="img-fluid" alt="Brand Logo" /></a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- end brand area -->
    
    <!-- start blog area -->
    <!-- <section class="home1 blog p-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                    <div class="section-title wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1s">
                        <h2>latest news</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod te incididunt ut labore et dolore magna aliqua. Ut enim ad minim to eismud </p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6">
                            <div class="single-blog wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="1s">
                                <div class="image">
                                    <a href="blog-detail.html">
                                        <img src="assets/images/home1/blog/blog1.jpg" alt="Blog">
                                    </a>
                                </div>
                                <div class="content">
                                    
                                    <a href="blog-detail.html">
                                        <h6>Great ISO Service we have ever seen in history</h6>
                                    </a>
                                    <ul class="d-flex align-item-center">
                                        <li><a href="#!"><i class="fas fa-user"></i>endith smith</a></li>
                                        <li><a href="#!"><i class="fas fa-comment"></i>may 21, 21</a></li>
                                    </ul>
                                    <p>We help ambitious businesses like yours generate more profits </p>
                                    <a href="blog-detail.html" class="read-more">read more</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="single-blog wow fadeInUp" data-wow-delay="0.6s" data-wow-duration="1s">
                                <div class="image">
                                    <a href="blog-detail.html">
                                        <img src="assets/images/home1/blog/blog2.jpg" alt="Blog">
                                    </a>
                                </div>
                                <div class="content">
                                    
                                    <a href="blog-detail.html">
                                        <h6>Modern Innovation and Best Talent work together</h6>
                                    </a>
                                    <ul class="d-flex align-item-center">
                                        <li><a href="#!"><i class="fas fa-user"></i>Jhon smith</a></li>
                                        <li><a href="#!"><i class="fas fa-comment"></i>may 21, 21</a></li>
                                    </ul>
                                    <p>We help ambitious businesses like yours generate more profits </p>
                                    <a href="blog-detail.html" class="read-more">read more</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="single-blog wow fadeInUp" data-wow-delay="0.8s" data-wow-duration="1s">
                                <div class="image">
                                    <a href="blog-detail.html">
                                        <img src="assets/images/home1/blog/blog3.jpg" alt="Blog">
                                    </a>
                                </div>
                                <div class="content">
                                    
                                    <a href="blog-detail.html">
                                        <h6>All the Services are Best and Packages Liked by all</h6>
                                    </a>
                                    <ul class="d-flex align-item-center">
                                        <li><a href="#!"><i class="fas fa-user"></i>Abul mike</a></li>
                                        <li><a href="#!"><i class="fas fa-comment"></i>may 21, 21</a></li>
                                    </ul>
                                    <p>We help ambitious businesses like yours generate more profits </p>
                                    <a href="blog-detail.html" class="read-more">read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- end blog area -->



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

    <!-- start custom cursor area -->
    <div class="custom-cursor">
        <div id="cursor">
          <div id="cursor-ball"></div>
        </div>
    </div>
    <!-- end custom cursor area -->
    @endsection


