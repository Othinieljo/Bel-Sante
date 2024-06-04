<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/templates/admin/admin.css">
    <link rel="shortcut icon" href="src/assets/logo.png" type="image/x-icon">
    <title>ADMINISTRATEUR | bel'Santé</title>
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
                    <img src="src/assets/icons/dash.png" height="30px" alt="Dashboard Icon" />
                    <a href="/Bel-Sante/admin">Dashboard</a>
                </div>
                <div>
                    <img src="src/assets/icons/patient.png" height="30px" alt="Patients Icon" />
                    <a href="/Bel-Sante/patient"><u>Patients</u></a>
                </div>
                <div>
                    <img src="src/assets/icons/docteur.png" height="30px" alt="Docteur Icon" />
                    <a href="/Bel-Sante/specialistes">Spécialistes</a>
                </div>
            </div>
        </div>
        <div class="dashbord">
            <div class="navbar">
                <div class="search">
                </div>
                <div class="user">
                    <div class="notif" style="cursor: pointer" title="10 Nouvelles notifications">
                        <div class="news">10</div>
                        <a href="#notifications"><img src="src/assets/icons/notification.png" height="30px" alt="Notification Icon" /></a>
                    </div>
                    <div class="profil">
                        <img src="src/assets/logo.png" height="50px" width="50px" style="border-radius: 50%; cursor: pointer" title="Connecté" />
                        <p class="name">
                            <b>ADMINISTRATEUR</b>
                        </p>
                    </div>
                    <div class="deconnection">
                        <a href="/Bel-Sante/logout">
                            <img src="src/assets/icons/se-deconnecter.png" height="50px" width="50px" style="border-radius: 50%; cursor: pointer" title="Se déconnecter" />
                        </a>
                    </div>
                </div>
            </div>
            <div style="display: flex; flex-direction: column; justify-content: center; padding: 10px; align-items: center; width: max-content;">
                <img src="src/assets/icons/dossier.png" width="70px" alt="Dossier Icon">
                <b>Dossier médical n°<?php echo htmlspecialchars($numerodossier); ?></b>
            </div>
            
            <div class="dim dossier">
                <h3 style="cursor: pointer; margin-bottom: 1rem; width: max-content;"><u>Carnet numérique du patient</u></h3>
                
                <div id="informationDossier">
                    <table>
                        <tr>
                            <td colspan="9"><b>Information sur le patient</b></td>
                        </tr>
                        <tr style="font-weight: 500;">
                            <td>Nom</td>
                            <td>Prénoms</td>
                            <td>Sexe</td>
                            <td>Date de naissance</td>
                            <td>Lieu de naissance</td>
                            <td>Lieu d'habitation</td>
                            <td>Profession</td>
                            <td>Contact</td>
                            <td>Email</td>
                        </tr>
                        <?php foreach ($results as $result) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($result['NOM']); ?></td>
                            <td><?php echo htmlspecialchars($result['PRENOM']); ?></td>
                            <td><?php echo htmlspecialchars($result['SEXE']); ?></td>
                            <td><?php echo htmlspecialchars($result['DATENAISSANCE']); ?></td>
                            <td><?php echo htmlspecialchars($result['LIEUNAISSANCE']); ?></td>
                            <td><?php echo htmlspecialchars($result['HABITATION']); ?></td>
                            <td><?php echo htmlspecialchars($result['PROFESSION']); ?></td>
                            <td><?php echo htmlspecialchars($result['CONTACT']); ?></td>
                            <td><?php echo htmlspecialchars($result['EMAIL']); ?></td>
                        </tr>
                        <tr>
                            <td colspan="9"><b>Dossier</b></td>
                        </tr>
                        <tr style="font-weight: 500;">
                            <td colspan="2">Groupe sanguin</td>
                            <td colspan="7">Antécédents</td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo htmlspecialchars($result['GROUPESANGUIN']); ?></td>
                            <td colspan="7"><?php echo htmlspecialchars($result['ANTECEDANTS']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <tr>
                            <td colspan="9"><b>Historique de consultation</b></td>
                        </tr>
                        
                        
                        <tr style="font-weight: 500;">
                            <td>Date</td>
                            <td>Acte médical</td>
                            <td>Constantes</td>
                            <td colspan="2">Observation</td>
                            <td colspan="2">Diagnostic</td>
                            <td colspan="2">Prescription</td>
                        </tr>
                        <!-- Boucle pour afficher les consultations effectuées par le patient -->
                        <?php foreach ($consultations as $consultation) : ?>
                        <tr>
                            <td><?php echo date('d/m/Y', strtotime($consultation['DATECONSULTATION'])); ?></td>
                            <td><?php echo htmlspecialchars($consultation['ACTEMEDICAL']); ?></td>
                            <td><?php echo htmlspecialchars($consultation['CONSTANTES']); ?></td>
                            <td colspan="2"><?php echo htmlspecialchars($consultation['OBSERVATION']); ?></td>
                            <td colspan="2"><?php echo htmlspecialchars($consultation['DIAGNOSTIC']); ?></td>
                            <td colspan="2"><?php echo htmlspecialchars($consultation['PRESCRIPTION']); ?></td>
                        </tr>
                        
                        <?php if (!empty($consultation['examen'])) : ?>
                        <tr>
                            <td colspan="9"><b>Historique d'examen</b></td>
                        </tr>
                        <tr style="font-weight: 500;">
                            <td>Date</td>
                            <td colspan="3">Causes</td>
                            <td colspan="2">Examen</td>
                            <td colspan="3">Résultats</td>
                        </tr>
                        <!-- Boucle pour afficher les examens effectués par le patient -->
                        <?php foreach ($consultation['examen'] as $examen) : ?>
                        
                        <tr>
                            <td><?php echo date('d/m/Y', strtotime($examen['DATE'])); ?></td>
                            <td colspan="3"><?php echo htmlspecialchars($examen['CAUSES']); ?></td>
                            <td colspan="2"><?php echo htmlspecialchars($examen['EXAMEN']); ?></td>
                            <td colspan="3"><?php echo htmlspecialchars($examen['RESULTATS']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        <?php endforeach; ?>

                    </table>
                </div>  
            </div>
        </div>
    </section>
</body>
</html>
