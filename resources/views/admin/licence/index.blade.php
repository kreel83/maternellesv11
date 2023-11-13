@extends('layouts.admin', ['titre' => 'Gestion des licences', 'menu' => 'licence'])

@section('content')

<div class="row">
    <div class="col">
    <h1>Gestion des licences</h1>
    </div>
    <div class="col">
    <a href="{{ route('admin.licence.achat') }}" class="btn btn-primary">Commander des licences</a>
    </div>
</div>

@include('include.display_msg_error')

<div class="row mt-3">

    <div class="col-md-12">

        <div id="result"></div>

        <!-- Validation Errors -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.licence.renew') }}" method="POST">
        @csrf

            <button class="btn btn-primary mb-3">Renouveler la sélection</button>

            <table class="table" cellspacing="0">
                <thead>
                    <tr>
                        {{-- <th><input type="checkbox" id="selectAll"></th> --}}
                        {{-- <th>ID</th> --}}
                        <th><input class="me-1" type="checkbox" id="selectAll"> Numéro</th>
                        <th>Utilisateur</th>
                        <th>Statut</th>
                        <th>Expires le</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                @foreach ($licences as $licence)
                    <tr>
                        {{-- <td>{{ $licence->id }}</td> --}}
                        <td>
                            @if($product->id != $licence->produit_id)
                                <input class="me-1" type="checkbox" id="licenceSelection" name="licenceSelection[]" value="{{ $licence->id }}">
                            @else
                                <i class="fa-regular fa-circle-check fa-xs me-1"></i>
                            @endif
                            {{ $licence->internal_name }}
                        </td>
                        <td>
                            @if($licence->licence_actif == 0)
                                {{ $licence->prenom }} {{ $licence->name }}
                            @elseif(is_null($licence->user_id))
                                {{--
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <input type="email" size="32" id="assign-{{$licence->id}}" class="form-control" placeholder="Mail professionnel de l'enseignant">
                                    <button id="{{$licence->id}}" type="button" class="btn btn-primary assignbtn">OK</button>
                                </div>
                                <div id="msg-{{$licence->id}}" class="mt-1"></div>
                                --}}
                                {{-- <a href="{{ route('admin.licence.assign.step1', ['licence_name' => $licence->internal_name]) }}">Assigner la licence</a> --}}
                                <a href="{{ route('admin.licence.assign.step1', ['licence_name' => $licence->internal_name]) }}">Assigner</a>
                            @else
                                {{ $licence->prenom }} {{ $licence->name }} [ <a href="{{ route('admin.licence.remove', ['licence_name'=>$licence->internal_name]) }}" class=".removelnk">Retirer</a> ]
                                @if($licence->user_actif == 0)
                                <div class="alert alert-warning mt-2 mb-1" role="alert">
                                    Compte utilisateur inactif. <a href="{{ route('admin.licence.sendreminder', ['licence_name' => $licence->internal_name]) }}" class="alert-link">Renvoyer le lien d'activation</a>
                                    </div>
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ ($licence->licence_actif == 1) ? 'Active' : 'Expirée' }}
                        </td>
                        <td>{{ Carbon\Carbon::parse($licence->expires_at)->format('d/m/Y')}}</td>
                        {{-- <td>{{ Carbon\Carbon::parse($licence->expires_at)->format('d/m/Y H:i:s')}}</td> --}}
                    </tr>
                @endforeach
                </tbody>
                
            </table>

            
        </form>

    </div>
    
</div>

@endsection

{{--  avec liste deroulante pour assigner un utilisateur
@foreach ($licences as $licence)
                <tr>
                    <td>{{ $licence->id }}</td>
                    <td>{{ $licence->internal_name }}</td>
                    <td>
                        @if(is_null($licence->user_id))
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <select id="assign-{{$licence->id}}" class="form-select">
                                <option value="0" selected>Assigner à un utilisateur</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name.' '.$user->prenom }}</option>
                                @endforeach
                            </select>
                            <button id="{{$licence->id}}" type="button" class="btn btn-primary assignbtn">OK</button>
                            </div>
                            <!--<a href="">Assigner à un utilisateur</a>-->
                        @else
                        {{ $licence->prenom }} {{ $licence->name }} [ <a href="{{ route('admin.licence.remove', ['id'=>$licence->id]) }}" class=".removelnk">Retirer</a> ]
                        @endif
                    </td>
                    <td>{{ Carbon\Carbon::parse($licence->expires_at)->format('d/m/Y H:i:s')}}</td>
                </tr>
            @endforeach
--}}
