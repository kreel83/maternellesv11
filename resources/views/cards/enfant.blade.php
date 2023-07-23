

<style>

</style>


@php
    // dd(Auth::user()->groupe, $enfant->groupe, $enfant, Auth::user()->type_groupe);
@endphp

<div class="card-enfant">
  @if (Auth::user()->groupe_type == 'colors' && $enfant->groupe != null)
    <div class="groupe" style="background-color: {{ Auth::user()->groupe[$enfant->groupe]}}"></div>
  @endif
  @if (Auth::user()->type_groupe == 'termes' && $enfant->groupe != null)
    <div class="groupe-terme">{{Auth::user()->groupe[$enfant->groupe]}}</div>
  @endif
  <div class="card-header d-flex justify-content-center">
    @if ($enfant->background)
    <div class="m-2 degrade_card_enfant animaux"  style="background-image: {{$degrades[$enfant->background]}}">
        <img src="{{asset('/img/animaux/'.$enfant->photo)}}" alt="" width="120">
    
    </div>
    @else
      <img src="{{asset($enfant->photoEleve)}}" alt="rover" />
    @endif
  </div>
    <div class="card-body p-0 mt-2" style="text-align: center">
        <div class="name">{{$enfant->prenom}}<span style="font-size: 1.8rem" class="ms-2"> {{substr($enfant->nom,0,1)}}.</span></div>
        <div class="title"> {{ $enfant->age}}</div>
  </div>
    <div class="footer follow-info p-2 d-flex justify-item-around"  style="background-image: {{$degrades[$enfant->background] ?? $degrades['b1']}}">
        <a href="enfants/{{$enfant->id}}/items/"  ><i class="fa-light fa-book-open-cover"></i></a>
        <a href="enfants/{{$enfant->id}}/cahier"  ><i class="fa-light fa-notes"></i></a>

    </div>
    <!-- <div class="footer">
        {{$enfant->comment}}
    </div> -->

</div>

