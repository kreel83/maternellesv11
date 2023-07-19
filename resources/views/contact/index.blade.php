<h3>Nous contacter</h3>

<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4" :errors="$errors" />

<!--Display Result -->
<div class="mb-3" id="result"></div>

<div id="contactform">

    <form method="POST">
    @csrf

    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
    <input type="hidden" name="id" value="{{ Auth::id() }}">

    <div class="mb-3">
        <!--<label for="subject" class="form-label">Email address</label>-->
        <input type="text" class="form-control" id="subject" name="subject" placeholder="Objet de votre message" value="{{ old('subject') }}" required>
    </div>

    <div class="mb-3">
        <!--<label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>-->
        <textarea class="form-control" id="message" name="message" rows="3" placeholder="Votre message" value="{{ old('message') }}" required></textarea>
    </div>

    <!--<button type="submit" class="btn btn-primary">Envoyer le message</button>-->
    <button type="button" id="submit-btn" class="btn btn-primary">Envoyer le message</button>

    </form>

</div>