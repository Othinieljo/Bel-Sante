<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/templates/servicesExamenDashboard/admin.css">
    <link rel="shortcut icon" href="src/assets/logo.png" type="image/x-icon">
    <title>Service Examen | bel'Santé</title>
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
                    <a href="#"><u>Dashbord</u></a>
                </div>
                <div>
                    <img src="src/assets/icons/patient.png" height="30px" alt="">
                    <a href="/Bel-Sante/patient">Patients</a>
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
                        <img src=src=<?php echo $userServ['photourl']?>  height="50px" width="50px" style="border-radius: 50%; cursor: pointer;" style="border-radius: 50%;" title="Connecté">
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
                <div class="buttons">
                    <button class="modal-4" onclick="openModal4()">
                        Examen +
                    </button>
                </div>
                <div class="informations">
                    <div class="recaps">
                        <div class="recap">
                            <div>
                                <span style="font-size: 20px; color: gray;">Rendez-vous <br>d'aujourd'hui</span><br><br>
                                <b style="font-size: 40px;">20</b>
                            </div>
                            <img src="src/assets/icons/rendez-vous.png" height="85px" alt="">
                        </div>
                        <div class="recap">
                            <div>
                                <span style="font-size: 20px; color: gray;">Patients ajoutés<br>aujourd'hui</span><br><br>
                                <b style="font-size: 40px;"> <?php echo $nbres_consultation ?> </b>
                            </div>
                            <img src="src/assets/icons/patient1.png" height="85px" alt="">
                        </div>
                        <div class="recap">
                            <div>
                                <span style="font-size: 20px; color: gray;">Mes consultations <br>d'aujourd'hui</span><br><br>
                                <b style="font-size: 40px;"><?php echo $nbres_consultation ?></b>
                            </div>
                            <img src="src/assets/icons/consultation.png" height="85px" alt="">
                        </div>
                    </div>  
                    
                    <div class="notifications">
                        <h3>Notifications</h3>
                        <div>Nouveau patient ajouté</div>
                    </div>
    
                    <div class="historique">
                        <h3>Ajout réçent</h3>
                        <table style="border-spacing: 5rem;">
                                <tr>
                                    <th>Date</th>
                                    <th>Heure</th>
                                    <th>Nom</th>
                                    <th>Prenoms</th>
                                    <th>Lieu de résidence</th>
                                    <th>Contact</th>
                                    <th>Statut dossier</th>
                                    <th>Action</th>
                                </tr>
                                <?php if ($dossiers) : ?>
                                <?php for ($i = 0; $i < min(10, count($dossiers)); $i++) : ?>
                                <?php $dossier = $dossiers[$i]; ?>
                                    <tr>
                                    <td><?php echo date('d/m/Y', strtotime($dossier['DATECONSULTATION'])); ?></td>
                                    <td><?php echo date('H:i', strtotime($dossier['HEURECONSULTATION'])); ?></td>
                                    <td><?php echo htmlspecialchars($dossier['NOM']); ?></td>
                                    <td><?php echo htmlspecialchars($dossier['PRENOM']); ?></td>
                                    <td><?php echo htmlspecialchars($dossier['LIEUNAISSANCE']); ?></td>
                                    <td><?php echo htmlspecialchars($dossier['CONTACT']); ?></td>
                                    <td class="state">
                                        <?php if ($dossier['STATUT']) : ?>
                                        <img src="src/assets/icons/horloge.png" height="20px" width="20px" alt="">
                                        <?php else : ?>
                                        <img src="src/assets/icons/verifier.png" height="20px" width="20px" alt="">
                                        <?php endif; ?>

                                    </td>
                                    <td><a href="/Bel-Sante/consult?n=<?php echo $dossier['NUMERODOSSIER']; ?>">Commencer la consultation</a></td>
                                    </tr>
                                <?php endfor; ?>
                                <?php endif; ?>
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td><a href="/Bel-Sante/patient" style="color: blue;"><u>+ Voir plus</u></a></td>
                                </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="modal-4" class="modal">
        <div class="modal-content">
            <div class="header">
                <h1>AJOUTER UN EXAMEN</h1>
                <span class="close" onclick="closeModal4()">&times;</span>
            </div>

            <form action="" method="post">
                <div>
                    <div class="exam">
                        <label for="exam">Libellé de l'examen <span class="oblige">*</span></label>
                        <input type="text" name="exam" required>
                    </div>
                    <div>
                        <button class="submitButton" href="/Bel-Sante/admin">
                            <a href="/Bel-Sante/admin" style="color: red"><u>Annuler</u></a>
                        </button>
                        <button class="submitButton" type="submit" style="color: green;">
                            <u>Ajouter</u>
                        </button>
                    </div>
                </div>
            </form>
        </div>
  </section>
  <script>
    function openModal4() {
      document.getElementById("modal-4").style.display = "flex";
    }

    function closeModal4() {
      document.getElementById("modal-4").style.display = "none";
    }
  </script>
</body>
</html>