@foreach ($section->getCommentaires() as $commentaire)
    <tr>
        <td>{{$commentaire->texte}}</td>
        <td class="controle" data-id="{{$commentaire->id}}"><span class="editPhrase"><i class="fas fa-edit"></i></span><span class="deletePhrase" style="margin-left: 10px"><i class="fas fa-trash"></i></span></td>
    </tr>
@endforeach
