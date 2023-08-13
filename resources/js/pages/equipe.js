import { Modal } from 'bootstrap'

// function readURL(input) {
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();
//         reader.onload = function(e) {
//             save_photo = $('#photo_form').attr('src')
//             $('#photo_form').attr('src', e.target.result);
//         }
//         reader.readAsDataURL(input.files[0]);
//     }
// }
//
//
// let save_photo
//
// const setDefaultImg = (e) => {
//     console.log(e)
// }
//
// const preview_photo = (event) => {
//     $("#photo_input").change(function() {
//         $('#delete_photo').css('display','')
//         readURL(this);
//     });
// }
//
// const delete_photo = () => {
//     $('#delete_photo').on('click', function() {
//         $('#photo_form').attr('src', save_photo);
//         $('#photo_input').val('')
//         $('#delete_photo').css('display','none')
//     })
// }
//
// const photo_eleve = () => {
//     $(document).on('click','#photo_form', function() {
//         console.log('photo')
//         $('#photo_input').trigger('click')
//     })
// }

const choix_equipe = () => {
    $(document).on('click', '#new_equipe', function() {
        // $('#nom_form').val($(this).find('td:eq(1)').data('value'))
        // $('#prenom_form').val($(this).find('td:eq(2)').data('value'))
        // $('#fonction_form').val($(this).find('td:eq(3)').data('value'))
        // $('#equipe_form').val($(this).data('id'))
        // $('#photo_form').attr('src',$(this).data('photo'))
        // console.log($(this).data('id'))
        $('.aideLeft').removeClass('d-none')
        $(this).addClass('d-none')
    })
    $(document).on('click', '.delete_aide', function() {
        console.log('deleting')
    })
    $(document).on('click', '.card_aides .modif', function() {
        var data = $(this).closest('.card_aides').data('donnees')
        var domain = window.location.hostname
        console.log(data)

        $('#titreAide').text('Mofification')
        $('#nom_form').val(data.name)
        $('#prenom_form').val(data.prenom)
        $('#fonction_form').val(data.fonction)
        $('#equipe_form').val(data.id)
        $('#photo_form').attr('src',$(this).closest('.card_aides').data('photo'))
        console.log($(this).data('id'))
        $('.aideLeft').removeClass('d-none')
        $('#new_equipe').addClass('d-none')
        
    })
}

export {choix_equipe}
