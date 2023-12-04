<?php include_once ("include/Header.php"); ?>

<main id="background">
    <div class="header-content">
        <img class='logo' src="img/logo.png" alt="logo PurpleStream">
        <h1>Connectez-vous à votre compte</h1>
    </div>
    <div class="button-container">
        <form action="/process-login" method="post">
            <input type="text" id="username" name="username" placeholder="Email" required>
            <input type="password" id="password" name="password" placeholder="Mot de passe" required>
            <button type="submit" id="btnLogin">Se connecter</button>
        </form>
        <p>Vous n'avez pas de compte? <a href="/">Créer un compte</a></p>
    </div>
</main>

<?php include_once ("include/Footer.php"); ?>