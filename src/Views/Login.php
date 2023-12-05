<?php include_once ("include/Header.php"); ?>
<link rel="stylesheet" href="/css/pages/user-form.css">

<main class="main main--f-end main--background">
    <div class="container header-container">
        <img class='logo' src="img/logo.png" alt="logo PurpleStream">
        <h2 class="header__title">Connectez-vous à votre compte</h2>
    </div>
    <div class="container form__container">
        <form action="/process-login" method="post" class="form login-form">
            <input type="email" id="username" name="username" placeholder="Email" required>
            <input type="password" id="password" name="password" placeholder="Mot de passe" required>
            <button type="submit" class="button submit-button">Se connecter</button>
        </form>
        <a href="/">Vous n'avez pas de compte? <span>Créer un compte</span></a>
    </div>
</main>

<?php include_once ("include/Footer.php"); ?>