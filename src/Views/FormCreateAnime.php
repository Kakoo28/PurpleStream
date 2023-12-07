<?php include_once ("include/Header.php"); ?>

    <main>
        <div class="header-content">
            <img class='logo' src="img/logo.png" alt="logo PurpleStream">
            <h1>Créer un anime</h1>
        </div>
        <div class="button-container">
            <form action="/anime/create/finish" method="post" enctype="multipart/form-data">
                <!-- Updated field names to match PHP script -->
                <input type="text" id="nom" name="anime_name" placeholder="Nom" required>
                <textarea id="desc" name="anime_description" rows="5" cols="33">Description de l'anime</textarea>
                <label for="boxInterets">Liste des langue</label>
                <select name="languageId">
                    <?php
                    foreach ($languages as $language) {
                        echo '<option value="' . $language->getLanguageId() . '">' . $language->getLanguageName() . '</option>';
                    }
                    ?>
                </select>
                <label for="boxInterets">Liste des categories</label>
                <?php
                foreach($categories as $category){
                   echo '
                       <input type="checkbox" name="categories[]" value="'.$category->getAnimeCategoryID().'">
                        <label for="categories[]">'.$category->getAnimeCategoryName().'</label>
                        ';

                 } ?>

                <input type="file" id="img-anime" name="anime_image" required>
                <button type="submit" id="btnLogin">Créer</button>
            </form>
        </div>
    </main>

<?php include_once ("include/Footer.php"); ?>