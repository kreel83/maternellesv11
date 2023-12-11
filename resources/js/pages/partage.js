const partageDeClasse = () => {

    $(document).on('click','.codeDeSecuritePartage', function() {
        var code = $(this).data('code')
        $(this).html(code)
    })
    
}

export {partageDeClasse}