



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
            $('.day[data-all="' + element.ddn + '"]').addClass('anniversaire '+element.genre)
            $('.day[data-all="'+element.ddn+'"]').prop('title', element.nom)
        })
        $('.day[data-all="' + $('#ddj').val() + '"]').addClass('ddj')
        if ( !$('.day[data-all="' + $('#ddj').val() + '"]').hasClass('anniversaire')) {
            $('.day[data-all="' + $('#ddj').val() + '"]').css('color','white')
        }
        var evenements = $('#evenements').val()
        console.log(evenements)
        evenements = JSON.parse(evenements)
        evenements.forEach(function (element) {
            console.log(element)
            var s = '.'.repeat(element.nombre)
            console.log(s)
            $('.day_event[data-js_date="' + element.date + '"]').text(s)
            $('.day_event[data-js_date="' + element.date + '"]').removeClass('d-none')
            
        })

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
    
    $(document).on('click','.delete_event', function() {
        var id = $(this).attr('data-id')
        var date = $(this).attr('data-date_js')
        console.log('id', id, date)
        $('#do_delete_event').attr('data-id', id)
        $('#do_delete_event').attr('data-date', date)
    })

    $(document).on('click','.editEvent', function() {
        var id = $(this).attr('data-id')
        var date = $(this).attr('data-date_js')
        var name = $(this).attr('data-name')
        var comment = $(this).attr('data-comment')
        console.log(name, comment)
        $('input[name="id"]').val(id)
        $('input[name="name"]').val(name)
        $('textarea[name="comment"]').val(comment)
        $('input[name="date"]').val(date)
    })


 

    $(document).on('click','#do_delete_event', function() {
        var id = $(this).attr('data-id')
        var date = $(this).attr('data-date')
        var points = $('.day[data-js_date="'+date+'"]').find('.day_event').text()
        console.log(points)
        var newPoints = '.'.repeat(points.length - 1)
        $.get('calendar/event/delete/'+id, function() {
            $('.event_container[data-id="'+id+'"]').remove()
            $('.day[data-js_date="'+date+'"]').find('.day_event').text(newPoints)
        })
    })


    $('.day').on('click', function() {
        $('.day').removeClass('selected')
        $(this).addClass('selected')
        var date = $(this).data('js_date')
        console.log(date)
        $('.bloc_event').empty()
        $.get('/calendar/getEvent/'+date, function(data) {
            $('.bloc_event').html(data)
        })

        $('#date_event').val(date)
 
    })

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
