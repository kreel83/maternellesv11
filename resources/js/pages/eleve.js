import { Modal } from 'bootstrap'

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            save_photo = $('#photo_form').attr('src')
            $('#photo_form').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}


let save_photo

const setDefaultImg = (e) => {
    console.log(e)
}

const preview_photo = (event) => {
    $("#photo_input").change(function() {
        $('#delete_photo').css('display','')
        readURL(this);
    });
}

const delete_photo = () => {
    $('#delete_photo').on('click', function() {
        $('#photo_form').attr('src', save_photo);
        $('#photo_input').val('')
        $('#delete_photo').css('display','none')
    })
}

const photo_eleve = () => {
    $(document).on('click','#photo_form', function() {
        $('#photo_input').trigger('click')
    })
}

const choix_eleve = () => {
    $(document).on('click', '#tableau_eleves tr, #new_eleve', function() {
        $('#nom_form').val($(this).find('td:eq(1)').data('value'))
        $('#prenom_form').val($(this).find('td:eq(2)').data('value'))
        $('#ddn_form').val($(this).find('td:eq(3)').data('value'))
        $('#genre_form').val($(this).find('td:eq(4)').data('value'))
        $('#groupe_form').val($(this).find('td:eq(5)').data('value'))
        $('#mail1_form').val($(this).find('td:eq(6)').data('value1'))
        $('#mail2_form').val($(this).find('td:eq(6)').data('value2'))
        $('#eleve_form').val($(this).data('id'))
        $('#photo_form').attr('src',$(this).data('photo'))
        console.log($(this).data('id'))
        $('#commentaire_form').val($(this).data('commentaire'))

        var myModal = new Modal(document.getElementById('myModal'), {
            keyboard: false
        })
        myModal.toggle()



    })
}

export {choix_eleve, photo_eleve, preview_photo, delete_photo, setDefaultImg}
