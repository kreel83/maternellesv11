

    
    <ul class="nav nav-tabs" id="myTab" role="tablist">
    @php
        $i = 1;
    @endphp
    @foreach ($ecoles as $key=>$liste)
        <li class="nav-item" role="presentation">
            <button class="nav-link {{$i == 1 ? 'active' : null}} " id="listetab_{{$i}}" data-bs-toggle="tab" data-bs-target="#tab_{{$i}}" type="button" role="tab" aria-controls="home" aria-selected="true">{{$key}}</button>
        </li>
        @php
            $i++;
            
        @endphp
    @endforeach
    </ul>
    <div class="tab-content">
        @php
            $i = 1;
        @endphp
        @foreach ($ecoles as $key=>$liste)
 
            <div class="tab-pane fade {{$i == 1 ? 'show active' : null}}" id="tab_{{$i}}" role="tabpanel" aria-labelledby="home-tab">
                <table class="table table-bordered table-hover">
                    @foreach ($liste as $ecole)      
                        <tr>
                            <td class="ecole" data-academie="{{$ecole['code_academie']}}" data-num="{{$ecole['identifiant_de_l_etablissement']}}">{{ $ecole['nom_etablissement'] }}</td>
                        </tr>                                 
                                        
                    @endforeach
                </table>
            </div>   
            @php
                $i++;
            @endphp 
        @endforeach
    </div>
  
    






