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
        console.log('photo')
        $('#photo_input').trigger('click')
    })

    $(document).on('click','#tableau_eleves .remove', function(e) {
        e.stopImmediatePropagation()
        var id = $(this).closest('tr').data('id')
        $(this).closest('tr').remove()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')                    }
        });
        $.ajax({
            method: 'POST',
            url: "/eleves/removeEleve",
            data: {
                eleve: id,
                prof: $('#selectProf').val()
            },
            success: function(data) {
                $('#tableau_tous').html(data)
            }
        })
    })

    $(document).on('click','#ajouterEleves', function() {
        var arr = []
        $('#tableau_tous tr input:checked').each((index, el) => {
            arr.push($(el).closest('tr').data('id'))
            $(el).closest('tr').remove()
        })
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')                    }
        });
        $.ajax({
            method: 'POST',
            url: "/eleves/ajouterEleves",
            data: {
                eleves: arr
                
            },
            success: function(data) {
                $('#tableau_eleves').html(data)
            }
        })
    })


    $(document).on('change','#selectProf', function() {
        console.log('select')
        var id = $(this).val()
        if (id == 'null') {
            $('#tableau_tous tr').removeClass('d-none')
        } else {
            $('#tableau_tous tbody tr').addClass('d-none')
            $('#tableau_tous tr[data-prof="'+id+'"]').removeClass('d-none')            
        }

    })
}

const choix_eleve = () => {

    $(document).on('change','#allSelectEleve', function() {
        if ($(this).prop('checked') == true) {            
            $('#tableau_tous tr:visible input').prop('checked', true)
        } else {
            $('#tableau_tous tr:visible input').prop('checked', false)

        }
    })

    $(document).on('click','#recup_mes_eleves', function() {
        $.get('/recupClasse', function() {
            location.reload();
        })
    })

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
