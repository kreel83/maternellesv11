
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
  <div class="card-header banner" style="margin-bottom: 70px">
    <img src="{{asset($enfant->photo)}}" alt="rover" />
  </div>
    <div class="card-body" style="text-align: center">
        <h3 class="name">{{$enfant->prenom}}<br><span style="font-size: 20px"> {{$enfant->nom}}</span></h3>
        <div class="title"> {{ Carbon\Carbon::parse($enfant->ddn)->format('d/m/Y')}}</div>



  </div>
    <div class="card-footer follow-info" style="display: flex;justify-content: space-around; background-color: transparent">
        <h2><a href="enfants/{{$enfant->id}}/items/" style="text-decoration: none; color: black" ><i class="fad fa-ballot-check"></i></a></h2>
        <h2><a href="enfants/{{$enfant->id}}/cahier/1" style="text-decoration: none; color: black" ><i class="far fa-book-open"></i></a></h2>
    </div>
    <div class="card-footer" style="display: flex;justify-content: space-around">
        {{$enfant->comment}}
    </div>

</div>

