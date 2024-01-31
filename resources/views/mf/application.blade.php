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


    <!-- start banner area -->
    <section class="inner-page banner" data-img="{{asset('assets/images/inner/banner-bg.png')}}">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content text-center mx-auto titre_banner">
                            <h2>L'application</h2>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end banner area -->

    <!-- start about area -->
    <section class="home1 about p-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <div class="image text-center wow fadeInLeft" data-wow-delay="0.3s" data-wow-duration="1s">
                                <img class="rounded" src="{{asset('assets/images/home1/application/1.jpg')}}" alt="About">
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="content wow fadeInRight" data-wow-delay="0.3s" data-wow-duration="1s">
                                <h3>Je crée ma classe</h3>
                                <p></p>
                                <ul>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-ribbon"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Fiche de création d'élève</h6>
                                            <p>Une fiche simple et pratique pour créer et modifier un élève.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-24-hours"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Module d'importation de classe</h6>
                                            <p>Le module d'importation permet de récupérer les elèves d'une classe de l'année précédente de la même école.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-24-hours"></i>
                                        </div>
                                        <div class="text">
                                            <h6>J'alloue un avatar à un élève</h6>
                                            <p>Un système de choix d'avatar vous permettra de personnaliser votre fiche élève. Vous pouvez même faire choisr son avatar à chaque élève :)</p>
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
                                <h3>Je choisis mes activités</h3>
                                <p>Parmi plus de 190 fiches existantes réparties dans 8 domaines officiels.</p>
                                <ul>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-mobile-app-developing"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Importation des fiches par section</h6>
                                            <p>Sélection rapide de fiches correspondant au programmes de PS, MS et GS.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-setup"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Création et duplication de fiches</h6>
                                            <p>Personalisation de fiches existantes et création de vos propros fiches d'activité.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-5 order-0 order-lg-1">
                            <div class="image text-center wow fadeInRight" data-wow-delay="0.3s" data-wow-duration="1s">
                                <img class="rounded" src="{{asset('assets/images/home1/application/2.jpg')}}" alt="About">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="home1 about p-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <div class="image text-center wow fadeInLeft" data-wow-delay="0.3s" data-wow-duration="1s">
                                <img class="rounded" src="{{asset('assets/images/home1/application/3.jpg')}}" alt="About">
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="content wow fadeInRight" data-wow-delay="0.3s" data-wow-duration="1s">
                                <h3>Je paramètre ma classe</h3>
                                <p>Vous pouvez définir différents paramétrage qui vont définir votre année scolaire.</p>
                                <ul>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-ribbon"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Périodicité des cahiers de réussites</h6>
                                            <p>Définissez si vous voulez éditer les cahiers de réussites par trimestre, semestre ou annuellement.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-24-hours"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Saisie de vos aides maternelles et de la direction</h6>
                                            <p>Ces données seront présentes dans la section " équipe pédagogique " du cahier de réussites.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-24-hours"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Choisir d'inclure le domaine " Devenir élève " si vous souhaitez le traiter</h6>
                                            <p>Plus au programme officiel depuis 2015, de nombreux instituteurs veulent le encore traiter. 26 fiches réparties dans les trois sections sont disponibles après activation.</p>
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
                                <h3>J'évalue mes élèves</h3>
                                <p>Une interface conviviale vous permettra rapidement d'évaluer vos élèves.</p>
                                <ul>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-mobile-app-developing"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Système de notation rapide et intuitive que ce soit sur l'application mobile ou sur votre ordinateur.</h6>
                                            <p>Notez vos élèves selon 3 niveaux : Acquis, Acquis avec aide, En voie d'acquisition.</p>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-5 order-0 order-lg-1">
                            <div class="image text-center wow fadeInRight" data-wow-delay="0.3s" data-wow-duration="1s">
                                <img class="rounded" src="{{asset('assets/images/home1/application/4.jpg')}}" alt="About">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="home1 about p-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <div class="image text-center wow fadeInLeft" data-wow-delay="0.3s" data-wow-duration="1s">
                                <img class="rounded" src="{{asset('assets/images/home1/application/5.jpg')}}" alt="About">
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="content wow fadeInRight" data-wow-delay="0.3s" data-wow-duration="1s">
                                <h3>Je rédige le cahier de réussites</h3>
                                <p></p>
                                <ul>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-ribbon"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Editeur de texte par section</h6>
                                            <p>A l'aide d'un éditeur de texte par section pré-rempli des activités acquises par l'élève, vous rédigerez vos commentaires par section ainsi qu'un commentaire général.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-24-hours"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Sauvegarde automatique</h6>
                                            <p>Durant la saisie, la sauvegarde de vos textes se fera automatiquement. Aucun rique de perdre votre travail.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-24-hours"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Apercu du cahier de réussites</h6>
                                            <p>Le cahier de réussites terminé et notifié " Prêt à l'envoi ", vous pourrez alors le consulter avant de l'envoyer aux parents</p>
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
                                <h3>Administration des cahiers de réussites</h3>
                                <p>Une interface simple et intuitive pour l'envoi des cahiers de réussites aux parents.</p>
                                <ul>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-mobile-app-developing"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Gestionnaire d'envoi</h6>
                                            <p>Un tableau en temps réel vous permettra d'envoyer par lot ou individuellement un mail contenant un lien d'accès à l'espace parent.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-setup"></i>
                                        </div>
                                        <div class="text">
                                            <h6>L'espace Parent</h6>
                                            <p>Un espace personalisé et sécurisé permettra aux parents de télécharger le cahier de réussites de leur enfant.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-5 order-0 order-lg-1">
                            <div class="image text-center wow fadeInRight" data-wow-delay="0.3s" data-wow-duration="1s">
                                <img class="rounded" src="{{asset('assets/images/home1/application/6.jpg')}}" alt="About">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="home1 about p-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <div class="image text-center wow fadeInLeft" data-wow-delay="0.3s" data-wow-duration="1s">
                                <img class="rounded" src="{{asset('assets/images/home1/application/7.jpg')}}" alt="About">
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="content wow fadeInRight" data-wow-delay="0.3s" data-wow-duration="1s">
                                <h3>Vos outils </h3>
                                <p></p>
                                <ul>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-ribbon"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Votre tableau de bord</h6>
                                            <p>Un tableau de bord vous permettra d'avoir l'état en temps réel de l'activité de votre classe.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-24-hours"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Le calendrier</h6>
                                            <p>Un calendrier notifiant les vacances scolaires ainsi que les anniversaires des enfants est à votre disposition. Un gestionnaire d'évenment est aussi disponible pour ne rien oublier.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-24-hours"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Le partage de classe</h6>
                                            <p>Un instituteur titulaire pourra partager sa classe avec un suppléant ou un co-titulaire.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!-- end about area -->


    <!-- end counter area -->

    <!-- start team area -->
    

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

