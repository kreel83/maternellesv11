
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <table class="table table-bordered table-hover">
        @if ($maternelles)

            @foreach ($maternelles as $ecole)

                <tr>
                    <td class="ecole" data-academie="{{$ecole->fields->libelle_academie}}" data-num="{{$ecole->fields->numero_uai}}">{{ $ecole->fields->appellation_officielle }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td><div class="alert alert-warning">Aucune maternelle trouvée</div></td>
            </tr>
        @endif
        </table>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <table class="table table-bordered table-hover">
        @if ($primaires)
        @foreach ($primaires as $ecole)
            <tr>
                <td class="ecole" data-academie="{{$ecole->fields->libelle_academie}}" data-num="{{$ecole->fields->numero_uai}}">{{ $ecole->fields->appellation_officielle }}</td>
            </tr>
        @endforeach
            @else
                <tr>
                    <td><div class="alert alert-warning">Aucune école élémentaire trouvée</div></td>
                </tr>
            @endif
        </table>
    </div>




