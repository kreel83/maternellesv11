require('./bootstrap');
require('./quill.js');

window.Quill = require('Quill');
export default Quill;


import 'bootstrap';

import Alpine from 'alpinejs';


import {selectItem, hamburger} from './pages/items';
import {choicePhrase, clickOnNav, saveTexte, onload, apercu, clickOnDefinif, saveTexteReussite} from './pages/cahier';


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
            }

        })
    });

});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var quill = new Quill('#editor', {
    theme: 'snow'
});

window.section_active = null

selectItem()
hamburger()

choicePhrase(quill)
clickOnNav(quill)
saveTexte(quill)
onload(quill)
apercu(quill)
clickOnDefinif(quill)
saveTexteReussite(quill)
