<h3>Nous contacter</h3>

<!-- Validation Errors -->
@if ($errors->any())
{{dd($errors)}}
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session()->has('result'))
    <div class="alert alert-success">
        Votre message a été envoyé.
    </div>
@endif

<!--Display Result -->
<div class="mb-3" id="result"></div>

<form action="{{ $route }}" method="post">
@csrf

    <div class="mb-3">
        <!--<label for="subject" class="form-label">Email address</label>-->
        <input type="text" class="form-control" id="subject" name="subject" placeholder="Objet de votre message" value="{{ old('subject') }}" required>
    </div>

    <div class="mb-3">
        <!--<label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>-->
        <textarea class="form-control" id="message" name="message" rows="3" placeholder="Votre message" value="{{ old('message') }}" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Envoyer le message</button>

</form>

