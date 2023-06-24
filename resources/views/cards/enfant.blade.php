


<div class="card-enfant">
  <div class="groupe {{$enfant->genre == 'G' ? 'garcon' : 'fille'}}">{{$enfant->groupe}}</div>
  <div class="card-header ">
      <img src="{{asset($enfant->photoEleve)}}" alt="rover" />
  </div>
    <div class="card-body p-0" style="text-align: center">
        <div class="name">{{$enfant->prenom}}<br><span style="font-size: 14px"> {{$enfant->nom}}</div>
        <div class="title"> {{ Carbon\Carbon::parse($enfant->ddn)->format('d/m/Y')}}</div>
  </div>
    <div class="footer follow-info p-2 d-flex justify-item-around" style="">
        <a href="enfants/{{$enfant->id}}/items/" style="text-decoration: none; color: white" ><span class="material-icons md-48">library_add</span></a>
        <a href="enfants/{{$enfant->id}}/cahier" style="text-decoration: none; color: white" ><span class="material-icons md-48">note</span></a>

    </div>
    <!-- <div class="footer">
        {{$enfant->comment}}
    </div> -->

</div>

