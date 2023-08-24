
import $ from 'jquery';
import 'bootstrap';

import 'bootstrap/dist/css/bootstrap.css'
import '@fortawesome/fontawesome-free/scss/fontawesome.scss';
import '@fortawesome/fontawesome-free/scss/brands.scss';
import '@fortawesome/fontawesome-free/scss/regular.scss';
import '@fortawesome/fontawesome-free/scss/solid.scss';
import '@fortawesome/fontawesome-free/scss/v4-shims.scss';


import '../../node_modules/quill/dist/quill';
//import Quill from 'quill/quill';
//window.Quill = Quill;


import Alpine from 'alpinejs';

import './menu'
import {selection, hover, choosePeriode, savePeriode, initCalendar, initCalendrier, initCalendrierPeriodes} from "./pages/calendrier";
import {chercheCommune, chercheEcole, choixEcole} from "./pages/ecole";
import {choix_eleve, photo_eleve, preview_photo, delete_photo, setDefaultImg} from "./pages/eleve";
import {selectItem, hamburger} from './pages/items';
import {choicePhrase, clickOnNav, saveTexte, onload, apercu, clickOnDefinif, saveTexteReussite, phraseCommentaireGeneral, saveCommentaireGeneral, clickOnCahier} from './pages/cahier';
import {selectPhrase, deletePhrase, editPhrase, nouvellePhrase, cancelNouvellePhrase, setMotCle, saveNouvellePhrase} from "./pages/phrase";
import {
    initFiche,
    selectSectionFiche,
    selectFiche,
    choixTypeFiches,
    choixFiltre,
    jechoisislaselection,
    photoEnfant,
    photoEnfantTrigger,
    editor2change,
    setMotCleFiche,
    jemodifielafiche, jeducpliquelafiche,
    choixSection
} from './pages/fiche';
import {choix_equipe} from "./pages/equipe";
import {adminRegistration} from "./pages/admin";
import {achatLicences,assigneLicence} from "./pages/subscription";
import {contactform} from "./pages/contact";


window.Alpine = Alpine;

Alpine.start();

$(document).ready(function($) {



    $(document).on("click",".card__share  div", function(e){
            e.preventDefault()
        var that = $(this).closest('.card')
        var $this = $(this)
        var enfant = $(this).closest('.card').data('enfant')
        var item = $(this).closest('.card').data('item')
        var notation = $(this).data('notation')
        var card = $(this).closest('.card')
        //e.preventDefault() // prevent default action - hash doesn't appear in url
        $(this).parent().find( 'div' ).toggleClass( 'card__social--active' );
        $(this).toggleClass('share-expanded');
        if (notation != null) {
            $.get('/app/resultat/setNote?enfant='+enfant+'&item='+item+'&notation='+notation, function(data) {
                // if (data == 'raz') {
                //     $(that).find('.share-toggle').css('background-color','white')
                // } else {
                //     $(that).find('.share-toggle').css('background-color',data['color'])
                // }
                //
                // $(that).find('.share-toggle').toggleClass('share-expanded');
                // $(that).find('.share-toggle>i').toggleClass('hide');
                // $(that).find('.card__social').toggleClass('card__social--active')
                $(card).find('.card__content').html(data)


            })
        }

    });

});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});








if ($('#editorApercu').length) {
    var quill = new Quill('#editorApercu', {
        theme: 'snow'
    });
    console.log('2')
    clickOnCahier(quill)
    clickOnDefinif(quill)
    console.log('def')

}

if ($('#editor').length) {
    var quill = new Quill('#editor', {
        theme: 'snow'
    });
    console.log('1')
    choicePhrase(quill)
    console.log('2')
    clickOnNav(quill)
    console.log('3')
    saveTexte(quill)
    console.log('4')
    onload(quill)
    console.log('5')
    apercu(quill)
    console.log('6')

    saveTexteReussite(quill)
    console.log('8')
    saveCommentaireGeneral(quill)
    console.log('8')
}

if ($('#editor2').length) {
        var quill2 = new Quill('#editor2', {
            modules: {
                toolbar: false    // Snow includes toolbar by default
            },
            theme: 'snow'
        });
    editPhrase(quill2)
    deletePhrase()
    nouvellePhrase(quill2)
    cancelNouvellePhrase(quill2)
    setMotCle(quill2)
    saveNouvellePhrase(quill2)
}

if ($('#editor3').length) {

    var quill3 = new Quill('#editor3', {
        modules: {
            toolbar: false    // Snow includes toolbar by default
        },
        theme: 'snow'
    });
    editor2change(quill3)
    setMotCleFiche(quill3)
}

window.section_active = null



selectItem()
hamburger()



selectPhrase()

phraseCommentaireGeneral()

jeducpliquelafiche()
jemodifielafiche()
initFiche()
selectSectionFiche()
selectFiche()
choixTypeFiches()
choixFiltre()
jechoisislaselection()
photoEnfant()
photoEnfantTrigger()
choixSection()



choix_eleve()
photo_eleve()
preview_photo()
delete_photo()
setDefaultImg()


selection()
hover()
choosePeriode()
savePeriode()
initCalendar()
initCalendrier()
initCalendrierPeriodes()

chercheCommune()
chercheEcole()
choixEcole()

choix_equipe()

adminRegistration()
achatLicences()
assigneLicence()

contactform()