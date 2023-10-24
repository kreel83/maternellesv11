@extends('layouts.parentLayout', ['titre' => 'Bienvenue', 'menu' => 'accueil'])

@section('content')

    <style>
        #jour,
        #mois,
        #annee {
            width: 108px;
            height: 120px;
            border: 1px solid grey;
            background-color: white;
            font-size: 56px;
            padding: 0 10px 0 12px;
            letter-spacing: 12px;
            border-radius: 25px;
            font-weight: bolder;
            color: lightgrey;
            caret-color: transparent;
        }

        #annee {
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
        }

        .label_mois {
            background-color: white;
            padding: 2px 4px;
            color: black;
            position: absolute;
            top: 2px;
            left: 27px;
        }

        .label_annee {
            background-color: white;
            padding: 2px 4px;
            color: black;
            position: absolute;
            top: 2px;
            left: 57px;
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
    </style>

    <div id="espaceParent">



        <h1 class="text-center">Bienvenue dans la section de téléchargement <br> du cahier de résussite de votre enfant.</h1>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <p>Veuillez indiquer sa date de naissance au format JJ/MM/YYYY :</p>

        <form class="d-flex w-25 flex-column" action="{{ route('cahier.predownload.post') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">



            <div class="d-flex">
                <div class="input-group position-relative">
                    <label for="" class="label_jour">jour</label>
                    <input type="text" onfocus=" let value = this.value; this.value = null; this.value=value"  id="jour" name="jour" value="{{ old('jour') }}" required autofocus>
                    <div class="trait">
                        <div></div>
                        <div></div>
                    </div>
                </div>

                <div class="input-group">
                    <label for="" class="label_mois">mois</label>
                    <input type="text" onfocus=" let value = this.value; this.value = null; this.value=value"  id="mois" name="mois" value="{{ old('mois') }}" required>
                    <div class="trait">
                        <div></div>
                        <div></div>
                    </div>
                </div>

                <div class="input-group">
                    <label for="" class="label_annee">année</label>
                    <input type="text" onfocus=" let value = this.value; this.value = null; this.value=value"  id="annee" name="annee" value="{{ old('annee') }}" required>
                    <div class="trait" style="width: 190px">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>

            <div>
                <button type="submit" class="btn btn-primary">C'est parti !</button>
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

    <script>
        $(document).ready(function() {
        //   $(document).on('focus', '#jour, #mois, #annee', function(e) {
        //     var v = $(this).val()
        //     $(this).focus().val("").val(v);
        //   })

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
                        $('#mois').trigger('focus')
                    }
                    if ([3].includes(parseInt(c)) && [...Array(2).keys()].includes(parseInt(e.key))) {
                        $('#jour').val(c + e.key)
                        $('#mois').trigger('focus')
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
                        $('#annee').trigger('focus')
                    }
                    if ([1].includes(parseInt(c)) && [...Array(3).keys()].includes(parseInt(e.key))) {
                        $('#mois').val(c + e.key)
                        $('#annee').trigger('focus')
                    }
                }
            })
            $(document).on('keydown', '#annee', function(e) {
              
                if (e.key == 'Backspace') return true;
                  e.preventDefault()
                  var l = $('#annee').val().length
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
                        
                      }
                  }                  
              

            })

        })
    </script>

@endsection
