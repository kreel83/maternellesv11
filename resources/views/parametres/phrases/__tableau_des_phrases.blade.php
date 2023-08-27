<style>
    .prenom_dans_phrase, strong {
        background-color: var(--main-color);
        color: white;
        padding: 2px 14px;
        border-radius: 14px;
        font-size: 14px
    }

</style>

<table class="table table-bordered" id="tableauDesPhrases">

    @foreach ($commentaires as $commentaire)
    <tr>
        <td style="">{!!  $commentaire->formatTexte() !!}</td>
        <td  style="width: 60px" class="controle" data-id="{{$commentaire->id}}"><span class="editPhrase"><i class="fas fa-edit"></i></span><span class="deletePhrase" style="margin-left: 10px"><i class="fas fa-trash"></i></span></td>
    </tr>
    @endforeach
 
</table>
