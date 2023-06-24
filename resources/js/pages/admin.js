/*
const adminRegistration = () => {

    $(document).on('click','#btncheckcode', function() {

        var codeEtablissement = $('#codeEtablissement').val()
        //alert(codeEtablissement)
        
        $.ajax({
            method: 'GET',
            url : '/admin/checkcode/'+codeEtablissement,
            success: function(data) {
                var myjson = JSON.parse(data)
                $('#result_msg').html(myjson.msg)
                $('#result_mail').html(myjson.msgmail)
                if(myjson.result == '1') {
                    $('#btncheckcode').addClass("d-none"); 
                    $('#btns').removeClass("d-none"); 
                    $('#btns').addClass("d-block"); 
                }
            },
            error: function(data) {
                $('#result').html(data)
            }
        })
        
    })

}
*/

const adminRegistration = () => {

    $(function(){
        $('#result_msg').html($('#result_msg_memo').val())
        $('#result_mail').html($('#result_mail_memo').val())
    });

    //$(document).on('click','#btncheckcode', function() {
    $(document).on('change','#ecole_id', function() {

        var ecole_id = $('#ecole_id').val()
        //alert(codeEtablissement)
        
        $.ajax({
            method: 'GET',
            url : '/admin/checkcode/'+ecole_id,
            success: function(data) {
                //alert(data);
                var myjson = JSON.parse(data)
                //$('#result_msg').val(myjson.msg)
                //$('#result_mail').val(myjson.msgmail)
                //$('#result_msg').show()
                //$('#result_mail').show()
                
                //$('#result_msg').html(myjson.msg)
                //$('#result_mail').html(myjson.msgmail)
                $('#result_msg_memo').val(myjson.msg)
                $('#result_mail_memo').val(myjson.msgmail)
                
                if(myjson.result == '1') {
                    $('#email').val(myjson.mail);
                    //$('#ecole_id').val($('#codeEtablissement').val());
                    $('#btnsubmit').attr('disabled', false);
                    //$('#codeEtablissement').prop('readonly', true);
                    //$('#btncheckcode').hide();
                    //$('#form_step2').show();
                    //$('#result_msg').html(myjson.msg)
                    $('#result_msg').html('<div class="alert alert-success" role="alert">'+myjson.msg+'</div>')
                    $('#result_mail').html(myjson.msgmail)
                }
                if(myjson.result == '0') {
                    $('#btnsubmit').attr('disabled', true);
                    $('#result_msg').html('<div class="alert alert-danger" role="alert">'+myjson.msg+'</div>')
                    //$('#result_msg').hide()
                    //$('#result_mail').hide()
                }
            },
            error: function(data) {
                $('#result').html(data)
            }
        })
        
    })

}

/*
const adminRegistration = () => {

    $(document).on('click','#btncheckcode', function() {
        var codeEtablissement = $('#codeEtablissement').val()
        //alert(codeEtablissement)
        
        $.ajax({
            method: 'GET',
            url : '/admin/checkcode/'+codeEtablissement,
            success: function(data) {
                //alert(data);
                var myjson = JSON.parse(data)
                $('#result_msg').html(myjson.msg)
                $('#result_mail').html(myjson.msgmail)
                if(myjson.result == '1') {
                    $('#email').val(myjson.mail);
                    $('#ecole_id').val($('#codeEtablissement').val());
                    //$('#codeEtablissement').attr('disabled', 'disabled');
                    $('#codeEtablissement').prop('readonly', true);
                    $('#btncheckcode').hide();
                    $('#form_step2').show();
                }
            },
            error: function(data) {
                $('#result').html(data)
            }
        })
        
    })

}
*/

export {adminRegistration}