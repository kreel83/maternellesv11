@extends('layouts.mainMenu2', ['titre' => 'Mes factures', 'menu' => 'facture'])

@section('content')
{{-- <div class="container mt-5"> --}}
    
<div class="container my-5 page" id="">

    <nav class="pb-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">Mes factures</li>
        </ol>
    </nav>

    <div class="card mx-auto w-75">
        <div class="card-body">

            @include('include.display_msg_error')

    <div class="row justify-content-center">
        <div class="col-md-8 text-center">

            <h3>Mes factures</h3>

            <table class="table mx-auto">
                <thead>
                <tr>        
                    <th>Numéro</th>                    
                    <th>Date</th>
                    <th>Montant</th>
                    <th>Télécharger</th>
                    @if(Auth::user()->ecole_identifiant_de_l_etablissement != '')
                        <th>Transmettre</th>
                    @endif
                </tr>
                </thead>
                <tbody class="table-group-divider">
                @if ($invoices->first())
                    @foreach ($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->number }}</td>
                            <td>{{ Carbon\Carbon::parse($invoice->createdAt)->format('d/m/Y')}}</td>
                            {{--<td>{{ $invoice->date()->format('d/m/Y') }}</td>--}}
                            <td>{{ $invoice->amount }} €</td>
                            {{--<td>{{ $invoice->total() }}</td>--}}
                            <td><a href="{{ route('facture.download', ['facture_number' => $invoice->number]) }}" target="_blank"><i class="fa-solid fa-download"></i></a></td>
                            @if(Auth::user()->ecole_identifiant_de_l_etablissement != '')
                                <td><a href="{{ route('facture.send', ['facture_number' => $invoice->number]) }}" title="Envoyer à votre établissement"><i class="fa-solid fa-envelope"></i></a></td>
                            @endif
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
</div>
</div>
</div>

{{-- </div> --}}
@endsection
