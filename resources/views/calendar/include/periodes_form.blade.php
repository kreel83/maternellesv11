
@php
    use Carbon\Carbon;


@endphp
<form action="/periode/save" method="post">
    @csrf
    <input type="hidden" value="{{$periodes_json}}" id="periodes">
    <div class="d-flex flex-column justify-content-between w-100 mt-5 px-5">

        @if ($periodes)
        @foreach($periodes as $key=>$periode)

            <div class="mb-5 p-3 periodeCadre{{$key+1}}">
                <h4>{{$periode['label']}}</h4>
                <div class="form-group">

                    <label for="">debut</label>
                    <input disabled type="date" class="form-control" name="periode_debut[]" value="{{$periode['debut']->format('Y-m-d')}}">
                    <label for="">fin</label>
                    <input disabled type="date" class="form-control" name="periode_fin[]" value="{{$periode['fin']->format('Y-m-d')}}">
                </div>                
            </div>

        
        @endforeach  
        @endif      
    </div>

    {{-- <button type="submit" class="btn btn-primary mt-5 ms-5">Sauvegarder</button> --}}
</form>