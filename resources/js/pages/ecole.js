
import * as bootstrap from 'bootstrap';

const chercheCommune = () => {
    $(document).on('click','#chercheCommuneBtn', function() {
        var search = $('#chercheDpt').val()
        $.get('/ecole/chercheCommune?search='+search, function(data) {
            $('#communeContainer').html(data)
        })
    })
}

const chercheEcole = () => {
    $(document).on('click','.commune', function() {
        var code = $(this).data('codecom')
        $.get('/ecole/chercheEcoles?commune='+code, function(data) {
            $('#listeEcoles').html(data)
        })
    })
}

const choixEcole = () => {
    if ($('#confirmationEcole').length) var myModal = new bootstrap.Modal(document.getElementById('confirmationEcole'), {})
    if ($('#myToast').length) var toast = new bootstrap.Toast(document.getElementById('myToast'), {})



    $(document).on('click','.ecole', function() {
                var choixEcole = $(this).data('num')
        $.get('/ecole/confirmation?ecole='+choixEcole, function(data) {
            $('#confirmationEcole .modal-body').html(data)
            $('#confirmeEcole').attr('data-id',choixEcole)
            myModal.show()            
        })
    })
    
    $(document).on('click','#confirmeEcole', function() {
        var choixEcole = $(this).data('id') 
 
        $.get('/ecole/choixEcole?ecole='+choixEcole, function(data) {
            myModal.hide()  
            console.log(data)
            // var myToastEl = document.getElementById('myToast')
            // var myToast = bootstrap.Toast.getOrCreateInstance(myToastEl)
            // myToast.show()
            
        }).then(function() {
            toast.show()
            setTimeout(function() {
                toast.dispose()
                window.open('/home','_self')

            },3000)
        })
        
    })
}


export {chercheCommune, chercheEcole, choixEcole}
