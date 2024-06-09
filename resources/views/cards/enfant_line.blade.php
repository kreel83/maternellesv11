@php
$lesgroupes = json_decode(Auth::user()->groupes(), true);

$groupe = null;
if (!is_null($enfant->groupe) && $lesgroupes) {
  
  $groupe = $lesgroupes[$enfant->groupe];
  
}

@endphp


<style>

</style>

<tr class="card-enfant position-relative" data-enfant="{{$enfant->id}}">
    
    <td>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
            
          </div>
    </td>
    <td>
      
                <div class="row">

                    <div class="col-md-3">

                        @if ($enfant->background)
                            <div class="m-2 degrade_card_enfant animaux"  style="width: 60px; height: 60px;background-image: {{$degrades[$enfant->background]}}" data-degrade="{{$enfant->background}}"  data-animaux="{{$enfant->photo}}">
                                <img src="{{asset('/img/animaux/'.$enfant->photo)}}" alt="" width="60">    
                            </div>
                    
                        @else
                            <img src="{{asset($enfant->photoEleve)}}" alt="rover" />
                        @endif
                    </div>
                    <div class="col-md-9 p-0 mt-2" style="text-align: center">
                        <div class="name d-flex flex-column justify-content-center align-items-center" style="color: {{$enfant->genre == 'F' ? 'var(--pink)' : 'var(--blue)'}}">
                            <div style="line-height: 15px; margin-top: 10px">{{$enfant->prenom}}</div>
                
                            <div style="font-size: 0.9rem;color: {{$enfant->genre == 'F' ? 'var(--pink)' : 'var(--blue)'}}" class="ms-2 mt-1 {{ config('app.custom.app_demo') && Auth::id() == config('app.custom.app_demo_user') ? 'blur' : null}}">{{$enfant->nom}}</div>
                            </div>
                        <div class="title" style="font-size: 0.8rem; font-weight: bold;border-color: {{$enfant->genre == 'F' ? 'var(--pink)' : 'var(--blue)'}}">
                
                
                            {{ $enfant->age}}
                        </div>
                    </div>

                </div>
        
    </td>

   
 



  

  
</tr>