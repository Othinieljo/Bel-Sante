<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/templates/dashboardAcceuil/admin.css" />
    <link rel="shortcut icon" href="src/assets/logo.png" type="image/x-icon">
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
                <!-- <div>
                    <img src="src/assets/icons/boite.png" height="30px" alt="">
                    <span>Contacts</span>
                </div> -->
            </div>
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
                        <button class="openModal-1" onclick="openModal1()">Nouveau dossier +</button>
                    </div>
                    <input type="text" class="search_input" style="margin-top: 1rem;" id="searchInput" placeholder="Recherche...">
                    <div id="historique" class="historique">
                        <h3>Liste de tous les patients</h3>
                        <table id="patientTable">
                            <tr>
                                <th>Nom</th>
                                <th>Prenoms</th>
                                <th>Lieu de résidence</th>
                                <th>Contact</th>
                                <th>Statut dossier</th>
                                <th>Ouvrir le dossier</th>
                                <th>Actions</th>
                            </tr>
                            <?php foreach($dossiers as $dossier) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($dossier['NOM']); ?></td>
                                <td><?php echo htmlspecialchars($dossier['PRENOM']); ?></td>
                                <td><?php echo htmlspecialchars($dossier['HABITATION']); ?></td>
                                <td><?php echo htmlspecialchars($dossier['CONTACT']); ?></td>
                                <td>
                                    <div class="state">
                                        <?php if ($dossier['STATUT']) : ?>
                                        <img src="src/assets/icons/horloge.png" height="20px" width="20px" alt="">
                                        <span>Ouvert</span>
                                        <?php else : ?>
                                        <img src="src/assets/icons/verifier.png" height="20px" width="20px" alt="">
                                        <span>Fermé</span>
                                        <?php endif; ?>
                                    </div>
                                </td>

                                <td>
                                    <?php if ($dossier['STATUT']) : ?>
                                    <i>Dossier en cours...</i>
                                    <?php else : ?>
                                        <div>
                                        <form action='/Bel-Sante/newsc' method="post" style="display: flex;">
                                           <input type="hidden" name="numerodossier" value="<?php echo $dossier['NUMERODOSSIER'] ?>">
                                            <select name="specialiste" id="specialiste" style="width:120px;" required>
                                                <option value="">Specialiste</option>
                                                <?php
                                                // Supposons que $specialistes est un tableau associatif contenant les données des spécialistes
                                                foreach ($specialistes as $specialiste) {
                                                    $idSpecialiste = htmlspecialchars($specialiste['IDSPECIALISTE']);
                                                    $nomSpecialiste = htmlspecialchars($specialiste['NOMSPECIALISTE']);
                                                    $prenomSpecialiste = htmlspecialchars($specialiste['PRENOMSPECIALISTE']);
                                                    $specialiteSpecialiste = htmlspecialchars($specialiste['SPECIALITEDUSPECIALISTE']);
                                                    $gradeSpecialiste = htmlspecialchars($specialiste['GRADESPECIALISTE']);

                                                    // Générer l'option avec le nom, prénom et spécialité du spécialiste
                                                    echo "<option value='$idSpecialiste'>$prenomSpecialiste $nomSpecialiste ($specialiteSpecialiste - $gradeSpecialiste)</option>";
                                             }
                                                ?>
                                            </select>
                                        
                                        <input type="submit" value="Nouvelle consultation" style="border: none; padding: 10px; margin-left: 5px; height: 35px; border-radius: 10px; font-weight: 500;">
                                        </form>
                                        </div>
                                    <?php endif; ?>    
                                </td>
                                <td>
                                    <?php if (!$dossier['STATUT']) : ?>
                                    <a href="/Bel-Sante/printconsult?n=<?php echo $dossier['IDCONSULTATION']; ?>" style="color:blue;" ><u>Imprimer le recu de consulation</u></a><br>
                                    <?php if ($dossier['NECESSITER_EXISTS']) : ?>
                                    <a href="/Bel-Sante/printexam?n=<?php echo $dossier['IDCONSULTATION']; ?>" style="color:blue;"><u>Imprimer le recu d'examen</u></a>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            
                        </table>
                        <p id="null"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="modal-1" class="modal">
        <div class="modal-content">
            <div class="header">
                <h1>AJOUT D'UN NOUVEAU DOSSIER</h1>
                <span class="close" onclick="closeModal1()">&times;</span>
            </div>

            <form action="/Bel-Sante/dossier" method="post">
                <div class="formulaire">
                    <div class="">
                        <h3>Patient</h3>
                        <div>
                            <label for="nom">Nom <span class="oblige">*</span></label>
                            <input type="text" name="nom" required>
                        </div>
                        <div>
                            <label for="prenom">Prenoms <span class="oblige">*</span></label>
                            <input type="text" name="prenom" required>
                        </div>
                        <div>
                            <label for="datenaissance">Date De Naissance <span class="oblige">*</span></label>
                            <input type="date" name="datenaissance" required>
                        </div>
                        <div>
                            <label for="lieudeNaissance">Lieu De Naissance <span class="oblige">*</span></label>
                            <input type="text" name="lieunaissance" required>
                        </div>
                        <div>
                            <label for="sexe">Sexe</label><br>
                            F <input type="radio" value="F" name="sexe" required>
                            M <input type="radio" value="M" name="sexe" required>
                        </div>
                    </div>
                    
                    <div class="">
                        <h3>Information général</h3>
                        <div>
                            <label for="profession">Profession <span class="oblige">*</span></label>
                            <input type="text" name="profession" required>
                        </div>
                        <div>
                            <label for="contact">Contact <span class="oblige">*</span></label>
                            <input type="text" name="contact" required>
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input type="email" name="email">
                        </div>
                        <div>
                            <label for="habitation">Habitation <span class="oblige">*</span></label>
                            <input type="text" name="habitation" required>
                        </div>
                    </div>
                    
                    <div class="">
                        <h3>Informations médical</h3>
                        <div>
                            <label for="groupesanguin">Groupe Sanguin</label><br>
                            <select name="groupesanguin" id="">
                                <option value="">Choisir</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div>
                        <div>
                            <label for="antecedants">Antécédants</label><br>
                            <textarea name="antecedants" style="height: 135px;" id=""></textarea>
                        </div>
                        
                        <div>
                            <label for="specialiste">Spécialiste <span class="oblige">*</span></label><br>
                            <select name="specialiste" id="specialiste" required>
                                <option value="">Selectionner</option>
                                <?php
                                // Supposons que $specialistes est un tableau associatif contenant les données des spécialistes
                                foreach ($specialistes as $specialiste) {
                                    $idSpecialiste = htmlspecialchars($specialiste['IDSPECIALISTE']);
                                    $nomSpecialiste = htmlspecialchars($specialiste['NOMSPECIALISTE']);
                                    $prenomSpecialiste = htmlspecialchars($specialiste['PRENOMSPECIALISTE']);
                                    $specialiteSpecialiste = htmlspecialchars($specialiste['SPECIALITEDUSPECIALISTE']);
                                    $gradeSpecialiste = htmlspecialchars($specialiste['GRADESPECIALISTE']);

                                    // Générer l'option avec le nom, prénom et spécialité du spécialiste
                                    echo "<option value='$idSpecialiste'>$prenomSpecialiste $nomSpecialiste ($specialiteSpecialiste - $gradeSpecialiste)</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="buttonForm">
                    <div></div>
                    <div>
                        <button class="submitButton" style="background: red;"><a href="/Bel-Sante/admin" style="color: white;">Annuler</a></button>
                        <button type="submit" style="background: rgb(2, 146, 2);">Enregistrer</button>
                    </div>
                </div>
                
            </form>
        </div>
        <h2 class="h2-temporaire"><?php echo htmlspecialchars($dossier_status); ?></h2>
    </section>

    <script type="text/javascript">
        function openModal1() {
            document.getElementById('modal-1').style.display = 'block';
        }

        function closeModal1() {
            document.getElementById('modal-1').style.display = 'none';
        }
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