<?php
    $ps = (int) $fiche->lvl[0];
    $ms = (int) $fiche->lvl[1];
    $gs = (int) $fiche->lvl[2];
    $lvl = json_encode([$ps, $ms, $gs]);

?>

<a href="{{route('activite',['id' => $fiche->id])}}">


<div class="liste_line" data-fiche="{{$fiche->id}}">
    <div class="row">
            <div class="col-md-2 card__image">
                <img src="{{asset($fiche->image_name)}}" alt="image" class="border-tlr-radius">
            </div>

            <div class="card-foot col-md-9" style="font-size: 12px; border-color: {{ $sections->where('id', $fiche->section_id)->first()->color ?? '' }} !important">

                <div style="font-weight: bolder;">{{ $fiche->categorie->section2 ?? '' }}</div>
                
                <div>{{$fiche->name}}</div>
                <style>
                    .caseLvl.ps.active {
                        /* background-color: var(--pink); */
                        border: 1px solid white;
                        font-weight: bolder;
                    }
                    .caseLvl.ms.active {
                        /* background-color: var(--green); */
                        border: 1px solid white;
                        font-weight: bolder;
                    }
                    .caseLvl.gs.active {
                        border: 1px solid white;
                        font-weight: bolder;
                        /* background-color: var(--rouge); */
                    }
                </style>    

<div class="d-flex">

    <div class="p-0 caseLvl ps {{ $ps == "1" ? 'active' : null }}" >PS</div>
    <div class="p-0 caseLvl ms {{ $ms == "1" ? 'active' : null }}" >MS</div>
    <div class="p-0 caseLvl gs {{ $gs == "1" ? 'active' : null }}" >GS</div>
</div>
            </div>
                        

                    
             
    </div>


    </div>

</a>

