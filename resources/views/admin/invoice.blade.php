@extends('layouts.admin', ['titre' => 'Mes factures', 'menu' => 'invoice'])

@section('content')
   
<div class="row justify-content-center">
    <div class="col-md-8 text-center">

        <h1>Mes factures</h1>

        <table class="table mx-auto">
            <thead>
            <tr>        
                <th>Numéro</th>                    
                <th>Date</th>
                <th>Montant</th>
                <th>Télécharger</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
            @if ($invoices->first())
                @foreach ($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->number }}</td>
                        <td>{{ Carbon\Carbon::parse($invoice->createdAt)->format('d/m/Y')}}</td>
                        <td>{{ $invoice->amount }} €</td>
                        <td><a href="{{ route('admin.invoice.download', ['number' => $invoice->number]) }}"><span class="fa fa-download"></span></a></td>
                    </tr>
                @endforeach
            @else
                <tr>        
                    <td colspan="4">Aucune facture trouvée.</th>                    
                </tr>
            @endif
            </tbody>
        </table>

    </div>
</div>

@endsection
