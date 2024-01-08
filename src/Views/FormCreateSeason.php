<?php include_once ("include/Header.php"); ?>
    <main>
        <form action="/anime/process-create-season/<?php echo $_GET["id"] ?>" method="post" enctype="multipart/form-data">
            <div class="input__container">
                <label for="season__name">Veuillez entrez un nom de saison</label>
                <input type="text" class="season__name" name="season__name">
            </div>
            <div class="input__container">
                <label for="season__desription">Veuillez entrez une description</label>
                <textarea name="season__desription" id="season__desription" cols="30" rows="10"></textarea>
            </div>
            <div class="input__container">
                <label for="season__image">Veuillez entrez une image</label>
                <input type="file" name="season__image" id="season__image">
            </div>
            <input type="submit" value="Envoyer">
        </form>
    </main>
<?php include_once ("include/Footer.php"); ?>