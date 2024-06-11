<!DOCTYPE html>
<html>
<head>
    <title>Students List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h4>Classe de {{$maitresse}}</h4>
    <h5>{{$classe->description}} - {{$annee}}</h5>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Date de naissance</th>
                <th>Groupe</th>
                <th>e-mail(s)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
            <tr>
                <td>{{ $student->genre }}</td>
                <td>{{ $student->prenom }}</td>
                <td>{{ $student->nom }}</td>
                <td>{{ Carbon\Carbon::parse($student->ddn)->format('d-m-Y') }}</td>
                {!! $student->groupe() !!}
                {!! $student->mails() !!}
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
