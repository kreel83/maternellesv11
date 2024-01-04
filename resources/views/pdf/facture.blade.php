<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <style>
            /*
            @page {
                margin: 60px;
            }
            */
            
            footer {
                position: fixed; 
                bottom: -40px; 
                left: 0px; 
                right: 0px;
                height: 50px; 
                font-size: 14px !important;
                /*color: #000;*/
                text-align: center;
                line-height: 30px;
                border-top: 1px solid #000;
            }

            .titre {
                text-align: right;
                font-size: 1.6em;
                margin-bottom: 40px;
            }
            .date {
                font-weight: bold;
            }
            .adresses {
                margin-bottom: 60px;
            }
            .facturation {
                p_osition:absolute;
                r_ight:0px;
                b_order:1px solid #000;
                padding: 5px;
            }
            .owner {
                /*
                border:1px solid #ffffff;
                padding: 5px;
                */
            }
            .entete {
                font-weight: bold;
                background-color: #dddddd;                
            }
            .contenu {
                width: 100%;
                border: 1px solid #cccccc;
                margin-bottom: 40px;
            }
            .summary {
                position: absolute;
                right: 0px;
                border: 1px solid #cccccc;
            }
            .td1 {
                border-right: 1px solid #cccccc;
            }
            .center
            {
                text-align: center;
            }
            .right
            {
                text-align: right;
            }
            .modepaiement {
                border-top: 1px solid #cccccc;
            }
            .logo {
                position:absolute;
                left:0px;
                top:18px;
            }
        </style>

    </head>
<body>

    <p class="titre"><i>Facture Client Acquitée N° {{ $invoice->number }}</i></p>
    <img class="logo" src="data:image/png;base64,<?php echo base64_encode(file_get_contents(base_path('public/img/deco/logo-facture.png'))); ?>">

    <table class="adresses" width="100%">
    <tr>
        <td width="55%">
            <div class="owner">
            <i><strong>Clickweb</strong></i><br>
            Le Clos B<br>
            Les Plaines<br>
            83590 Gonfaron
            </div>
            <br>
            <div class="date">
                Date : {{ Carbon\Carbon::parse($invoice->createdAt)->format('d/m/Y')}}
            </div>
        </td>
        <td width="45%" style="border:1px solid #000">
            <div class="facturation">
            <strong>Adresse de facturation</strong><br>
            @if($user->role == 'admin')
                {{ $ecole->nom_etablissement }}<br>
                {{ $ecole->adresse_1 }}<br>
                {{ $ecole->adresse_3 }}<br>
            @else
                {{ $user->prenom.' '.$user->name }}<br><br>
                Mon établissement :<br>
                {{ $ecole->nom_etablissement }}<br>
                {{ $ecole->adresse_1 }}<br>
                {{ $ecole->adresse_3 }}<br>
            @endif
            </div>
        </td>
    </tr>    
    </table>    
   
    <table class="contenu" cellspacing="0" cellpadding="5">
        <tr class="entete">
            <td class="td1">Réf.</td>
            <td class="td1">Désignation</td>
            <td class="td1 center">Qu.</td>
            <td class="td1 right">Prix HT</td>
            <td class="td1 right">TVA</td>
            <td class="right">Total TTC</td>
        </tr>
        @php
            $totalHT = 0;
            $totalTVA = 0;
            $totalTTC = 0;
        @endphp
        @foreach ($lignes as $ligne)
            <tr>
                <td class="td1">{{ $ligne-> reference }}</td>
                <td class="td1">{{ $ligne-> name }}</td>
                <td class="td1 center">{{ $ligne->quantity }}</td>
                <td class="td1 right">{{ $ligne->price_tax_excl }} €</td>
                <td class="td1 right">{{ $ligne->tax_amount }} €</td>
                <td class="right">{{ $ligne->price_tax_incl }} €</td>
            </tr>
            @php
            $totalHT += $ligne->price_tax_excl;
            $totalTVA += $ligne->tax_amount;
            $totalTTC += $ligne->price_tax_incl;
        @endphp
        @endforeach
    </table>

    <table class="summary" cellspacing="0" cellpadding="5">
    <tr>
        <td class="td1">Total HT</td>
        <td class="right">{{ number_format($totalHT, 2) }} €</td>
    </tr>
    <tr>
        <td class="td1">TVA (20,00 %)</td>
        <td class="right">{{ number_format($totalTVA, 2) }} €</td>
    </tr>
    <tr>
        <td class="td1">Total TTC</td>
        <td class="right">{{ number_format($totalTTC, 2) }} €</td>
    </tr>
    </table>

    <p><strong>Mode de paiement :</strong> {{ $invoice->payment_method }}</p>

    <footer>SASU au capital de 1000 € - N° RCS 818747131 Draguignan - Code APE : 4791B - N° de TVA : FR 33 818747131</footer>
    
</body>
</html>