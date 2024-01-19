{{-- <!--Display Result -->
<div class="mb-3" id="result"></div> --}}
{{-- <style>
    .form_contact {
        width: 600px;height: 600px; background-color: white;
        padding: 20px; border-radius: 26px
    }
</style> --}}

<div class="card w-75 mb-3 my-5 mx-auto text-center">

    <div class="card-body">

        <form action="{{ $route }}" method="post">
            @csrf

                <div>
                    <h3>Nous contacter</h3>

                    <div class="mb-3">
                    Vous avez des questions ?<br>
                    N'hésitez pas à nous contacter directement.<br>
                    Notre équipe vous répondra dans les meilleurs délais.
                    </div>

                    <div class="w-75 mx-auto">
                        @include('include.display_msg_error')
                    </div>

                    <div class="mb-3 w-75 mx-auto">
                        <label for="subject">Objet de votre message</label>
                        <input type="text" class="form-control" id="subject" name="subject"
                            value="{{ old('subject') }}" required>
                    </div>

                    <div class="mb-3 w-75 mx-auto">
                        <label for="message">Votre message</label>
                        <textarea class="form-control" id="message" name="message" rows="3" value="{{ old('message') }}" required></textarea>
                    </div>

                    <button type="submit" class="btnAction mx-auto">Envoyer le message</button>

                </div>

                <div class="row mt-5 d-flex justify-content-around">

                    {{-- <div class="col">
                        <i class="fas fa-map-marker-alt fa-2x"></i>
                        <p>83000 Toulon</p>
                    </div> --}}

                    <div class="col">
                        <i class="fas fa-phone fa-2x"></i>
                        <p>06 64 17 41 99</p>
                    </div>

                    <div class="col">
                        <i class="fas fa-envelope fa-2x"></i>
                        <p>{{ env('MAIL_FROM_ADDRESS') }}</p>
                    </div>
                    
                </div>
            
        </form>

    </div>
    
</div>


{{-- <div class="mb-4 vh-100 d-flex justify-content-center align-items-center">
    <form action="{{ $route }}" method="post" class="d-flex form_contact" style="">
        @csrf


        <div class="d-flex flex-column w-100 px-5">
            <div>
                <div class="h1-responsive font-weight-bold text-center my-4">Nous contacter</div>

                <div class="text-center w-responsive mx-auto mb-5">Vous avez des questions ?<br>N'hésitez pas à nous
                    contacter directement. <br>Notre équipe vous répondra dans les
                    meilleurs délais.</div>
                <!-- Validation Errors -->
                @if ($errors->any())
                    {{ dd($errors) }}
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session()->has('result'))
                    <div class="alert alert-success">
                        Votre message a été envoyé.
                    </div>
                @endif

                <div class="mb-3">
                    <label for="subject">Objet de votre message</label>
                    <input type="text" class="form-control" id="subject" name="subject"
                        value="{{ old('subject') }}" required>
                </div>

                <div class="mb-4">
                    <label for="message">Votre message</label>
                    <textarea class="form-control" id="message" name="message" rows="3" value="{{ old('message') }}" required></textarea>
                </div>

                <button type="submit" class="btnAction mx-auto">Envoyer le message</button>

            </div>
        
                <div class="mt-5">
                    <ul class="list-unstyled mb-0 d-flex w-100 justify-content-around align-items-center">
                        <li><i class="fas fa-map-marker-alt fa-2x"></i>
                            <p>83000 Toulon</p>
                        </li>

                        <li><i class="fas fa-phone fa-2x"></i>
                            <p>06 06 06 06 06</p>
                        </li>

                        <li><i class="fas fa-envelope fa-2x"></i>
                            <p>{{ env('MAIL_FROM_ADDRESS') }}</p>
                        </li>
                    </ul>                    
                </div>

            

        </div>

    </form>
</div> --}}
