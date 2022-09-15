<h2>creation de fiche</h2>
<form action="">
    <div class="col-md-12">
        <div class="col-md-8">
            <div class="form-group">
                <label for="">Genre</label>
                <select name="genre" id="" class="form-control">
                    <option value="">Garçon</option>
                    <option value="">Fille</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Nom</label>
                <input type="text" name="nom" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Prénom</label>
                <input type="text" name="prenom" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <input accept="image/*" type='file' id="photoEnfantInput" />
            <img id="photoEnfant" src="#" alt="your image" />
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Mail principal</label>
                <input type="email" name="mail1" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Mail secondaire</label>
                <input type="email" name="mail2" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Date de naissance</label>
                <input type="date" name="ddn" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Groupe</label>
                <select name="groupe" id="" class="form-control">
                    <option value="">A</option>
                    <option value="">B</option>
                    <option value="">C</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="">Commentaire</label>
            <textarea class="form-control" name="comment" id="" style="width: 100%" rows="10"></textarea>
        </div>
    </div>


</form>
