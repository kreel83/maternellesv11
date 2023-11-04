@foreach ($images as $image)
<div class="selectImage {{$source}}"  data-image="{{ $image }}">
    <img src="{{ asset('storage/items/' . $image) }}" class="img-fluid">
    <!-- width="100%" -->
</div>
@endforeach