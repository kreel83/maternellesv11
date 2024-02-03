
import $ from 'jquery';
window.$ = $;
// import 'bootstrap';

import { Modal } from 'bootstrap'

import 'bootstrap/dist/css/bootstrap.css'
import '@fortawesome/fontawesome-free/scss/fontawesome.scss';
import '@fortawesome/fontawesome-free/scss/brands.scss';
import '@fortawesome/fontawesome-free/scss/regular.scss';
import '@fortawesome/fontawesome-free/scss/solid.scss';
import '@fortawesome/fontawesome-free/scss/v4-shims.scss';

import '/node_modules/@fortawesome/fontawesome-free/css/all.min.css';



// import '../../node_modules/quill/dist/quill';


import Quill from 'quill';
import 'quill/dist/quill.snow.css';
//window.Quill = Quill;


import Alpine from 'alpinejs';

import './menu'
import { importation} from './pages/import';
import { tutos } from './tutos/tutos';
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
// import {adminRegistration} from "./pages/admin";
import {achatLicences,assigneLicence} from "./pages/subscription";
import {envoiCahierIndividuel} from "./pages/pdf";
import {partageDeClasse} from "./pages/partage";
import {creationCompte} from "./pages/register";

window.Alpine = Alpine;

Alpine.start();

$(document).ready(function($) {
    


    if ($('#maclasse').length) {
        if ($('#maclasse').attr('data-modif')) {
            var id = $('#maclasse').attr('data-modif')
            
            $('.fiche_eleve_div[data-id="'+id+'"]').trigger('click')
        }
    }
    

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




if ($('.alerteMessage').length) {
    setTimeout(() => {
        $('.alerteMessage').remove()
    }, 3000);
}


if ($('.editorApercu').length) {
    $($('.editorApercu').get().reverse()).each((index, el) => {
        
        
        var section = $(el).data('section')
        console.log('section : '+section)
        var ColorClass = Quill.import('attributors/class/color');
        var SizeStyle = Quill.import('attributors/style/size');
        Quill.register(ColorClass, true);
        Quill.register(SizeStyle, true);

        var toolbarOptions = ['bold', 'italic', 'underline', 'strike'];
        var quill = new Quill(el, {
            modules: {

                toolbar: toolbarOptions,


            },
            theme: 'snow',

        });

        const myModal = new Modal('#informationPDF', {})
        clickOnCahier(quill, myModal)
        clickOnDefinif(quill, section)

        saveTexte(quill)
        onload(quill)
        apercu(quill, section)    
        saveTexteReussite(quill)
        saveCommentaireGeneral(quill)
    })



}

choicePhrase(Modal) 
clickOnNav()

if ($('#editor2').length) {
        var quill2 = new Quill('#editor2', {
            modules: {
                toolbar: false    // Snow includes toolbar by default
            },
            theme: 'snow',
            
        });
    quill2.enable(false)
    editPhrase(quill2)
    deletePhrase(quill2)
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

if ($('#editorModif').length) {

    var quill4 = new Quill('#editorModif', {
        modules: {
            toolbar: false    // Snow includes toolbar by default
        },
        theme: 'snow'
    });
    selectItem(Modal, quill4)
}

window.section_active = null



hamburger()



selectPhrase()

phraseCommentaireGeneral()

jeducpliquelafiche()
jemodifielafiche()
initFiche()
var ficheSelect;
selectSectionFiche(ficheSelect)
selectFiche(Modal)
choixTypeFiches(Modal)
choixFiltre(Modal, quill4)
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
hover(Modal)
choosePeriode()
savePeriode()
initCalendar()
initCalendrier()
initCalendrierPeriodes()

importation()

chercheCommune()
chercheEcole()
choixEcole()

choix_equipe()

// adminRegistration()
achatLicences()
assigneLicence()



tutos()
envoiCahierIndividuel()

partageDeClasse()
creationCompte()