<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/templates/servicesExamenDashboard/admin.css">
    <title>Accueil | bel'Santé</title>
</head>
<body>
    <section class="main">
        <div class="sidebar">
            <div class="logo">
                <div class="img"></div>
                <span>Bel'Santé</span>
            </div>
            <div class="onglet">
                <div style="cursor: pointer;">
                    <img src="src/assets/icons/dash.png" height="30px" alt="">
                    <a href="/Bel-Sante/admin">Dashbord</a>
                </div>
                <div>
                    <img src="src/assets/icons/patient.png" height="30px" alt="">
                    <a href="#"><u>Patients</u></a>
                </div>
            </div>
        </div>
        <div class="dashbord">
            <div class="navbar">
                <div class="search">
                </div>
                <div class="user">
                    <div class="notif" style="cursor: pointer;" title="10 Nouvelles notifications">
                        <div class="news">10</div>
                        <a href="#notifications"><img src="src/assets/icons/notification.png" height="30px" alt=""></a>
                    </div>
                    <div class="profil">
                        <img src="src/assets/icons/user.png" height="50px" width="50px" style="border-radius: 50%; cursor: pointer;" style="border-radius: 50%;" title="Connecté">
                        <p class="name"><b>RADIOLOGIE</b><br>dashbord</p>
                    </div>
                    <div class="deconnection">
                        <a href="/Bel-Sante/logout">
                        <img src="src/assets/icons/se-deconnecter.png" height="50px" width="50px" style="border-radius: 50%; cursor: pointer;" style="border-radius: 50%;" title="Se déconnecter">
                        </a>
                    </div>
                </div>
            </div>
            <div class="dim">
                <input type="text" style="margin-top: 1rem;" class="search_input" placeholder="Recherche...">
                    <div class="historique">
                        <h3>Liste de tous les patients</h3>
                        <table>
                            <tr>
                                <th>Nom</th>
                                <th>Prenoms</th>
                                <th>Lieu de résidence</th>
                                <th>Contact</th>
                                <th>Libellé Exammen</th>
                            </tr>
                            <tr>
                                <td>BAHILI</td>
                                <td>Esli Ariel</td>
                                <td>Treichville</td>
                                <td>0777409491</td>
                                <td>
                                    <form action="">
                                        <textarea name="" id=""></textarea><br>
                                        <input type="button" value="Envoyer">
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>