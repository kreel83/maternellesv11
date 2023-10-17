{{-- var s = '<option value="">Sélectionnez une discipline</option>';
var x = ''; --}}

@foreach($categories as $key=>$section2)
    @if ($key != '')
    <option  class="disabledtitle" disabled>{{$key}}</option>
    @endif
    @foreach ($section2 as $categorie)

        <option class="ps-4" value="{{$categorie->id}}">{{$categorie->section2}}</option>  

    @endforeach
@endforeach
{{-- for (var i = 0; i < data.length; i++) {
    if(x != data[i]['section1']) {
        s += '<option class="disabledtitle" disabled>' + data[i]['section1'] + '</option>';
        x = data[i]['section1'];
    }
    s += '<option value="' + data[i]['id'] + '"> - ' + data[i]['section2'] + '</option>';  
}  --}}