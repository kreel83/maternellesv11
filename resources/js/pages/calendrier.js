



class Periode {
    constructor (color, periode, start = null, datestart = null, end = null, dateend = null, complete = false) {
        this.color = color
        this.start = start
        this.datestart = datestart
        this.end = end
        this.dateend = dateend
        this.complete = complete
        this.periode = periode
    }
}

var p1 = new Periode('red', 'p1')
var p2 = new Periode('blue', 'p2' )
var p3 = new Periode('green', 'p3')


var periodeActive = null



const choosePeriode = (confirmation_modal) => {
    $('.btnPeriode').on('click', function() {

        var confirmation_modal = new bootstrap.Modal(document.getElementById('confirmation_modal'), {
            keyboard: false
        })


        confirmation_modal.show()
        var active = $(this).data('periode')
        switch (active) {
            case 'p1' : periodeActive = p1;break;
            case 'p2' : periodeActive = p2;break;
            case 'p3' : periodeActive = p3;break;
        }
console.log(periodeActive)
    })
}


const initCalendrier = () => {
    if ($('#calendrier_scolaire').length) {
        var conges = $('#conges').val()
        conges = JSON.parse(conges)
        conges.forEach(function (element) {
            console.log(element)
            $('.day[data-all="' + element.start + '"]').addClass('start conges')
            $('.day[data-all="' + element.start + '"]').prop('title', element.libele)
            $('.day[data-all="' + element.end + '"]').addClass('end conges')
            $('.day[data-all="' + element.end + '"]').prop('title', element.libele)
            for (var i = element.start + 1; i < element.end; i++) {
                $('.day[data-all="' + i + '"]').addClass('between conges')
                $('.day[data-all="'+i+'"]').prop('title', element.libele)
            }
        })
        var anniversaires = $('#anniversaires').val()
        anniversaires = JSON.parse(anniversaires)
        anniversaires.forEach(function (element) {
            console.log(element)
            $('.day[data-all="' + element.ddn + '"]').addClass('anniversaires '+element.genre)
            $('.day[data-all="'+element.ddn+'"]').prop('title', element.nom)
        })
        $('.day[data-all="' + $('#ddj').val() + '"]').addClass('ddj')
        if ( !$('.day[data-all="' + $('#ddj').val() + '"]').hasClass('anniversaires')) {
            $('.day[data-all="' + $('#ddj').val() + '"]').css('color','white')
        }

    }
}

const initCalendar = () => {
    if ($('#savePeriode').length) {

        var annee = $('#savePeriode').data('annee')
        $.get('/calendar/periodes/init?annee='+annee, function(data) {
            data.forEach(function(element) {console.log(element)
                $('.day[data-all="'+element.start+'"]').addClass('start p'+element.periode)
                $('.day[data-all="'+element.end+'"]').addClass('end p'+element.periode)
                for (var i=element.start +1; i < element.end; i++)  $('.day[data-all="'+i+'"]').addClass('between p'+element.periode)
                    switch (element.periode) {
                        case 1: p1 = new Periode('red', 'p1', element.start, element.date_start, element.end, element.date_end, true );break;
                        case 2: p2 = new Periode('blue', 'p2', element.start, element.date_start, element.end, element.date_end, true );break;
                        case 3: p3 = new Periode('green', 'p3', element.start, element.date_start, element.end, element.date_end, true );break;
                    }
                }
            )
            $('#alerte').addClass('alert alert-success')
            $('#alerte').text('les périodes ont bien été récupérées')
            setTimeout(function() {
                $('#alerte').fadeOut()


            }, 1000, function() {
                $('#alerte').removeAttr('class')
                $('#alerte').empty()
            })

        })
    }

}

const selection = () => {
    $('.day.actif').on('click', function() {
        if (periodeActive) {
            console.log(periodeActive)
            if (periodeActive.complete) {
                periodeActive.start = null
                periodeActive.datestart = null
                periodeActive.end = null
                periodeActive.dateend = null
                periodeActive.complete = false
                $('.day.' + periodeActive.periode).removeClass('start between end select ' + periodeActive.periode)
            }
            if (!periodeActive.start) {
                $(this).addClass('start '+periodeActive.periode)
                periodeActive.start = parseInt($(this).data('all'))
                periodeActive.datestart = $(this).data('date')
            }
            if ($(this).hasClass('end')) {
                periodeActive.complete = true
            }
        }
    })

}


const savePeriode = () => {
    $('#savePeriode').on('click', function() {
        $.ajax({
            url: 'calendar/periodes/save',
            method:'POST',
            data: {
                annee: $(this).data('annee'),
                periode: {
                    p1: p1.complete ? JSON.stringify(p1) : null,
                    p2: p2.complete ? JSON.stringify(p2) : null,
                    p3: p3.complete ? JSON.stringify(p3) : null,
                }

            },
            success: function() {

            }

        })
    })
}

const hover = () => {

        $('.day.actif').on('mouseover', function() {
            console.log(periodeActive)
            if (periodeActive) {
                if (periodeActive.start && !periodeActive.complete) {
                    console.log('cc')

                    periodeActive.end = parseInt($(this).data('all'))
                    periodeActive.dateend = $(this).data('date')

                    $('.day.'+periodeActive.periode).removeClass('between end select '+periodeActive.periode)
                    if (periodeActive.start == periodeActive.end) {
                        $(this).addClass('select '+periodeActive.periode)

                    }
                    if (periodeActive.start < periodeActive.end) {
                        $('.day[data-all="'+periodeActive.start+'"]').removeClass('select')
                        $('.day[data-all="'+periodeActive.start+'"]').addClass('start '+periodeActive.periode)
                        for(var i = periodeActive.start+1; i < periodeActive.end; i++ ) {
                            $('.day[data-all="'+i+'"]').addClass('between '+periodeActive.periode)
                        }
                        $(this).addClass('end '+periodeActive.periode)
                    }


                }
            }


        })


}

export {selection, hover, choosePeriode, savePeriode, initCalendar, initCalendrier}
