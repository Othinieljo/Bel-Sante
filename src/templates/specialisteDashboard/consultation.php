<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/templates/specialisteDashboard/admin.css">
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
                    <a href="src/specialisteDashboard/admin.php">Dashbord</a>
                </div>
                <div>
                    <img src="src/assets/icons/patient.png" height="30px" alt="">
                    <a href="src/specialisteDashboard/patients.php"><u>Mes Patients</u></a>
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
                        <img src="src/assets/icons/se-deconnecter.png" height="50px" width="50px" style="border-radius: 50%; cursor: pointer;" style="border-radius: 50%;" title="Se déconnecter">
                    </div>
                </div>
            </div>
            <div style="display: flex; flex-direction: column; justify-content: center; padding: 10px; align-items: center; width: max-content;">
                <img src="src/assets/icons/dossier.png" width="70px" alt="">
                <b>Dossier médical n°14</b>
            </div>
            
            <div class="dim dossier">
                <div id="consulation" style="cursor: pointer; margin-bottom: 1rem;" onclick="showConsultation()"><u>Consulation</u></div>
                <div id="consultationForm">
                <form action="/Bel-Sante/consultation" method="post">
                <input type="hidden" name="idconsultation" value="<?php echo $idconsultation; ?>">
                <input type="hidden" name="numerodossier" value="<?php echo $numerodossier; ?>">
                    <div>
                        <div>
                            <label for="">Diagnostic</label><br>
                            <textarea name="diagnostic" id="" style="height: 135px;"><?php echo $diagnostic; ?></textarea>
                        </div>

                        <div>
                            <label for="">Prescription</label><br>
                            <textarea name="prescription" id="" style="height: 135px;"><?php echo $prescription; ?></textarea>
                        </div>

                        <div>
                            <label for="">Acte médical</label><br>
                            <textarea name="acte_medical" id="" style="height: 135px;"><?php echo $acte_medical; ?></textarea>
                        </div>
                    </div>

                    <div>
                        <div>
                            <label for="">Constantes</label><br>
                            <textarea name="constantes" id="" style="height: 135px;"><?php echo $constantes; ?></textarea>
                        </div>

                        <div>
                            <label for="examen">Examen complémentaire</label>
                            <select name="examen_complementaire" id="examen_complementaire">
                                <option value="">Sélectionner</option>
                                <?php
                                foreach ($exam_comps as $examen) {
                                    echo '<option value="' . $examen['IDEXAMENCOMPL'] . '"';
                                    

                                    echo '>' . $examen['LIBELLEEXAMCOMPL'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>


                        <div>
                            <label for="">Date de contrôle</label>
                            <input type="date" name="date_controle" id="" value="<?php echo $date_controle; ?>">
                        </div>
                    </div>

                    <div>
                        <div>
                            <label for="">Observation</label><br>
                            <textarea name="observation" id="" style="height: 135px;"><?php echo $observation; ?></textarea>
                        </div>

                        <div>
                            <input type="submit" value="Valider" style="background-color: rgb(2, 146, 2);; cursor: pointer; border: none; margin-top: 7.5rem; font-weight: 500; font-size: 20px; color: white;">
                        </div>
                    </div>
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