

<style>

</style>


@php
$lesgroupes = json_decode(Auth::user()->groupes, true);
$groupe = null;
if ($enfant->groupe != null){
  
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
        <div class="name d-flex justify-content-center align-items-center">
          <span class="me-2 mt-1">
            @if ($enfant->genre == 'G')
            <i class="icone_avatar garcon fa-duotone fa-user-tie-hair"></i>
            @else
            <i class="icone_avatar fille fa-duotone fa-user-tie-hair-long"></i>
            @endif
          </span>
          
          {{$enfant->prenom}}
          <span style="font-size: 1.8rem" class="ms-2 mt-1">{{substr($enfant->nom,0,1)}}.</span>
          </div>
        <div class="title" style="border-color: {{$enfant->genre == 'F' ? 'var(--pink)' : 'var(--blue)'}}">


           {{ $enfant->age}}
        </div>
  </div>
  @if ($groupe)
    <div class="groupe-terme"  style="background-color: {{ $groupe["backgroundColor"] }}; color:{{ $groupe["textColor"]}}">{{$groupe["name"]}}</div>
  @endif


  @if ($type == "evaluation")
    <div class="footer p-2 d-flex justify-item-around"  style="background-image: {{$degrades[$enfant->background] ?? $degrades['b1']}}">

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
    <div class="footer p-2 d-flex justify-item-around"  style="background-image: {{$degrades[$enfant->background] ?? $degrades['b1']}}">
        
        <a href="enfants/{{$enfant->id}}/cahier"  ><i class="fa-light fa-paper-plane-top"></i></a>
        <a href="enfants/{{$enfant->id}}/cahier"  ><i class="fa-light fa-file-pdf"></i></a>
        <a href="enfants/{{$enfant->id}}/cahier"  ><i class="fa-light fa-notes"></i></a>
    </div>
    @endif




</div>

