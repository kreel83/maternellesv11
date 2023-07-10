

<style>

</style>

<div class="card-enfant">
  <div class="groupe {{$enfant->genre == 'G' ? 'garcon' : 'fille'}}">{{$enfant->groupe}}</div>
  <div class="card-header d-flex justify-content-center">
    @if ($enfant->background)
    <div class="m-2 degrade animaux"  style="background-image: {{$degrades[$enfant->background]}}">
        <img src="{{asset('/img/animaux/'.$enfant->photo)}}" alt="" width="120">
    
    </div>
    @else
      <img src="{{asset($enfant->photoEleve)}}" alt="rover" />
    @endif
  </div>
    <div class="card-body p-0" style="text-align: center">
        <div class="name">{{$enfant->prenom}}<br><span style="font-size: 14px"> {{$enfant->nom}}</div>
        <div class="title"> {{ Carbon\Carbon::parse($enfant->ddn)->format('d/m/Y')}}</div>
  </div>
    <div class="footer follow-info p-2 d-flex justify-item-around"  style="background-image: {{$degrades[$enfant->background] ?? $degrades['b1']}}">
        <a href="enfants/{{$enfant->id}}/items/"  ><i class="fa-light fa-book-open-cover"></i></a>
        <a href="enfants/{{$enfant->id}}/cahier"  ><i class="fa-light fa-notes"></i></a>

    </div>
    <!-- <div class="footer">
        {{$enfant->comment}}
    </div> -->

</div>

