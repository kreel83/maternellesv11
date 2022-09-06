@php
    $k = 0;
@endphp

<style>

    .container {
        padding: 0 100px;
    }

    .card {
        width: 200px; height: 300px;padding: 10px; margin: 0 auto;
        border: 1px solid red;
        border-radius: 16px;
    }


</style>

<div class="container">
    <table class="table" style="width: 100%">
        <tr>
            @foreach($items as $item)
                <?php $k = $k + 1; ?>
                <td>
                    <div class="card">
                        <img src="{{asset($item->image)}}" width="200px" />
                        {{--style="width: 100px;height: 100px;border-radius: 50px">--}}
                        <p style="text-align: center">{{$item->st}}</p>
                        @if (isset($item->name)) <p style="text-align: center">{{$item->name}}</p> @endif
                    </div>

                </td>
                @if (($k % 5 == 0) && ($k!=0))
        </tr>
        <tr>
            @endif
            @endforeach
        </tr>

    </table>
</div>










{!! $reussite !!}
