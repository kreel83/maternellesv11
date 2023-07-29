@extends('layouts.admin', ['titre' => 'Mes factures', 'menu' => 'invoice'])

@section('content')
   
<div class="row justify-content-center">
    <div class="col-md-8 text-center">

        <h1>Mes factures</h1>

        <table class="table mx-auto">
            <tr>        
                <th>Numéro</th>                    
                <th>Date</th>
                <th>Montant</th>
                <th>Télécharger</th>
            </tr>
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->number }}</td>
                    <td>{{ $invoice->date()->format('d/m/Y') }}</td>
                    <td>{{ $invoice->total() }}</td>
                    <td><a href="/app/admin/invoice/{{ $invoice->id }}"><span class="fa fa-download"></span></a></td>
                </tr>
            @endforeach
        </table>

    </div>
</div>

@endsection
