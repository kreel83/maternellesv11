

<!--Display Result -->
<div class="mb-3" id="result"></div>

<form action="{{ $route }}" method="post">
@csrf

    <section class="mb-4">

        <h2 class="h1-responsive font-weight-bold text-center my-4">Nous contacter</h2>

        <p class="text-center w-responsive mx-auto mb-5">Vous avez des questions ? N'hésitez pas à nous contacter directement. Notre équipe vous répondra dans les
            meilleurs délais.</p>

        

        <div class="row">

            <div class="col-md-9 mb-md-0 mb-5">

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

                <div class="mb-3">
                    <label for="subject">Objet de votre message</label>
                    <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject') }}" required>
                </div>
                
                <div class="mb-4">
                    <label for="message">Votre message</label>
                    <textarea class="form-control" id="message" name="message" rows="3" value="{{ old('message') }}" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Envoyer le message</button>

            </div>

            <div class="col-md-3 text-center">
                <ul class="list-unstyled mb-0">
                    <li><i class="fas fa-map-marker-alt fa-2x"></i>
                        <p>83000 Toulon</p>
                    </li>

                    <li><i class="fas fa-phone mt-4 fa-2x"></i>
                        <p>06 06 06 06 06</p>
                    </li>

                    <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                        <p>{{ env('MAIL_FROM_ADDRESS') }}</p>
                    </li>
                </ul>
            </div>

        </div>

    </section>

</form>

