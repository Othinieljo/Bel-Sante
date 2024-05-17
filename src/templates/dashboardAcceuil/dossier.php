<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/templates/dashboardAcceuil/admin.css">
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
                    <a href="src/templates/dashboardAcceuil/admin.php">Dashbord</a>
                </div>
                <div>
                    <img src="src/assets/icons/patient.png" height="30px" alt="">
                    <a href="src/templates/dashboardAcceuil/patients.php"><u>Patients</u></a>
                </div>
                <div>
                    <img src="src/assets/icons/boite.png" height="30px" alt="">
                    <span>Contacts</span>
                </div>

            </div>
        </div>
        <div class="dashbord">
            <div class="navbar">
                <div class="search">
                </div>
                <div class="user">
                    <div class="profil">
                        <img src="src/assets/icons/user.png" height="50px" width="50px" style="border-radius: 50%; cursor: pointer;" style="border-radius: 50%;" title="Connecté">
                        <p class="name"><b>RADIOLOGIE</b><br>dashbord</p>
                    </div>
                    <div class="deconnection">
                        <img src="src/assets/icons/se-deconnecter.png" height="50px" width="50px" style="border-radius: 50%; cursor: pointer;" style="border-radius: 50%;" title="Se déconnecter">
                    </div>
                </div>
            </div>
            <div style="display: flex; flex-direction: column; justify-content: center; padding: 10px; align-items: center; width: max-content;">
                <img src="src/assets/icons/dossier.png" width="70px" alt="">
                <b>Dossier médical n°14</b>
            </div>
            
            <div class="dim dossier">
                <div id="consulation" style="cursor: pointer;" onclick="showConsultation()"><u>Nouvelle consultation</u></div>
                <div id="consultationForm">
                    <form action="" style="display: flex; align-items: center;">
                        <div>
                            <label for="specialiste">Spécialiste</label><br>
                            <select name="specialiste" id="">
                                <option value="">Selectionner</option>
                                <option value="ID1">Ariel BAHILI (Neurologue)</option>
                                <option value="ID2">SOMAPKO Monan(Gynécologue)</option>
                            </select>
                        </div>
                        <input type="button" value="Lancer" style="border: none; padding: 10px; margin-left: 5px; height: 35px; border-radius: 10px; font-weight: 500;">
                    </form>
                </div>    
                <div class="informationDossier">
                    <h1>Cette partie pour les informations sur le dossier medical du patient</h1>
                </div>        
            </div>
        </div>
    </section>
    <script>
        function showConsultation() {
            if(document.getElementById('consultationForm').style.display == 'none'){
                document.getElementById('consultationForm').style.display = 'block';
            }else{
                document.getElementById('consultationForm').style.display = 'none';
            }
        }
    </script>
</body>
</html>