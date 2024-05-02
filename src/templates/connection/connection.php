<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/templates/connection/connection.css">
    <title>Bienvenue sur votre page de connexion | bel'Santé</title>
</head>
<body>
    <section class="main">
        <div class="right"></div>
        <div class="left">
            <form action="index.php?action=login" method="post">
                <h1 class="gray" style="font-size: 2rem;">Bienvenue</h1>
                <p>Veuillez vous connecter à votre page d'Administration</p>
                <hr class="gray">
                <div>
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" name="username">
                </div>
                <div>
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password">
                </div>
                <button type="submit" name="login">Se connecter</button>
            </form>
        </div>
    </section>
</body>
</html>