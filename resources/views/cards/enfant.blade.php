

<style>


    .btn_modif_avatar {
      font-size: 14px !important;

      padding: 8px 24px !important;
      line-height: 16px !important;

    }

    .card-enfant[data-type="affectation_groupe"] {
      height: 350px !important;
    }
    .card-enfant[data-type="affectation_groupe"] .footer {
      height: auto !important;
      border-top: 3px solid var(--main-color);
    }


</style>


@php
$lesgroupes = json_decode(Auth::user()->groupes(), true);
// dd($lesgroupes);

$groupe = null;
if (!is_null($enfant->groupe) && $lesgroupes){
  
  $groupe = $lesgroupes[$enfant->groupe];


  
}
  // dd(Auth::user()->groupe, $enfant->groupe, $enfant, Auth::user()->type_groupe, Auth::user()->groupe[$enfant->groupe]);
@endphp

<div class="card-enfant position-relative" data-type="{{$type}}" data-enfant="{{$enfant->id}}">


  {{-- @if ($groupe && strlen($groupe[0]) <2)
    <div class="groupe" style="background-color: {{ $groupe[1] }}; color:{{ $groupe[2]}}">{{ $groupe[0]}}</div>
  @endif --}}

  <div class="card-header d-flex justify-content-center">
    @if ($enfant->background)
      <div class="m-2 degrade_card_enfant animaux"  style="background-image: {{$degrades[$enfant->background]}}" data-degrade="{{$enfant->background}}"  data-animaux="{{$enfant->photo}}">
          <img src="{{asset('/img/animaux/'.$enfant->photo)}}" alt="" width="120">    
      </div>

    @else
      <img src="{{asset($enfant->photoEleve)}}" alt="rover" />
    @endif
  </div>
    <div class="card-body p-0 mt-2" style="text-align: center">
        <div class="name d-flex flex-column justify-content-center align-items-center" style="color: {{$enfant->genre == 'F' ? 'var(--pink)' : 'var(--blue)'}}">
          <div style="line-height: 15px; margin-top: 10px">{{$enfant->prenom}}</div>

          <div style="font-size: 0.9rem;color: {{$enfant->genre == 'F' ? 'var(--pink)' : 'var(--blue)'}}" class="ms-2 mt-1 {{ env('App_DEMO') ? 'blur' : null}}">{{$enfant->nom}}</div>
          </div>
        <div class="title" style="font-size: 0.8rem; font-weight: bold;border-color: {{$enfant->genre == 'F' ? 'var(--pink)' : 'var(--blue)'}}">


           {{ $enfant->age}}
        </div>
  </div>

    <div class="groupe-terme {{isset($groupe) ? null : 'd-none'}}"  style="background-color: {{ $groupe["backgroundColor"] ?? '' }}; color:{{ $groupe["textColor"] ?? ''}}; border: 1px solid {{$groupe["textColor"] ?? 'transparent'}}">
      {{$groupe["name"] ?? ''}}
      <i class="fa-solid fa-times ms-3 deleteGroupeAffecte" style="cursor: pointer; color: red;"></i>
    </div>



  @if ($type == "evaluation")
    <div class="footer p-2 d-flex justify-item-around"  style="background-color: var(--main-color)">

        <a href="enfants/{{$enfant->id}}/items?section_id=2"  ><i style="font-size: 18px" class="fa-light fa-comment"></i></a>
        <a href="enfants/{{$enfant->id}}/items?section_id=3"  ><i style="font-size: 18px" class="fa-light fa-pen"></i></a>
        <a href="enfants/{{$enfant->id}}/items?section_id=4"  ><i style="font-size: 18px" class="fa-light fa-volleyball"></i></a>
        <a href="enfants/{{$enfant->id}}/items?section_id=5"  ><i style="font-size: 18px" class="fa-light fa-paintbrush-pencil"></i></a>
        <a href="enfants/{{$enfant->id}}/items?section_id=6"  ><i style="font-size: 18px" class="fa-light fa-hundred-points"></i></a>
        <a href="enfants/{{$enfant->id}}/items?section_id=7"  ><i style="font-size: 18px" class="fa-light fa-shapes"></i></a>
        <a href="enfants/{{$enfant->id}}/items?section_id=8"  ><i style="font-size: 18px" class="fa-light fa-clock"></i></a>
        <a href="enfants/{{$enfant->id}}/items?section_id=10"  ><i style="font-size: 18px" class="fa-light fa-heart"></i></a>
        @if (Auth::user()->classe_active()->desactive_devenir_eleve == 0)
        <a href="enfants/{{$enfant->id}}/items?section_id=9"  ><i style="font-size: 18px" class="fa-light fa-child-reaching"></i></a>
        @endif
        
    </div>

  @endif  
  @if ($type == "reussite")
    <div class="footer p-2 d-flex justify-item-around position-relative"  style="background-color: var(--main-color)">
        {{-- <div class="position-absolute" style="top: 5px; left: 55px; font-size: 10px; font-weight: bolder; color: white">{{$enfant->state_reussite_definitif()}}</div>
        <div class="position-absolute" style="top: 5px; left: 127px; font-size: 10px; font-weight: bolder; color: white">{{$enfant->state_reussite_definitif()}}</div> --}}
        {{-- <div class="position-absolute" style="top: 5px; left: 206px; font-size: 10px; font-weight: bolder; color: white">{{$enfant->state_reussite_last()}}</div> --}}
        
        {{-- <a href="enfants/{{$enfant->id}}/cahier"  ><i class="fa-light fa-paper-plane-top"></i></a>
        <a href="enfants/{{$enfant->id}}/cahier/seepdf/see"  ><i class="fa-light fa-file-pdf"></i></a> --}}
        <a href="enfants/{{$enfant->id}}/cahierV2" style="font-size: 14px; padding-top: 7px"  ><i class="fa-light fa-notes me-2"></i>Créer le cahier de réussite</a>
    </div>
  @endif
  @if ($type == "avatar")
    <div class="footer p-2 d-flex justify-item-around"  style="background-color: var(--main-color)">        
        <a href="enfants/{{$enfant->id}}/avatar"  class="btn_modif_avatar {{$kE == 0 ? 'modif_avatar' : null}}" >Modifier mon avatar</a>
    </div>
  @endif
  @if ($type == "affectation_groupe")
  @php
  
  $groupes = json_decode(Auth::user()->groupes(), true);
      if (is_null($enfant->groupe) || !$lesgroupes) {
          $c = 'transparent';
      } else {
        $c = $groupes[$enfant->groupe]['backgroundColor'];
      }


      

    @endphp
    <div class="footer p-2 d-flex h-auto; height: 300px !important"  style="background-color: var(--background-color)" data-enfant="{{$enfant->id}}">        
      <div class="d-flex w-100  justify-content-around flex-wrap {{$kE == 0 ? 'choix_groupe' :  null}}">
        @if ($groupes)
        @foreach ($groupes as $key=>$terme)
            <div class="badge_termes {{ $enfant->groupe != null && $key == $enfant->groupe ? 'active' : null}}" data-textColor="{{$terme['textColor']}}" data-color="{{$terme['backgroundColor']}}" style="background-color: {{$terme['backgroundColor']}}; color: {{$terme['textColor']}}; ; border: 1px solid {{$terme['textColor']}}" data-order="{{$key}}">{{$terme['name']}}</div>
        @endforeach
        @endif
    </div>
    </div>
  @endif

  @if ($type == "none")
    <div class="footer p-2 d-flex justify-item-around"  style="background-color: var(--main-color)">
        
        {{-- <button id="valideAvatar" class="custom_button btn_select_avatar" style="font-size: 12px; width: fit-content; height: 16px; line-height: 1px; margin-top: 7px; background-color: transparent;text-shadow: black 2px 2px;">Sauvegarder</button> --}}
        <button id="valideAvatar" class="custom_button btn_select_avatar">Sauvegarder</button>

    </div>
  @endif




</div>

