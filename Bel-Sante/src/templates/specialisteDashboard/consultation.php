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
                    <a href="src/specialisteDashboard/admin.php">Dashbord</a>
                </div>
                <div>
                    <img src="src/assets/icons/patient.png" height="30px" alt="">
                    <a href="/Bel-Sante/patient"><u>Mes Patients</u></a>
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
            <div style="display: flex; flex-direction: column; justify-content: center; padding: 10px; align-items: center; width: max-content;">
                <img src="src/assets/icons/dossier.png" width="70px" alt="">
                <b>Dossier médical n°<?php echo $numerodossier; ?></b>
            </div>
            
            <div class="dim dossier">
                <h3 id="consulation" style="cursor: pointer; margin-bottom: 1rem; width:max-content;" onclick="showConsultation()"><u>Consulation</u></h3>
                <div id="consultationForm">
                    <form action="/Bel-Sante/consultation" method="post">
                        <input type="hidden" name="idconsultation" value="<?php echo $idconsultation; ?>">
                        <input type="hidden" name="numerodossier" value="<?php echo $numerodossier; ?>">
                        <table>
                            <tr>
                                <td>Diagnostic <span class="oblige">*</span></td>
                                <td>Prescription <span class="oblige">*</span></td>
                                <td>Acte médical</td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea name="diagnostic" id="" style="height: 135px;" required><?php echo $diagnostic; ?></textarea>
                                </td>
                                <td>
                                    <textarea name="prescription" id="" style="height: 135px;" required><?php echo $prescription; ?></textarea>
                                </td>
                                <td>
                                    <textarea name="acte_medical" id="" style="height: 135px;"><?php echo $acte_medical; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Constantes <span class="oblige">*</span></td>
                                <td>Examen</td>
                                <td>Causes</td>
                            </tr>
                            <tr>
                                <td><textarea name="constantes" id="" style="height: 135px;" required><?php echo $constantes; ?></textarea></td>
                                <td>
                                    <select name="examen_complementaire" id="examen_complementaire">
                                        <option value="">Sélectionner</option>
                                        <?php
                                        foreach ($exam_comps as $examen) {
                                            echo '<option value="' . $examen['IDEXAMENCOMPL'] . '"';
                                            

                                            echo '>' . $examen['LIBELLEEXAMCOMPL'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <textarea name="causes" id="" style="height: 135px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Observation</td>
                                <td>Date de control</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><textarea name="observation" id="" style="height: 135px;"><?php echo $observation; ?></textarea></td>
                                <td><input type="date" name="date_controle" id="" value="<?php echo $date_controle; ?>"></td>
                                <td><input type="submit" value="Valider" class="consultationEnvoie"></td>
                            </tr>
                        </table>
                    </form>  
                </div>
                <h3 style="cursor: pointer; margin-bottom: 1rem; width:max-content;" onclick="showInfo()"><u>Carnet numérique du patient</u></h3>
                <div id="informationDossier">
                    <table>
                        <tr>
                            <td colspan="9" ><b>Information sur le patient</b></td>
                        </tr>
                        <tr style="font-weight: 500;">
                            <td>Nom</td>
                            <td>Prenoms</td>
                            <td>Sexe</td>
                            <td>Date de naissance</td>
                            <td>Lieu de naissance</td>
                            <td>Lieu d'habitation</td>
                            <td>Profession</td>
                            <td>Contact</td>
                            <td>Email</td>
                        </tr>
                        <tr>
                            <td>BAHILI</td>
                            <td>ESLI ARIEL</td>
                            <td>Masculin</td>
                            <td>24/03/2002</td>
                            <td>Abengourou</td>
                            <td>Treichville</td>
                            <td>Ingénier Génie Logiciel</td>
                            <td>0777409491</td>
                            <td>bahiliariel@gmail.com</td>
                        </tr>
                        <tr>
                            <td colspan="9" ><b>Dossier</b></td>
                        </tr>
                        <tr style="font-weight: 500;">
                            <td colspan="2" >Groupe Sanguin</td>
                            <td colspan="7">Antécedant</td>
                        </tr>
                        <tr>
                            <td colspan="2" >A+</td>
                            <td colspan="7">Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus, quibusdam beatae fugiat doloremque assumenda minima a laborum rerum iure aut!</td>
                        </tr>
                        <tr>
                            <td colspan="9" ><b>Historique de consulation</b></td>
                        </tr>
                        <tr style="font-weight: 500;">
                            <td>Date</td>
                            <td>Acte médical</td>
                            <td>Constantes</td>
                            <td colspan="2">Observation</td>
                            <td colspan="2">Diagnostic</td>
                            <td colspan="2">Prescription</td>
                        </tr>
                        <!-- Boucle pour afficher les consultations que a effectué le patient -->
                        <tr>
                            <td>17/05/2024</td>
                            <td>Lorem ipsum dolor sit amet.</td>
                            <td>Lorem ipsum dolor sit amet.</td>
                            <td colspan="2">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repellat, id.</td>
                            <td colspan="2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci, et.</td>
                            <td colspan="2">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Itaque, aut?</td>
                        </tr>

                        <tr>
                            <td colspan="9" ><b>Historique d'examen</b></td>
                        </tr>
                        <tr style="font-weight: 500;">
                            <td>Date</td>
                            <td colspan="3">Causes</td>
                            <td colspan="2">Examen</td>
                            <td colspan="3">Résultats</td>
                        </tr>
                        <!-- Boucle pour afficher les examens que a effectué le patient -->
                        <tr>
                            <td>Le 18 janvier 1900 février</td>
                            <td colspan="3">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Deleniti, velit?</td>
                            <td colspan="2">Lorem ipsuting elit. Praesentium, voluptatum?</td>
                            <td colspan="3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, sint.</td>
                        </tr>
                    </table>
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
        function showInfo() {
            if(document.getElementById('informationDossier').style.display == 'none'){
                document.getElementById('informationDossier').style.display = 'block';
            }else{
                document.getElementById('informationDossier').style.display = 'none';
            }
        }
    </script>
</body>
</html>