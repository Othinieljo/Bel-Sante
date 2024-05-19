<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/templates/connection/connection.css">
    <title>Bienvenue sur votre page de connexion | bel'Santé</title>
</head>
<body>
    <div class="loader-wrapper">
        <div class="back"></div>
        <div class="heart"></div>
    </div>

    <section class="main">
        <div class="right"></div>
        <div class="left">
            <form action="/Bel-Sante/connect" method="post">
                <h1 id="texteAnimé" class="gray" style="font-size: 2rem;"></h1>
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
                <?php
                if (isset($message) && !empty($message)) {
                    echo '
                    <p style="background: #FF4747; color: white; padding: 10px; border-radius: 5px; font-weight: 700">' . htmlspecialchars($message) . '</p>
                    ';
                }
                ?>
                <button type="submit" name="login">Se connecter</button>
            </form>
        </div>
    </section>

    <script>
        setTimeout(() => {
            document.querySelector('.loader-wrapper').style.display = 'none';
            
            const texte = "Bienvenue";
            const delai = 300;

            const afficherTexteLettreParLettre = (texte, delai) => {
                let index = 0;
                const afficherLettre = () => {
                    document.getElementById('texteAnimé').textContent += texte[index];
                    index++;
                    if (index < texte.length) {
                        setTimeout(afficherLettre, delai);
                    }
                };
                afficherLettre();
            };

            afficherTexteLettreParLettre(texte, delai);
        }, 3000);
    </script>
</body>
</html>