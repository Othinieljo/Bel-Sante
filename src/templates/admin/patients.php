<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/templates/admin/admin.css" />
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
                    <img src="src/assets/icons/dash.png" height="30px" alt="" />
                    <a href="/Bel-Sante/admin">Dashbord</a>
                </div>
                <div>
                    <img src="src/assets/icons/patient.png" height="30px" alt="" />
                    <a href="#"><u>Patients</u></a>
                </div>
                <div>
                    <img src="src/assets/icons/docteur.png" height="30px" alt="" />
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
                        <a href="#notifications"><img src="src/assets/icons/notification.png" height="30px" alt="" /></a>
                    </div>
                    <div class="profil">
                        <img src=<?php echo $userAdmin['photourl']?> height="50px" width="50px" style="border-radius: 50%; cursor: pointer" title="Connecté" />
                        <p class="name">
                        <b>ADMINISTRATEUR</b>
                        </p>
                    </div>
                    <div class="deconnection">
                        <a href="/Bel-Sante/logout">
                        <img src="src/assets/icons/se-deconnecter.png" height="50px" width="50px" style="border-radius: 50%; cursor: pointer" style="border-radius: 50%" title="Se déconnecter" />
                        </a>
                    </div>
                </div>
            </div>
            <div class="dim">
                    <input type="text" class="search_input" style="margin-top: 1rem;" id="searchInput" placeholder="Recherche...">
                    <div id="notifications" class="notifications">
                        <h3>Liste de tous les patients</h3>
                        <table id="patientTable">
                            <tr>
                                <th>Nom</th>
                                <th>Prenoms</th>
                                <th>Lieu de résidence</th>
                                <th>Contact</th>
                                <th>Statut dossier</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>BAHILI</td>
                                <td>Esli Ariel</td>
                                <td>Treichville</td>
                                <td>0777409491</td>
                                <td class="state">
                                    <img src="src/assets/icons/horloge.png" height="20px" width="20px" alt="">
                                    <span>Ouvert</span>
                                </td>
                                <td><a href="dossier.php" title="Voir" ><img src="src/assets/icons/visuel.png" height="30px" width="30px" alt=""></a></td>
                            </tr>
                        </table>
                        <p id="null"></p>
                    </div>
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