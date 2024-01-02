@php
use Carbon\Carbon;
$m = ucfirst($month->locale('fr')->monthName);
$nb = $month->month;
$annee = $month->year;


$start = $month->dayOfWeek;
if ($start == 0) $start = 7;
$nb_jours = $month->daysInMonth;
$end = $start + $nb_jours;
$day = $month->startOfMonth();

$mois_precedent = $month->clone()->addMonths(-1)->daysInMonth;
$debut_mois_precedent = $mois_precedent - $start;
$actual_year = $day->year;
//dd($start_year, $actual_year);


//dd($jour, $day);



@endphp


        <div class="month_bloc" >
            <div class="month_name">{{$m}} {{$annee}}</div>
            <div class="month_days d-flex">
                <div>lu</div>
                <div>ma</div>
                <div>me</div>
                <div>je</div>
                <div>ve</div>
                <div>sa</div>
                <div>di</div>
            </div>
            <div class="month_dates d-flex  flex-wrap">



        @for ($z=1; $z<=42; $z++)
                    @if ($z < $start)

                        <div class="day position-relative" style="color: lightgray">{{$debut_mois_precedent + $z +1}}

                        </div>
                    @endif

                    @if ($z >= $start && $z < $end)
                    <div class="day actif position-relative" data-js_date="{{Carbon::parse($day)->format('Y-m-d')}}" data-date="{{Carbon::parse($day)->format('d/m/Y')}}" data-all="{{(($actual_year - $start_year ) * $start_year_nb_days) + $day->dayOfYear()}}" data-dayOfYear="{{$day->dayOfYear()}}">
                        <div class="position-absolute day_event d-none"  data-js_date="{{Carbon::parse($day)->format('Y-m-d')}}" style="color: red; bottom: -5px; left: 50%; transform: translate(-50%); font-size: 30px"></div>
                        {{$z - $start + 1}}</div>
                        @php
                            $day->addDays(1)
                        @endphp
                    @endif
                        @if ($z >= $end)
                            <div class="day" style="color: lightgray">{{$z - $nb_jours - $start + 1}}</div>
                        @endif

        @endfor
            </div>


    </div>


