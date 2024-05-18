<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/templates/specialisteDashboard/admin.css">
    <link rel="shortcut icon" href="src/assets/logo.png" type="image/x-icon">
    <title>Spécialiste | bel'Santé</title>
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
                    <a href="#"><u>Mes Patients</u></a>
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
                        <img src="src/assets/pp/IMG_6596.jpg" height="50px" width="50px" style="border-radius: 50%; cursor: pointer;" style="border-radius: 50%;" title="Connecté">
                        <p class="name"><b>BAHILI</b><br>Esli Ariel</p>
                    </div>
                    <div class="deconnection">
                        <a href="/Bel-Sante/logout">
                        <img src="src/assets/icons/se-deconnecter.png" height="50px" width="50px" style="border-radius: 50%; cursor: pointer;" style="border-radius: 50%;" title="Se déconnecter">
                        </a>
                    </div>
                </div>
            </div>
            <div class="dim">
                <input type="text" class="search_input" style="margin-top: 1rem;" id="searchInput" placeholder="Recherche...">
                    <div id="historique" class="historique">
                        <h3>Liste de tous les patients</h3>
                        <table id="patientTable">
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
                                        <span>Ouvert</span>
                                        <?php else : ?>
                                        <img src="src/assets/icons/verifier.png" height="20px" width="20px" alt="">
                                        <span>Fermé</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><a href="/Bel-Sante/consult?n=<?php echo $dossier['NUMERODOSSIER']; ?>">Commencer la consultation</a></td>
                                    </tr>
                            <?php endforeach; ?>
                        </table>
                        <p id="null"></p>
                    </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        const searchInput = document.getElementById('searchInput');
        const patientTable = document.getElementById('patientTable');
        const noMatchMessage = document.getElementById('null');

        function filterPatients() {
            const query = searchInput.value.trim().toLowerCase();
            const rows = patientTable.getElementsByTagName('tr');
            let matchFound = false;

            for (let i = 0; i < rows.length; i++) {
                const contactCell = rows[i].getElementsByTagName('td')[3];
                if (contactCell) {
                    const contact = contactCell.textContent.trim();
                    const phoneNumber = contact.replace(/\D/g, '');
                    const rowMatches = phoneNumber.includes(query);
                    rows[i].style.display = rowMatches ? '' : 'none';
                    if (rowMatches) {
                        matchFound = true;
                    }
                }
            }

            if (!matchFound) {
                noMatchMessage.textContent = "Aucun patient ne correspond au numéro entré";
            } else {
                noMatchMessage.textContent = "";
            }
        }

        searchInput.addEventListener('input', filterPatients);
    </script>
</body>
</html>