<div class="d-flex flex-column">
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item ill_tab" role="presentation"  data-id="origin">
      <button class="nav-link active" >Illustrations originales</button>
    </li>
    <li class="nav-item ill_tab" role="presentation" data-id="mine">
      <button class="nav-link">Mes illustrations</button>
    </li>
    {{-- <li class="nav-item ill_tab" role="presentation" data-id="others">
      <button class="nav-link">La communauté</button>
    </li> --}}
</ul>


  <div>
    <div class="ill d-flex flex-wrap" id="origin" role="tabpanel" aria-labelledby="home-tab">
        @foreach ($images['appli'] as $image)
        <div class="selectImage {{$source}}"  data-image="{{ $image }}">
            <img src="{{ asset('storage/items/' . $image) }}" class="img-fluid">
            <!-- width="100%" -->
        </div>
        @endforeach
    </div>
    <div class="d-none ill flex-wrap" id="mine" role="tabpanel" aria-labelledby="profile-tab">
        @if (isset($images['mine']))
            @foreach ($images['mine'] as $image)
            <div class="selectImage {{$source}}"  data-image="{{ $image }}">
                <img src="{{ asset('storage/items/' . $image) }}" class="img-fluid">
                <!-- width="100%" -->
            </div>
            @endforeach
        @endif
        
    </div>
    <div class="d-none ill flex-wrap" id="others" role="tabpanel" aria-labelledby="contact-tab">
        @if (isset($images['others']))
            @foreach ($images['others'] as $image)
            <div class="selectImage {{$source}}"  data-image="{{ $image }}">
                <img src="{{ asset('storage/items/' . $image) }}" class="img-fluid">
                <!-- width="100%" -->
            </div>
            @endforeach
        @endif
        
    </div>
  </div>

</div>


