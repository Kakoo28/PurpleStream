<?php include_once ("include/Header.php"); ?>
    <main>
        <form action="/admin/allAnimes" method="post">
            <div class="input__container">
                <label for="searchAnime">Rechercher un anime</label>
                <input type="text" name="searchAnime" id="searchAnime">
            </div>
        </form>
    </main>
<?php include_once ("include/Footer.php"); ?>