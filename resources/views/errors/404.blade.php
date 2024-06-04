<style>
    body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #FC7A63;
        color: white;
        margin: 0;
    }
    .container {
        text-align: center;
    }
    h1 {
        font-size: 3em;
        margin-bottom: 0.5em;
    }
    p {
        font-size: 1.5em;
        margin-bottom: 1em;
    }
    a {
        text-decoration: none;
        color: #007bff;
    }
    a:hover {
        text-decoration: underline;
    }
    .error {
        font-size: 120px;
    }
  
</style>
<div class="container">
    <div style="display: flex; flex-direction: column; align-items: center">
        <div class="error">404</div>
        <hr>
        <img src="{{asset('img/deco/logo.png')}}" alt="">        
    </div>

    <h1>Oops, quelque chose ne va pas !!!</h1>
    <p>Désolé, la page que vous recherchez n'existe pas.</p>
    <a href="{{ route('depart') }}">Retour au tableau de bord</a>
</div>
