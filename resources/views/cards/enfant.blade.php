
{{-- <a href="enfants/{{$enfant->id}}/items/" style="text-decoration: none" >
  <div class="card">
    <div class="card-header">
      <img src="{{asset($enfant->photo)}}" alt="rover" />
    </div>
    <div class="card-body">
      <span class="tag tag-teal">groupe {{$enfant->groupe}}</span>
      <h4>
        {{$enfant->prenom}} {{$enfant->nom}}
      </h4>
      <p>
        {{ Carbon\Carbon::parse($enfant->ddn)->format('d/m/Y')}}
      </p>
      <div class="user">
        @foreach (explode(';',$enfant->mail) as $mail)
          <li>{{$mail}}</li>
        @endforeach
      </div>
    </div>
  </div>
</a> --}}


<div class="card">
  <div class="card-header banner {{$enfant->genre == 'G' ? 'garcon' : 'fille'}}" style="margin-bottom: 70px">
    <img src="{{asset($enfant->photoEleve)}}" alt="rover" />
      <div class="groupe">{{$enfant->groupe}}</div>
  </div>
    <div class="card-body p-0" style="text-align: center">
        <h3 class="name">{{$enfant->prenom}}<br><span style="font-size: 14px"> {{$enfant->nom}}</span></h3>
        <div class="title"> {{ Carbon\Carbon::parse($enfant->ddn)->format('d/m/Y')}}</div>



  </div>
    <div class="card-footer follow-info" style="display: flex;justify-content: space-around; background-color: transparent; height: 50px">
        <h2><a href="enfants/{{$enfant->id}}/items/" style="text-decoration: none; color: black" ><i class="fad fa-ballot-check"></i></a></h2>
        <a href="enfants/{{$enfant->id}}/cahier" style="text-decoration: none; color: black" ><i style="font-size: 32px" class="far fa-book-open"></i></a>

    </div>
    <div class="card-footer" style="display: flex;justify-content: space-around; font-size: 12px; height: 80px">
        {{$enfant->comment}}
    </div>

</div>

