@extends('layouts.admin', ['titre' => 'Gestion des licences'])

@section('content')

<h1>Bienvenue sur la gestion de vos licences</h1>

<a href="{{ route('admin.licence.achat') }}" class="btn btn-primary">Commander des licences</a>

<div id="assigneLicence">

<div class="row justify-content-center">

    <div class="col-md-8">

        <div id="result"></div>
        @csrf
        <table class="table mx-auto">
            <tr>
                <th>ID</th>
                <th>Référence</th>
                <th>Utilisateur</th>
                <th>Statut</th>
                <!--<th>Date</th>-->
                <th>Expires le</th>
            </tr>
            @foreach ($licences as $licence)
                <tr class="text-center">
                    <td>{{ $licence->id }}</td>
                    <td>{{ $licence->internal_name }}</td>
                    <td>
                        @if(is_null($licence->user_id))
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <input type="email" size="30" id="assign-{{$licence->id}}" class="form-control" placeholder="Mail professionnel de l'enseignant">
                            <!--
                            <select id="assign-{{$licence->id}}" class="form-select">
                                <option value="0" selected>Assigner à un utilisateur</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name.' '.$user->prenom }}</option>
                                @endforeach
                            </select>
                        -->
                            <button id="{{$licence->id}}" type="button" class="btn btn-primary assignbtn">OK</button>
                            </div>
                            <!--<a href="">Assigner à un utilisateur</a>-->
                        @else
                        {{ $licence->prenom }} {{ $licence->name }} [ <a href="{{ route('admin.licence.remove', ['id'=>$licence->id]) }}" class=".removelnk">Retirer</a> ]
                        @endif
                    </td>
                    <td>
                        {{ ucfirst($licence->status) }}
                        {{--
                        @if($licence->status == "attente")
                            En attente de confirmation par l'utilisateur
                        @else
                            {{ ucfirst($licence->status) }}
                        @endif
                        --}}
                    </td>
                    <td>{{ Carbon\Carbon::parse($licence->expires_at)->format('d/m/Y H:i:s')}}</td>
                </tr>
            @endforeach
            
        </table>

        <p><strong>Statuts :</strong></p>
        <ul>
            <li>Active : l'utilisateur a accès à toutes les fonctionnalités de son compte.</li>
            <li>Attente : un compte a été crée pour l'utilisateur, un mail lui a été envoyé pour confirmation de sa part.</li>
        </ul>

    </div>
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
