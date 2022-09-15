import {chercheCommune, chercheEcole, choixEcole} from "./pages/ecole";

require('./bootstrap');
require('./quill.js');
window.bootstrap = require('./bootstrap');

window.Quill = require('Quill');
export default Quill;


import 'bootstrap';


import Alpine from 'alpinejs';
import $ from 'jquery';
window.$ = window.jQuery = $;

import 'jquery-ui/ui/widgets/datepicker.js';
import 'jquery-ui/ui/widgets/sortable.js';

import {selection, hover, choosePeriode, savePeriode, initCalendar, initCalendrier} from "./pages/calendrier";

import {choix_eleve, photo_eleve, preview_photo, delete_photo, setDefaultImg} from "./pages/eleve";
import {selectItem, hamburger} from './pages/items';
import {choicePhrase, clickOnNav, saveTexte, onload, apercu, clickOnDefinif, saveTexteReussite} from './pages/cahier';
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
    jemodifielafiche, jeducpliquelafiche
} from './pages/fiche';


window.Alpine = Alpine;

Alpine.start();

$(document).ready(function($) {





    $('.card__share  a').on('click', function(e){
        var that = $(this).closest('.card')
        var $this = $(this)
        var enfant = $(this).closest('.card').data('enfant')
        var item = $(this).closest('.card').data('item')
        var notation = $(this).data('notation')
        //e.preventDefault() // prevent default action - hash doesn't appear in url
        $(this).parent().find( 'div' ).toggleClass( 'card__social--active' );
        $(this).toggleClass('share-expanded');
        $.get('/resultat/setNote?enfant='+enfant+'&item='+item+'&notation='+notation, function(data) {
            if (notation != null) {


                    $(that).find('.share-toggle').css('background-color',data['color'])
                    $(that).find('.share-toggle').toggleClass('share-expanded');
                    $(that).find('.share-toggle>i').toggleClass('hide');
                    $(that).find('.card__social').toggleClass('card__social--active')
            }

        })
    });

});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

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
    clickOnDefinif(quill)
    console.log('7')
    saveTexteReussite(quill)
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

chercheCommune()
chercheEcole()
choixEcole()

console.log('9')

