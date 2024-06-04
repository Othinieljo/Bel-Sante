<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/templates/dashboardAcceuil/admin.css">
    <link rel="shortcut icon" href="src/assets/logo.png" type="image/x-icon">
    <title>Impression Consultation | bel'Santé</title>
    <style>
      @media print {
              @page {
                  margin: 0; /* Supprimer les marges par défaut */
              }
              body {
                  margin: 1.6cm; /* Ajouter une marge interne */
              }
              /* Cacher les informations supplémentaires */
              body::before, body::after {
                  display: none !important;
              }
              /* Optionnel: Cacher d'autres éléments non désirés pendant l'impression */
              .sidebar, .navbar, .deconnection, .user, .buttons {
                  display: none !important;
              }
          }

        /* #recu{
          background-color: white;
          padding: 10px;
          margin-top: 10px;
        } */
        .logorecu{
          width: 70px;
          height: 70px;
        }
        .cachet{
          display: flex;
          justify-content: space-between;
          margin-top: 5rem;
        }
        .cachet img{
          width: 120px;
          height: 120px;
        }
        .info{
          background-color: rgba(128, 128, 128, 0.116);
          border: 1px solid gray;
          text-justify: distribute;
        }
        h3{
          margin-top: 10px;
        }
    </style>
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
                    <a href="/Bel-Sante/admin"><u>Dashbord</u></a>
                </div>
                <div>
                    <img src="src/assets/icons/patient.png" height="30px" alt="">
                    <a href="/Bel-Sante/patient">Patients</a>
                </div>
                <!-- <div>
                    <img src="src/assets/icons/boite.png" height="30px" alt="">
                    <span>Contacts</span>
                </div> -->
            </div>
        </div>
        <div class="dashbord">
            <div class="navbar">
                <div class="search">
                </div>
                <div class="user">
                    <div class="profil">
                    
                        <img src="src/assets/logo.png" height="50px" width="50px" style="border-radius: 50%; cursor: pointer;" style="border-radius: 50%;" title="Connecté">
                        <p class="name"><b>ACCUEIL</b><br>dashbord</p>
                    </div>
                    <div class="deconnection">
                        <a href="/Bel-Sante/logout">
                        <img src="src/assets/icons/se-deconnecter.png" height="50px" width="50px" style="border-radius: 50%; cursor: pointer;" style="border-radius: 50%;" title="Se déconnecter">
                        </a>
                    </div>
                </div>
            </div>
            <div class="dim">
                <div class="buttons">
                    <button class="openModal-1" onclick="printRecu()">Imprimer le recu</button>
                </div>
                <div class="informations">                    
                    <div id="recu" class="historique">
                    <div>
                      <img src="src/assets/logo.png" alt="" class="logorecu">
                    </div>
                    <h2 style="text-align: center;"><u>Reçu de l'examen</u></h2>
                    <div>
                      <p><u><b>Patient :</b></u><?php echo $result['NOM']. " ".$result['PRENOM'] ?></p>
                    </div>
                    <div>
                      <p><u><b>Date de l'examen :</b></u> <?php echo $result['DATEEXAMEN']?> </p>
                    </div>
                    <!-- <div>
                      <p><u><b>Service :</b></u> Cardiologie</p>
                    </div> -->
                    <div>
                      <p><u><b>Examen :</b></u> <?php echo $result['LIBELLEEXAMCOMPL']?> </p>
                    </div>
                    <h3>Causes</h3>
                    <div class="info">
                    <?php echo $result['CAUSEEXAMEN']?>
                      
                    </div>
                    <h3>Résultats</h3>
                    <div class="info">
                    <?php echo $result['RESULTATS']?>
                    </div>
                    <div class="cachet">
                      <div></div>
                      <img src="src/assets/cachet.jpeg" alt="">
                    </div>
                </div>
            </div>
    </section>

    <script>
      function printRecu() {
        window.print()
      }
    </script>
</body>
</html>