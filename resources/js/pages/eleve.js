
import * as bootstrap from 'bootstrap';

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

    $(document).on('click',".avatar_form",function() {
        $('.avatar_form').removeClass('selected')
        $(this).addClass('selected')
        $('#genre').val($(this).data('genre'))
    })

    $(document).on('click',".color_rond",function() {
        var id = $(this).closest('.card-eleve').data('eleve')
        var color =  $(this).data('color')
        var order =  $(this).data('order')
        console.log('color', color, id)
        $(this).closest('.card-eleve').css('border-color', color)
        $.get('/app/groupe/affectation?eleve='+id+'&order='+order, function(data) {
            console.log(data)
        })

    })

    $(document).on('click',".table-cours tr",function() {
        var state = $(this).find('input').attr('checked')
        console.log(state, !state)
        $(this).find('input').attr('checked', !state)
        $(this).toggleClass('selected')

    })


    $(document).on('click',".terme",function() {
        $('.terme').removeClass('selected')
        $(this).addClass('selected')

    })
    $(document).on('click',"#saveTermes",function() {
        var termes = $('#termes').val();
       
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')                    }
        });
        $.ajax({
            url : '/app/groupe/saveTermes',
            method: 'POST',
            data: {
                'tableau': termes.trim()
            },
            success: function(data) {
                console.log(data)
            }
        })

    })
    
    $(document).on('click',"#saveColor",function() {

        const rgb2hex = (rgb) => `#${rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/).slice(1).map(n => parseInt(n, 10).toString(16).padStart(2, '0')).join('')}`

        
        var nb = $('.rond_couleur.active').length;
        var liste = $('.rond_couleur.active');
        console.log('nb', nb)
        if (nb > 1) {
            var arr = [];
            $('.rond_couleur.active').each((index, el) => {
                var r = {};
                var c = $(el).css('background-color')
                r['color'] = rgb2hex(c)
                r['order'] = $(el).find('.order').text()
                arr.push(r)
            })

        }
        console.log('arr',arr)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')                    }
        });
        $.ajax({
            url : '/app/groupe/saveColor',
            method: 'POST',
            data: {
                'tableau': JSON.stringify(arr)
            },
            success: function(data) {
                console.log(data)
            }
        })

    });


    //commentaire


    $(document).on('click','#raz_search_eleve', function(e) {
        $('#search_eleve').val('')
        $('.table-cours tr').removeClass('d-none') 

    })

    $(document).on('keyup','#search_eleve', function(e) {
        var input = $(this).val().toUpperCase()
        if (input == '') {
            $('.table-cours tr').removeClass('d-none') 
        }
        $('.table-cours tr:visible').each((index, el) => {
            console.log(input, $(el).data('nomcomplet').toUpperCase)
            if (!$(el).data('nomcomplet').toUpperCase().includes(input)) {
                $(el).addClass('d-none')
            }
        })

    })

    $(document).on('click','.badge_termes', function() {
        
        var el = $(this).closest('.footer')
        $(el).find('.badge_termes').removeClass('active')
        //$(this).addClass('active')
        var id = $(el).data('enfant')
        var ordre = $('#ordre').val()

        var order =  $(this).data('order')
        var card = $(this).closest('.card-enfant')

        $(card).find('.groupe-terme').css('background-color', $(this).data('color'))
        $(card).find('.groupe-terme').text($(this).text())
        $(card).find('.groupe-terme').removeClass('d-none')


        $.get('/app/groupe/affectation?eleve='+id+'&order='+order, function(data) {
            if (ordre == 'groupe') {
                window.location.reload()
            }
        })
    })

    $(document).on('change','#nbGroupe', function() {
        var nb = parseInt($(this).val())
        if (nb >1 && nb <5) {
            $('.terme').addClass('d-none')
            for(var i = 1; i<=nb; i++) {
                $('#terme'+i).removeClass('d-none')
            }
        }
    })
    $(document).on('focus','.br-40', function() {
        $('.terme').removeClass('selected')
        $(this).closest('.terme').addClass('selected')
    })
    $(document).on('click','.rond_couleur_font', function() {
        var el = $('.terme.selected')
        var color = $(this).data('color')
        console.log(color)
        $(el).find('.badge_terme').css('color', color  )
        $(el).find('.policeColor').val(color)
    })
    $(document).on('click','.rond_couleur', function() {
        var el = $('.terme.selected')
        var color = $(this).data('color')
        console.log(color)
        $(el).find('.badge_terme').css('background-color', color  )
        $(el).find('.fondColor').val(color)
    })
    $(document).on('keyup','.br-40', function(e) {
        if (e.key == "tab") {
            $(this).trigger('focus')
            return false;
        }
        var el = $(this).closest('.selected')
        console.log(e.key, e.typeof)
        

            var text = $(this).val()
            $(el).find('.badge_terme').text(text)

       

    })
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

    $(document).on('click','#import-tab', function() {
        window.location.reload()
    })

    $(document).on('click', '.fiche_eleve_div', function() {
        $('#create-tab').trigger('click')
        $('#create-tab').text('Modifier une fiche')
        var data = $(this).data('donnees')
        var mails = data.mail.split(';')
        console.log(mails)
        var prof = $(this).data('prof')
        console.log(prof)
        if (!prof) {
            $('.delete').text('Supprimer')
        } else {
            $('.delete').text('Retirer')

        }
        $('.avatar_form').removeClass('selected')
        $('.avatar_form[data-genre="'+data.genre+'"]').addClass('selected')

        $('#nom_form').val(data.nom)
        $('#prenom_form').val(data.prenom)
        $('#ddn_form').val(data.ddn)
        $('#commentaire_form').val(data.comment)
        $('#mail1_form').val(mails[0])
        $('#mail2_form').val(mails[1])
        $('#eleve_form').val(data.id)
        $('#'+data.psmsgs).prop("checked", true)
        if (data.sh == 1 ) {
            $('#sh').attr('checked',true)
        }  else {
            $('#sh').attr('checked',false)
        }
        if (data.reussite == 1 ) {
            $('#reussite').attr('checked',true)
        }  else {
            $('#reussite').attr('checked',false)
        }
      
        console.log(data)
    })





    $(document).on('click','.submit', function(e) {
        var form = {}
        $('#elevePost input').each(function(index, element){
            var name = $(this).attr('name');
            if ($(this).is(':checkbox')) {
                form[name] = $(this).prop('checked');
            } else {
                form[name] = $(this).val();
            }
        });
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  
            }
        });
        $.ajax({
            method: 'POST',
            url: '/app/eleves/save',
            data: form,
            success: function(data) {
                $('.error_input,br').remove();
                if(data.state){
                    if ($('#myToast').length) var toast = new bootstrap.Toast(document.getElementById('myToast'), {})
                    toast.show()
                    var texte = $('#eleve_form').val() == 'new' ? "L'élève a bien été créé et ajouter à votre classe" : "L'élève a bien été modifié";
                    $('#myToast').find('.toast-body').text(texte)
                        setTimeout(function() {
                            toast.dispose()
                            $('#import-tab').trigger('click')                             
                        },3000)
                } else {
                    console.log(data.errors)
                    $.each(data.errors,function(input_name,input_errors){
                        $.each(input_errors,function(i,error){
                            $('<small class="error_input">'+error+'</small><br>').insertAfter('#elevePost input[name="'+input_name+'"]');
                        });
                    });
                }
            }
        })


    })

    $(document).on('click','.remove_eleve', function(e) {
        e.stopImmediatePropagation()
        var id = $('#eleve_form').val()
        

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')                    }
        });
        $.ajax({
            method: 'POST',
            url: "/app/eleves/removeEleve",
            data: {
                eleve: id,
            },
            success: function(data) {
                if ($('#myToast').length) var toast = new bootstrap.Toast(document.getElementById('myToast'), {})
                toast.show()
                var texte = "L'élève a bien été retiré de votre classe";
                $('#myToast').find('.toast-body').text(texte)
                    setTimeout(function() {
                        toast.dispose()
                        window.location.reload()                            
                    },3000)
                
            }
        })
    })

    $(document).on('click','#ajouterEleves', function() {
        var arr = []
        var nb = $('#tableau_tous tr input:checked').length
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
            url: "/app/eleves/ajouterEleves",
            data: {
                eleves: arr
                
            },
            success: function(data) {
                if ($('#myToast').length) var toast = new bootstrap.Toast(document.getElementById('myToast'), {})
                toast.show()
                $('.liste_eleves').html(data)
                var texte =  (nb > 1) ?  nb+" élèves ont bien été ajoutés à votre classe" : "L'élève a bien été ajouté à votre classe";
                $('#myToast').find('.toast-body').text(texte)
                    setTimeout(function() {
                        toast.dispose()                            
                    },3000)
                
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

    $(document).on('change','#choix_enfant_select', function() {
        var id = $('#choix_enfant_select').val()
        $.get('/app/choix_enfant_select?id='+id, function(data) {
           $('#eleveCard').html(data) 
        })
        
        
 
    })
    $(document).on('click','#valideAvatar', function() {

        if ($('#myToast').length) var toast = new bootstrap.Toast(document.getElementById('myToast'), {})

        var enfant = $('#eleveCard').data('enfant')
        console.log(enfant)
        var background = $('.degrade_card_enfant').attr('data-degrade')
        var animaux = $('.degrade_card_enfant').attr('data-animaux')
        $.get('/app/eleves/setAnimaux?background='+background+'&enfant='+enfant+'&animaux='+animaux, function(data) {


            toast.show()
            setTimeout(function() {
                toast.dispose()
                $('#choix_enfant_select').val('null')

            },3000)
        })
    })
        
    $(document).on('click','.choixDegrade', function() {
        var css = $(this).css('background')
        var id = $(this).data('id')
        console.log('id', id)
        $('.degrade_card_enfant').attr('data-degrade', id)
        $('.degrade_card_enfant, .footer').css('background', css)

    })

    $(document).on('click','#photos .animaux', function() {
        var html = $(this).html()
        var animaux = $(this).data('animaux')

        $('.degrade_card_enfant').attr('data-animaux', animaux)
        $('.degrade_card_enfant').html(html)
    })

    $(document).on('click','.delete', function() {
        var prof = $(this).attr('data-id')
        var id = $('#eleve_form').val()
        $.get('/app/eleves/removeEleve?prof='+prof+'&eleve='+id, function(data) {
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
        $.get('/app/recupClasse', function() {
            location.reload();
        })
    })


}

export {choix_eleve, photo_eleve, preview_photo, delete_photo, setDefaultImg}
