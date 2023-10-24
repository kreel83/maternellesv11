@extends('layouts.parentLayout', ['titre' => 'Bienvenue', 'menu' => 'accueil'])

@section('content')

    <style>
        .jour_bloc,
        .mois_bloc,
        .annee_bloc {
            width: 116px;
            height: 120px;
            border: 1px solid grey;
            background-color: white;
            margin: 0 10px;
            border-radius: 15px;
            overflow: hidden;

        }
        .jour_bloc input,
        .mois_bloc input,
        .annee_bloc input {
            width: 108px;
            font-size: 56px;
            padding: 0 10px 0 12px;
            letter-spacing: 12px;
            border-radius: 25px;
            font-weight: bolder;
            color: green;
            caret-color: transparent;
            border: none;
            outline: none;
            padding-left: 12px;
        }
        .jour_bloc.focus,
        .mois_bloc.focus,
        .annee_bloc.focus {
            border: 4px solid green;
        }

        .annee_bloc {
            width: 214px
        }
        .annee_bloc input {
            width: 200px
        }

        #espaceParent {
            width: 100vw;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, rgb(255, 168, 168) 10%, rgb(252, 255, 0) 100%);
        }

        .label_jour {
            background-color: white;
            padding: 2px 4px;
            color: black;
            position: absolute;
            top: 2px;
            left: 30px;
            font-size: 12px;
        }

        .label_mois {
            background-color: white;
            padding: 2px 4px;
            color: black;
            position: absolute;
            top: 2px;
            left: 27px;
            font-size: 12px;
        }

        .label_annee {
            background-color: white;
            padding: 2px 4px;
            color: black;
            position: absolute;
            top: 2px;
            left: 57px;
            font-size: 12px;
        }

        .trait {
            padding: 2px 4px;
            color: black;
            position: absolute;
            left: 0px;
            top: 95px;
            display: flex;
            width: 100px;
            justify-content: space-between;
            padding: 0 12px;

        }

        .trait div {
            width: 30px;
            height: 3px;

            background-color: lightgray;
        }

        .btn-go {
            width: 350px;
            height: 70px;
            border-radius: 40px;
            background-color: green;
            color: white;
            text-align: center;
            line-height: 70px;
            border: none;
            outline: none;
            margin: 0 auto;
        }
        .btn-go.focus {
            border: 2px solid white;    
        }

        .alerte {
            font-size: 20px;
            color: red;
            background-color: white;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
            border-radius: 40px;
            font-weight: bold;

        }
        ::placeholder {
            color: lightgray;
            opacity: 0.3; /* Firefox */
        }
    </style>

    <div id="espaceParent">



        <h1 class="text-center">Bienvenue dans la section de téléchargement <br> du cahier de résussite de votre enfant.</h1>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="alerte">
                
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                
            </div>
        @endif



        <form class="d-flex w-25 flex-column" action="{{ route('cahier.predownload.post') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">



            <div class="d-flex">
                <div class="input-group position-relative jour_bloc focus">
                    <label for="" class="label_jour">jour</label>
                    <input type="text"  id="jour" name="jour" placeholder="{{ old('jour') }}" value="" required autofocus>
                    <div class="trait">
                        <div></div>
                        <div></div>
                    </div>
                </div>

                <div class="input-group position-relative mois_bloc">
                    <label for="" class="label_mois">mois</label>
                    <input type="text"  id="mois" name="mois" placeholder="{{ old('mois') }}" value="" required>
                    <div class="trait">
                        <div></div>
                        <div></div>
                    </div>
                </div>

                <div class="input-group position-relative annee_bloc">
                    <label for="" class="label_annee">année</label>
                    <input type="text" id="annee" name="annee" placeholder="{{ old('annee') }}" value="" required>
                    <div class="trait" style="width: 190px">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-5">
                <button type="submit" class="btn-go">Vérification de la date de naissance</button>
            </div>

        </form>

        @if (session('success'))
            <div class="alert alert-success">
                <p><a href="{{ route('cahier.download', ['token' => session('token')]) }}">Télécharger le cahier de
                        progrès</a></p>
            </div>
        @endif


