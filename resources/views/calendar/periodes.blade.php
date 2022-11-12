@extends('layouts.mainMenu')
@php
    use Carbon\Carbon;


@endphp

@section('content')
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    @if (\Session::has('error'))
        <div class="alert alert-danger">
            <ul>
                <li>{!! \Session::get('error') !!}</li>
            </ul>
        </div>
    @endif
<h1>Gestion des périodes</h1>

<form action="/periode/save" method="post">
    @csrf
        @foreach($periodes as $key=>$periode)

            <h4>Période n° {{$key + 1}}</h4>
            <div class="form-group">

                <label for="">debut</label>
                <input type="date" class="form-control" name="periode_debut[]" value="{{$periode[0]}}">
                <label for="">fin</label>
                <input type="date" class="form-control" name="periode_fin[]" value="{{$periode[1]}}">
            </div>
            <hr>
        @endforeach
    <button type="submit" class="btn btn-primary">Sauvegarder</button>
</form>




@endsection
