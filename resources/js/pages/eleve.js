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
                console.log(data)
                $('.liste_eleves').html(data)
            }
        })
    })

    $(document).on('click','.prenom', function() {
        function updateCurvedText($curvedText, radius, prenom) {
            
            // $curvedText.css("min-width", "initial");
            // $curvedText.css("min-height", "initial");
            var w = $curvedText.width(),
              h = $curvedText.height();
            // $curvedText.css("min-width", w + "px");
            // $curvedText.css("min-height", h + "px");
            var text = prenom;
            var html = "";
          Array.from(text).forEach(function (letter) {
              html += `<span class="letter">${letter}</span>`;
            });
            $curvedText.html(html);
          var $letters = $curvedText.find("span");
            $letters.css({
              position: "absolute",
              height:`${radius}px`,
              // backgroundColor:"orange",
              transformOrigin:"bottom center"
            });
            
            var circleLength = 2 * Math.PI * radius;
            var angleRad = w/(2*radius);
            var angle = 2 * angleRad * 180/Math.PI/text.length;
            
            
            $letters.each(function(idx,el){
              $(el).css({
                  transform:`translate(${w/2}px,0px) rotate(${idx * angle - text.length*angle/2.5}deg)`
              })
            });
          }
           $('.letter').css('all','unset')
          var $curvedText = $(".curved-text");
          var prenom = $(this).data('prenom')
          var enfant = $(this).data('enfant')
          $('.choixEnfant').attr('data-enfant', enfant)
          console.log($curvedText)
          updateCurvedText($curvedText,60, prenom);

    })

    $(document).on('click','.choixEnfant', function() {
        var enfant = $(this).attr('data-enfant')
        var background = $(this).attr('data-degrade')
        var animaux = $(this).attr('data-animaux')
        $.get('/eleves/setAnimaux?background='+background+'&enfant='+enfant+'&animaux='+animaux, function(data) {
            console.log(data)
        })  
    })
        
    $(document).on('click','.choixDegrade', function() {
        var css = $(this).css('background')
        var id = $(this).data('id')
        $('.choixEnfant').css('background', css)
        $('.choixEnfant').attr('data-degrade', id)

    })

    $(document).on('click','.animaux', function() {
        var html = $(this).html()
        var animaux = $(this).data('animaux')
        $('.choixEnfant .imageAnimaux').html(html)
        $('.choixEnfant').attr('data-animaux', animaux)
    })

    $(document).on('click','.delete', function() {
        var prof = $(this).attr('data-id')
        var id = $('#eleve_form').val()
        $.get('/eleves/removeEleve?prof='+prof+'&eleve='+id, function(data) {
            $('.fiche_eleve[data-id="'+id+'"]').remove()
            $('#new_eleve').addClass('d-none')
            $('#import_eleves').removeClass('d-none')
            $('#tableau_tous').html(data)
        })
    })

    $(document).on('click','.fiche_eleve', function() {
        var data = $(this).data('donnees')
        var mails = data.mail.split(';')
        console.log(data)
        $('#nom_form').val(data.nom)
        $('#prenom_form').val(data.prenom)
        $('#ddn_form').val(data.ddn)
        $('#genre_form').val(data.genre)
        $('#groupe_form').val(data.groupe)
        $('#mail1_form').val(mails[0])
        $('#mail2_form').val(mails[1])
        $('#eleve_form').val(data.id)
        $('#photo_form').attr('src',data.photo)
        $('.delete').attr('data-id', data.user_n1_id ?? 'null')
        $('.delete').removeClass('d-none')
        if (data.user_n1_id) {
            $('.delete').text("Retirer l'élève de ma classe")
        } else {
            $('.delete').text('Supprimer la fiche')
        }
        console.log($(this).data('id'))
        $('#commentaire_form').val(data.comment)


        $('.bloc_droite_classe').addClass('d-none')
        $('#new_eleve').removeClass('d-none')
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
    

    $(document).on('click','.tab_button', function() {
        var tab = $(this).data('tab')
        console.log(tab)
        $('.bloc_droite_classe').addClass('d-none')
        $('#'+tab).removeClass('d-none')
    })

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


}

export {choix_eleve, photo_eleve, preview_photo, delete_photo, setDefaultImg}