@if (session('success'))
    <div class="alert alert-success">
      <p><a href="{{ route('cahier.seepdf', ['token' => session('token')]) }}">Télécharger le cahier de progrès</a></p>

    </div>
    @endif

    <script>
        $(document).ready(function() {
          $(document).on('click', '.jour_bloc, .mois_bloc, .annee_bloc', function(e) {
              var v = $(this).find('input').val()
              console.log('trggier', v)
              $('.jour_bloc, .mois_bloc, .annee_bloc').removeClass('focus')
              $(this).addClass('focus')
             $(this).find('input').focus().val("").val(v);
             $('.btn-go').removeClass('focus')
          })

            $(document).on('keydown', '#jour', function(e) {
              if (e.key == 'Backspace') return true;
                e.preventDefault()
                var l = $('#jour').val().length

                if (l == 0) {
                    if (["0", "1", "2", "3"].includes(e.key)) $('#jour').val(e.key)
                }
                if (l == 1) {
                    var c = $('#jour').val()[0]
                    console.log(c + e.key, [...Array(10).keys()], ['0', '1', '2'].includes(c))
                    if ([0, 1, 2].includes(parseInt(c)) && [...Array(10).keys()].includes(parseInt(e
                        .key))) {
                        $('#jour').val(c + e.key)
                        $('.mois_bloc').trigger('click')
                    }
                    if ([3].includes(parseInt(c)) && [...Array(2).keys()].includes(parseInt(e.key))) {
                        $('#jour').val(c + e.key)
                        $('.mois_bloc').trigger('click')
                    }
                }
            })
            $(document).on('keydown', '#mois', function(e) {
                if (e.key == 'Backspace') return true;
                e.preventDefault()
                var l = $('#mois').val().length
                if (l == 0) {
                    if (["0", "1"].includes(e.key)) $('#mois').val(e.key)
                }
                if (l == 1) {
                    var c = $('#mois').val()[0]
                    console.log(c + e.key, [...Array(10).keys()], ['0', '1', '2'].includes(c))
                    if ([0].includes(parseInt(c)) && [...Array(10).keys()].includes(parseInt(e
                        .key))) {
                        $('#mois').val(c + e.key)
                        $('.annee_bloc').trigger('click')
                    }
                    if ([1].includes(parseInt(c)) && [...Array(3).keys()].includes(parseInt(e.key))) {
                        $('#mois').val(c + e.key)
                        $('.annee_bloc').trigger('click')
                    }
                }
            })

            $(document).on('keyup', '#annee', function(e) {
                var l = $('#annee').val().length
                if (e.key == 'Backspace') {
                    if (l == 0) $('.mois_bloc').trigger('click')
                    console.log('bbbaacckk')                
                }         
            })

            $(document).on('keyup', '#mois', function(e) {
                var l = $('#mois').val().length
                if (e.key == 'Backspace') {
                    if (l == 0) $('.jour_bloc').trigger('click')
                    console.log('bbbaacckk')                
                }         
            })

            $(document).on('keydown', '#annee', function(e) {
                if (e.key == 'Backspace') return true;
                var l = $('#annee').val().length
                  e.preventDefault()
                  if (l == 0) {
                      if (["2"].includes(e.key)) $('#annee').val(e.key)
                  }
                  if (l == 1) {
                      var c = $('#annee').val()[$('#annee').val().length -1]
                      if (["0"].includes(e.key)) $('#annee').val(c + e.key)
                  }
                  if (l == 2) {
                      var c = $('#annee').val()                   
                      if ([...Array(10).keys()].includes(parseInt(e
                          .key))) {
                          $('#annee').val(c + e.key)
                          
                      }
                  }
                  if (l == 3) {
                      var c = $('#annee').val()                    
                      if ([...Array(10).keys()].includes(parseInt(e
                          .key))) {
                          $('#annee').val(c + e.key)
                          $('.btn-go').addClass('focus')
                          $('.annee_bloc').removeClass('focus')
                          $('.btn-go').focus()
                        
                      }
                  }                  
              

            })

        })
    </script>

@endsection
