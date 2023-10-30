<style>
    .prenom_dans_phrase, strong {
        background-color: var(--main-color);
        color: white;
        padding: 2px 14px;
        border-radius: 14px;
        font-size: 14px
    }

    .phrase_bloc {
        width: fit-content;
        height: auto;
        background-color: var(--second-color);
        color: var(--main-color);
        padding: 4px 26px;
        margin: 8px 0;
        border-radius: 8px;
        line-height: 30px;
    }
    #tableCommentaireContainer {
        background-color: white !important;
        padding: 8px;
    }
    

</style>



    @foreach ($commentaires as $commentaire)
    <div class="phrase_bloc d-flex" data-id="{{$commentaire->id}}">
        <div class="texte">{{  $commentaire->phrase_masculin }}</div>
        <div class="seeExemple ms-2" style="cursor: pointer" data-id="{{$commentaire->id}}"><i class="fas fa-eye"></i></div>
        @if ($commentaire->user_id)
        <div  style="width: 30px" class=" d-flex ms-2 controlePhrase" data-id="{{$commentaire->id}}">
            <div class="editPhrase" style="cursor: pointer"><i class="fas fa-edit"></i></div>
            <div class="deletePhrase" style="margin-left: 10px; cursor: pointer"><i class="fas fa-trash"></i></div>
        </div>
        @endif
    </div>
    @endforeach

    {{-- @foreach ($commentaires as $commentaire)
    <tr>
        <td style="">{{  $commentaire->phrase_masculin }}</td>
        <td  style="width: 60px" class="controle" data-id="{{$commentaire->id}}"><span class="editPhrase"><i class="fas fa-edit"></i></span><span class="deletePhrase" style="margin-left: 10px"><i class="fas fa-trash"></i></span></td>
    </tr>
    @endforeach --}}
 

