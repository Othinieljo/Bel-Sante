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
                    <a href="#"><u>Dashbord</u></a>
                </div>
                <div>
                    <img src="src/assets/icons/patient.png" height="30px" alt="">
                    <a href="/Bel-Sante/patient">Patients</a>
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
                    <button><a href="/Bel-Sante/patient" style="color: white;">Ouvrir un dossier</a></button>
                </div>
                <div class="informations">
                    <div class="recaps">
                        <div class="recap">
                            <div>
                                <span style="font-size: 20px; color: gray;">Rendez-vous <br>d'aujourd'hui</span><br><br>
                                <b style="font-size: 40px;"><?php echo $nbres_rdv ?></b>
                            </div>
                            <img src="src/assets/icons/rendez-vous.png" height="85px" alt="">
                        </div>
                        <div class="recap">
                            <div>
                                <span style="font-size: 20px; color: gray;">Patients ajoutés<br>aujourd'hui</span><br><br>
                                <b style="font-size: 40px;"><?php echo $new_d ?></b>
                            </div>
                            <img src="src/assets/icons/patient1.png" height="85px" alt="">
                        </div>
                        <div class="recap">
                            <div>
                                <span style="font-size: 20px; color: gray;">Consultations <br>d'aujourd'hui</span><br><br>
                                <b style="font-size: 40px;"><?php echo $nbres_c ?></b>
                            </div>
                            <img src="src/assets/icons/consultation.png" height="85px" alt="">
                        </div>
                    </div>  
                    
                    <!-- <div class="notifications">
                        <h3>Notifications</h3>
                        <div>Alerte nouveau rendez-vous ajouté</div>
                        <div>Alerte nouveau rendez-vous ajouté</div>
                        <div>Alerte nouveau rendez-vous ajouté</div>
                    </div> -->
    
                    <div class="historique">
                        <h3>Liste de tous les patients</h3>
                        <table>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prenoms</th>
                                    <th>Lieu de résidence</th>
                                    <th>Contact</th>
                                    <th>Heure</th>
                                    <th>Date</th>
                                    <th>Statut dossier</th>
                                    
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
                <h1>AJOUT D'UN NOUVEAU DOSSIER</h1>
                <span class="close" onclick="closeModal1()">&times;</span>
            </div>

            <form action="/Bel-Sante/dossier" method="post">
                <div class="formulaire">
                    <div class="">
                        <h3>Patient</h3>
                        <div>
                            <label for="nom">Nom</label>
                            <input type="text" name="nom">
                        </div>
                        <div>
                            <label for="prenom">Prenoms</label>
                            <input type="text" name="prenom">
                        </div>
                        <div>
                            <label for="datenaissance">Date De Naissance</label>
                            <input type="date" name="datenaissance">
                        </div>
                        <div>
                            <label for="lieudeNaissance">Lieu De Naissance</label>
                            <input type="text" name="lieunaissance">
                        </div>
                        <div>
                            <label for="sexe">Sexe</label><br>
                            F <input type="radio" value="F" name="sexe">
                            M <input type="radio" value="M" name="sexe">
                        </div>
                    </div>
                    
                    <div class="">
                        <h3>Information général</h3>
                        <div>
                            <label for="profession">Profession</label>
                            <input type="text" name="profession">
                        </div>
                        <div>
                            <label for="contact">Contact</label>
                            <input type="text" name="contact">
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input type="email" name="email">
                        </div>
                        <div>
                            <label for="habitation">Habitation</label>
                            <input type="text" name="habitation">
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
                            <label for="specialiste">Spécialiste</label><br>
                            <select name="specialiste" id="specialiste">
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

    <script>
        function openModal1() {
            document.getElementById('modal-1').style.display = 'block';
        }

        function closeModal1() {
            document.getElementById('modal-1').style.display = 'none';
        }
    </script>
</body>
</html>