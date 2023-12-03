@extends('layouts.mainMenu2', ['titre' => 'Mes factures', 'menu' => 'facture'])

@section('content')
<div class="container mt-5">
    
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
                @if ($invoices->first())
                    @foreach ($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->number }}</td>
                            <td>{{ Carbon\Carbon::parse($invoice->createdAt)->format('d/m/Y')}}</td>
                            {{--<td>{{ $invoice->date()->format('d/m/Y') }}</td>--}}
                            <td>{{ $invoice->amount }}</td>
                            {{--<td>{{ $invoice->total() }}</td>--}}
                            <td><a href="{{ route('user.invoice.download', ['facture_number' => $invoice->number]) }}"><span class="fa fa-download"></span></a></td>
                        </tr>
                    @endforeach
                @else
                    <tr>        
                        <td colspan="4">Aucune facture trouvée.</th>                    
                    </tr>
                @endif
            </table>

        </div>
    </div>

</div>
@endsection
