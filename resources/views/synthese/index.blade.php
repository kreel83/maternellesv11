@extends('layouts.mainMenu2', ['titre' => 'Cahier de synthèse','menu' => 'maclasse'])

@section('content')

@php
    use App\Models\AcquisScolaire;
    use App\Models\Synthese;
@endphp

<style>
    #syntheseArray td {
        text-align: center;
           }
    #syntheseArray .left {
        text-align: left !important;
    }


    

    .full-height {
        height: 100%;
        width: 100%;
        min-height: 100% !important;
        border: 1px solid orangered;
        font-size: 12px;
        text-align: left;
        padding: 8px;
        border-radius: 6px
    }
    .full-height.full-height:focus {
        border-width: 2px !important;
        outline-color: 2px !important;
        outline-color: orangered;
    }
    .orangered {
        color: orangered !important;

    }
            /* Cibler la dernière colonne pour enlever les bordures */
    .transparent {
        background-color: transparent !important;
        border-color: transparent !important;
        border-width: 0 transparent !important;
    }

    .saving {
        background-color: transparent !important;
        border: none !important;
    }
    .container_observation {
        position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: lightgreen; /* Juste pour illustrer */
    display: flex;
    align-items: center;
    justify-content: center;
    }

</style>

<div id="synthese" class="my-5 py-5" data-id="{{$enfant->id}}">
   <table class="table" id="syntheseArray">
        <tr>
            <th style="width: 40%">
                <div class="d-flex align-items-center justify-content-between px-5">
                    <div class="form-check form-switch d-flex justify-content-center pt-4 me-3">
                        <input class="form-check-input me-2" type="checkbox" id="btnReady" {{$ready ? 'checked' : null}}>
                        <label class="form-check-label" for="btnReady">Document prêt</label>
                    </div>
                    <div>
                        @if ($ready)
                        <button class="btnAction {{$mail_send ? 'valide' : null}} {{!$ready ? 'd-none' : null}}"  id="btnSend"><i class="fa-solid fa-paper-plane"></i></button>   
                        <a target="_blank" href="{{route('syntheseDesAcquis_views',['enfant_id' => $enfant->id])}}" class="btnAction"  id="btnView"><i class="fa-solid fa-eye"></i></a>   
                        @endif
                    </div>                    
                </div>

            </th>
            <th style="width: 10%">{{$enfant->prenom}} ne réussit pas encore</th>
            <th style="width: 10%">{{$enfant->prenom}} est en voie de réussite</th>
            <th style="width: 10%">{{$enfant->prenom}} réussit souvent</th>
            <th style="width: 30%">Points forts et besoins à prendre en compte</th>
            
        </tr>
        @foreach ($acquis as $key=>$section)

            <tr>
                <td></td>
                <td class="left" colspan="4">{{AcquisScolaire::getDescriptionSection($key)}}</td>
             
            </tr>
            <tr>

                <td class="left {{$acquis[$key][0]['note'] === null ? 'orangered' : null}}">{{$section[0]['description']}}</td>
                <td>  <input class="form-check-input radioSynthese" type="radio" name="ligne{{$key}}-0" value="{{$acquis[$key][0]['id']}}-0" {{$acquis[$key][0]['note'] === 0 ? 'checked' : null}}></td>
                <td>  <input class="form-check-input radioSynthese" type="radio" name="ligne{{$key}}-0" value="{{$acquis[$key][0]['id']}}-1" {{$acquis[$key][0]['note'] === 1 ? 'checked' : null}}></td>
                <td>  <input class="form-check-input radioSynthese" type="radio" name="ligne{{$key}}-0" value="{{$acquis[$key][0]['id']}}-2" {{$acquis[$key][0]['note'] === 2 ? 'checked' : null}}></td>                
                <td rowspan="{{sizeof($section) }}" class="position-relative p-0">
                    <div class="container_observation">

                        <textarea class="full-height observation"  >{{$observations[$key]  ?? null}}</textarea>
                    </div>
                </td>
                <td class="saving">
                    <button class="btnAction savingBtn" data-section="{{$key}}" ><i class="fas fa-save"></i></button>
                </td>
            </tr> 
            @foreach ($section as $k=>$ligne )
                @if ($k != 0)
                <tr>
                    <td class="left {{$ligne['note'] === null ? 'orangered' : null}}">{{$ligne['description']}}</td>
                    <td>  <input class="form-check-input radioSynthese" type="radio" name="ligne{{$key}}-{{$k}}" value="{{$ligne['id']}}-0" {{$ligne['note'] === 0 ? 'checked' : null}}></td>
                    <td>  <input class="form-check-input radioSynthese" type="radio" name="ligne{{$key}}-{{$k}}" value="{{$ligne['id']}}-1" {{$ligne['note'] === 1 ? 'checked' : null}}></td>
                    <td>  <input class="form-check-input radioSynthese" type="radio" name="ligne{{$key}}-{{$k}}" value="{{$ligne['id']}}-2" {{$ligne['note'] === 2 ? 'checked' : null}}></td>
                    <td class="transparent"></td>
                </tr>       
                @endif     
            @endforeach

        @endforeach

    </table>
</div>

@endsection