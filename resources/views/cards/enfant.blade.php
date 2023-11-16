

<style>
    .badge_termes {
        padding: 2px 8px;
        font-size: 12px;
        border-radius: 40px;
        color: purple;
        background-color: white;
        width: fit-content;
        min-width: 25px;
        min-height: 25px;
        margin: 4px 0;
        cursor: pointer;
        color:  white !important;
        line-height: 25px;
    }

    .btn_modif_avatar {
      font-size: 14px !important;

      padding: 8px 24px !important;
      line-height: 16px !important;

    }

    .btn_modif_avatar:hover {



    }


</style>


@php
$lesgroupes = json_decode(Auth::user()->groupes, true);

$groupe = null;
if (!is_null($enfant->groupe)){
  
  $groupe = $lesgroupes[$enfant->groupe];


  
}
  // dd(Auth::user()->groupe, $enfant->groupe, $enfant, Auth::user()->type_groupe, Auth::user()->groupe[$enfant->groupe]);
@endphp

<div class="card-enfant position-relative">


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
        <div class="name d-flex justify-content-center align-items-center" style="color: {{$enfant->genre == 'F' ? 'var(--pink)' : 'var(--blue)'}}">
          {{$enfant->prenom}}
          <span style="font-size: 1.8rem;color: {{$enfant->genre == 'F' ? 'var(--pink)' : 'var(--blue)'}}" class="ms-2 mt-1 ">{{substr($enfant->nom,0,1)}}.</span>
          </div>
        <div class="title" style="border-color: {{$enfant->genre == 'F' ? 'var(--pink)' : 'var(--blue)'}}">


           {{ $enfant->age}}
        </div>
  </div>

    <div class="groupe-terme {{isset($groupe) ? null : 'd-none'}}"  style="background-color: {{ $groupe["backgroundColor"] ?? '' }}; color:{{ $groupe["textColor"] ?? ''}}">{{$groupe["name"] ?? ''}}</div>



  @if ($type == "evaluation")
    <div class="footer p-2 d-flex justify-item-around"  style="background-color: var(--main-color)">

        <a href="enfants/{{$enfant->id}}/items?sectionID=0"  ><i style="font-size: 18px" class="fa-light fa-comment"></i></a>
        <a href="enfants/{{$enfant->id}}/items?sectionID=1"  ><i style="font-size: 18px" class="fa-light fa-pen"></i></a>
        <a href="enfants/{{$enfant->id}}/items?sectionID=2"  ><i style="font-size: 18px" class="fa-light fa-volleyball"></i></a>
        <a href="enfants/{{$enfant->id}}/items?sectionID=3"  ><i style="font-size: 18px" class="fa-light fa-paintbrush-pencil"></i></a>
        <a href="enfants/{{$enfant->id}}/items?sectionID=4"  ><i style="font-size: 18px" class="fa-light fa-font-case"></i></a>
        <a href="enfants/{{$enfant->id}}/items?sectionID=5"  ><i style="font-size: 18px" class="fa-light fa-shapes"></i></a>
        <a href="enfants/{{$enfant->id}}/items?sectionID=6"  ><i style="font-size: 18px" class="fa-light fa-globe"></i></a>
        <a href="enfants/{{$enfant->id}}/items?sectionID=7"  ><i style="font-size: 18px" class="fa-light fa-child-reaching"></i></a>
        
    </div>

  @endif  
  @if ($type == "reussite")
    <div class="footer p-2 d-flex justify-item-around position-relative"  style="background-color: var(--main-color)">
        {{-- <div class="position-absolute" style="top: 5px; left: 55px; font-size: 10px; font-weight: bolder; color: white">{{$enfant->state_reussite_definitif()}}</div>
        <div class="position-absolute" style="top: 5px; left: 127px; font-size: 10px; font-weight: bolder; color: white">{{$enfant->state_reussite_definitif()}}</div> --}}
        <div class="position-absolute" style="top: 5px; left: 206px; font-size: 10px; font-weight: bolder; color: white">{{$enfant->state_reussite_last()}}</div>
        
        {{-- <a href="enfants/{{$enfant->id}}/cahier"  ><i class="fa-light fa-paper-plane-top"></i></a>
        <a href="enfants/{{$enfant->id}}/cahier/seepdf/see"  ><i class="fa-light fa-file-pdf"></i></a> --}}
        <a href="enfants/{{$enfant->id}}/cahier" style="font-size: 14px; padding-top: 7px"  ><i class="fa-light fa-notes me-2"></i>Créer le cahier de réussite</a>
    </div>
  @endif
  @if ($type == "avatar")
    <div class="footer p-2 d-flex justify-item-around"  style="background-color: var(--main-color)">        
        <a href="enfants/{{$enfant->id}}/avatar"  class="btn_modif_avatar {{$kE == 0 ? 'modif_avatar' : null}}" >Modifier mon avatar</a>
    </div>
  @endif
  @if ($type == "affectation_groupe")
  @php
  $groupes = json_decode(Auth::user()->groupes, true);
      if (is_null($enfant->groupe)) {
          $c = 'transparent';
      } else {
        $c = $groupes[$enfant->groupe]['backgroundColor'];
      }


      

    @endphp
    <div class="footer p-2 d-flex h-auto"  style="background-color: var(--main-color)" data-enfant="{{$enfant->id}}">        
      <div class="d-flex w-100  justify-content-around flex-wrap {{$kE == 0 ? 'choix_groupe' :  null}}">
        @if ($groupes)
        @foreach ($groupes as $key=>$terme)
            <div class="badge_termes {{ $enfant->groupe != null && $key == $enfant->groupe ? 'active' : null}}" data-color="{{$terme['backgroundColor']}}" style="background-color: {{$terme['backgroundColor']}}; color: {{$terme['textColor']}}" data-order="{{$key}}">{{$terme['name']}}</div>
        @endforeach
        @endif
    </div>
    </div>
  @endif

  @if ($type == "none")
    <div class="footer p-2 d-flex justify-item-around"  style="background-color: var(--main-color)">
        
        <button id="valideAvatar" class="custom_button btn_select_avatar" style="font-size: 12px; width: fit-content; height: 16px; line-height: 1px; margin-top: 7px; background-color: transparent;text-shadow: black 2px 2px;">Selectionner</button>

    </div>
  @endif




</div>

