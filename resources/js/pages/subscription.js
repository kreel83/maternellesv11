const achatLicences = () => {

    $(document).on('click','#btnAddLicence', function() {
        var newQuantity = parseInt($('#quantite').val())+1
        var price = parseFloat($('#prixLicence').val())
        $('#quantite').val(newQuantity)
        $('#quantity').val(newQuantity) // in post form to send to card/paypal
        $('#totalPrice').html((newQuantity * price).toFixed(2))
    })

    $(document).on('click','#btnRemoveLicence', function() {
        var newQuantity = parseInt($('#quantite').val())-1
        var price = parseFloat($('#prixLicence').val())
        if(newQuantity > 0) {
            $('#quantite').val(newQuantity)
            $('#quantity').val(newQuantity) // in post form to send to card/paypal
            $('#totalPrice').html((newQuantity * price).toFixed(2))
        }
    })

    $(document).on('change','#quantite', function() {
        var newQuantity = parseInt($('#quantite').val())
        $('#quantity').val(newQuantity) // in post form to send to card/paypal
        var price = parseFloat($('#prixLicence').val())
        $('#totalPrice').html((newQuantity * price).toFixed(2))
    })

    $(document).on('click','#selectAll', function() {
        if(this.checked) {
            $(':checkbox').each(function() {
                this.checked = true;                        
            });
        } else {
            $(':checkbox').each(function() {
                this.checked = false;                       
            });
        }
    })

    /*
    $(document).on('click','#selectAll1', function() {
        if(this.checked) {
            $(':checkbox').each(function() {
                var idElement = $(this).attr("id");
                if(idElement == 'enfantSelection1') {
                    this.checked = true;
                }
            });
        } else {
            $(':checkbox').each(function() {
                var idElement = $(this).attr("id");
                if(idElement == 'enfantSelection1') {
                    this.checked = false;
                }                      
            });
        }
    })

    $(document).on('click','#selectAll2', function() {
        if(this.checked) {
            $(':checkbox').each(function() {
                var idElement = $(this).attr("id");
                if(idElement == 'enfantSelection2') {
                    this.checked = true;
                }
            });
        } else {
            $(':checkbox').each(function() {
                var idElement = $(this).attr("id");
                if(idElement == 'enfantSelection2') {
                    this.checked = false;
                }                      
            });
        }
    })

    $(document).on('click','#selectAll3', function() {
        if(this.checked) {
            $(':checkbox').each(function() {
                var idElement = $(this).attr("id");
                if(idElement == 'enfantSelection3') {
                    this.checked = true;
                }
            });
        } else {
            $(':checkbox').each(function() {
                var idElement = $(this).attr("id");
                if(idElement == 'enfantSelection3') {
                    this.checked = false;
                }                      
            });
        }
    })
    */

}

const assigneLicence = () => {

    $(document).on('click','.assignbtn', function() {
        var licence_id = $(this).attr('id');
        var email = $('#assign-'+$(this).attr('id')).val();
        if(email == '') {
            return false;
        }
        if(confirm("Assigner une licence pour cet utilisateur : "+email+"?")) {
            console.log(licence_id);
            $.ajax({
                method: 'POST',
                url: '/app/admin/licence/assign',
                data: {
                    licence_id: licence_id,
                    email: email,
                    _token: $('input[name="_token"]').val()
                },
                success: function(data) {
                    //location.reload();
                    //alert(data);
                    var myjson = JSON.parse(data)
                    if(myjson.result == '1') {
                        $('#msg-'+licence_id).html('<div class="alert alert-success" role="alert">'+myjson.msg+' <a href="javascript:location.reload()" class="alert-link">Actualiser</a></div>')
                        $('#'+licence_id).hide()    // cache le bouton OK
                        $('#assign-'+licence_id).attr('disabled', true); // desactive le champ email
                    }
                    if(myjson.result == '0') {
                        $('#msg-'+licence_id).html('<div class="alert alert-danger" role="alert">'+myjson.msg+'</div>')
                    }
                },
                error: function(data) {
                    $('#result').html(data)
                }
            })
        }
    })

    $(document).on('click','.removelnk', function() {
        if(confirm("Retirer la licence pour cet utilisateur ?")) {
            var licence_id = $(this).attr('id');
            var user_id = $('#assign-'+$(this).attr('id')).val();
            console.log(licence_id);
            $.ajax({
                method: 'POST',
                url: '/app/admin/licence/assign',
                data: {
                    licence_id: licence_id,
                    user_id: user_id,
                    _token: $('input[name="_token"]').val()
                },
                success: function(data) {
                    location.reload();
                },
                error: function(data) {
                    $('#result').html(data)
                }
            })
        }
    })

}

export {achatLicences,assigneLicence}