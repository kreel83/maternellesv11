const mailFunction = (quill) => {

    $(document).on('click','#saveCustoMail', function() {
        var q = quill.root.innerHTML;
        $.ajax({
            method: 'POST',
            url : '/app/saveCustomMail',
            data : {
                quill: q
            },
            success: function(data) {

            }
        })
    })

  
    
}

export {mailFunction}