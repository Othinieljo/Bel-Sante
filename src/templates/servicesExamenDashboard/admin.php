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
                        <img src="src/assets/icons/user.png" height="50px" width="50px" style="border-radius: 50%; cursor: pointer;" style="border-radius: 50%;" title="Connecté">
                        <p class="name"><b>RADIOLOGIE</b><br>dashbord</p>
                    </div>
                    <div class="deconnection">
                        <img src="src/assets/icons/se-deconnecter.png" height="50px" width="50px" style="border-radius: 50%; cursor: pointer;" style="border-radius: 50%;" title="Se déconnecter">
                    </div>
                </div>
            </div>
            <div class="dim">
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
                        <h3>Mes patients</h3>
                        <table style="border-spacing: 5rem;">
                                <tr>
                                    <th>Nom</th>
                                    <th>Prenoms</th>
                                    <th>Lieu de résidence</th>
                                    <th>Contact</th>
                                    <th>Heure</th>
                                    <th>Date</th>
                                    <th>Statut dossier</th>
                                    <th>Action</th>
                                </tr>
                                <?php foreach ($dossiers as $dossier) : ?>
                                    <tr>
                                    <td><?php echo htmlspecialchars($dossier['NOM']); ?></td>
                                    <td><?php echo htmlspecialchars($dossier['PRENOM']); ?></td>
                                    <td><?php echo htmlspecialchars($dossier['LIEUNAISSANCE']); ?></td>
                                    <td><?php echo htmlspecialchars($dossier['CONTACT']); ?></td>
                                    <td><?php echo date('H:i', strtotime($dossier['HEURECONSULTATION'])); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($dossier['DATECONSULTATION'])); ?></td>
                                    <td class="state">
                                        <?php if ($dossier['STATUT']) : ?>
                                        <img src="src/assets/icons/horloge.png" height="20px" width="20px" alt="">
                                        <?php else : ?>
                                        <img src="src/assets/icons/verifier.png" height="20px" width="20px" alt="">
                                        <?php endif; ?>

                                    </td>
                                    <td><a href="/Bel-Sante/consult?n=<?php echo $dossier['NUMERODOSSIER']; ?>">Commencer la consultation</a></td>
                                    </tr>
                                <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="modal-1" class="modal">
        <div class="modal-content">
            <div class="header">
                <h1>AJOUT D'UN PATIENT</h1>
                <span class="close" onclick="closeModal1()">&times;</span>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
        });
        });
    </script>
</body>
</html>