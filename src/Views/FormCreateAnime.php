<?php include_once ("include/Header.php"); ?>
    <main>
        <form action="/anime/process-create" method="post" enctype="multipart/form-data">
            <div class="input__container">
                <label for="anime__name">Veuillez entrez un nom</label>
                <input type="text" class="anime__name" name="anime__name">
            </div>
            <div class="input__container">
                <label for="anime__description">Veuillez entrez une description</label>
                <textarea name="anime__description" id="anime__description" cols="30" rows="10"></textarea>
            </div>
            <div class="input__container">
                <label for="anime__image">Veuillez entrez une image</label>
                <input type="file" name="anime__image" id="anime__image">
            </div>
            <div class="input__container">
                <label for="anime__select-language">Veuillez selectionez ça langue</label>
                <select name="anime__select-language" id="anime__select-language">
                    <?php
                        foreach($languages as $language)
                        {
                            echo "<option value='" . $language->getLanguageId(). "'>" . $language->getLanguageName() . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="input__container">
                <label for="anime__select-categories">Veuillez selectionez de(s) categorie(s)</label>
                <?php foreach($categories as $categorie) { ?>
                    <input type='checkbox' name='anime__select-categories[]' id='anime__select-categories-<?php echo $categorie->getAnimeCategoryID(); ?>' value='<?php echo $categorie->getAnimeCategoryID(); ?>'>
                    <label for='anime__select-categories-<?php echo $categorie->getAnimeCategoryID(); ?>'><?php echo $categorie->getAnimeCategoryName(); ?></label>
                <?php } ?>

            </div>
            <input type="submit" value="Envoyer">
        </form>
    </main>
<?php include_once ("include/Footer.php"); ?>