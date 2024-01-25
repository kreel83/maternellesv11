<div class="card mx-auto w-75 p-3 mb-5" style="border: none; border-radius: 40px; ">

    <div class="ms-3" style="border: none; border-radius: 40px">
        <div class="d-flex justify-content-between pt-2">
            <h5>Vous avez {{ $liste->count() }} partage{{ $liste->count() > 1 ?'s' : null}} en attente</h5>
        </div>
    </div>
    
    <div class="d-flex flex-column lignePartage">
        @foreach ($liste as $partage)       
            <div class="d-flex align-items-center">
                <div class="mx-3 pt-3">
                    <small><i class="fas fa-circle" style="color: var(--main-color)"></i></small>
                </div>
                <div class="me-5 pt-3">
                    {{-- {{ $partage->classe->description }} --}}
                    {{ $partage->prenom.' '.$partage->name.' ('.$partage->description.')' }}
                </div> 
                <button class="btnAction me-3 agreeShare" data-id="{{$partage->id}}">Accepter le partage</button>
                <button class="btnAction inverse rejectShare" data-id="{{$partage->id}}">Refuser le partage</button>
                {{-- <a href="{{ route('rejectShare', ['id' => $partage->id]) }}">Refuser le partage</a> --}}
            </div>
        @endforeach
    </div>        

</div>