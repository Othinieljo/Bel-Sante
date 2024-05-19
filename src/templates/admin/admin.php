<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="src/templates/admin/admin.css" />
  <link rel="shortcut icon" href="src/assets/logo.png" type="image/x-icon">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

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
        <div style="cursor: pointer">
          <img src="src/assets/icons/dash.png" height="30px" alt="" />
          <a href="#"><u>Dashbord</u></a>
        </div>
        <div>
          <img src="src/assets/icons/patient.png" height="30px" alt="" />
          <a href="/Bel-Sante/patient">Patients</a>
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
          <!--<img src="../assets/icons/recherche.png" height="30px" alt="">-->
          <!-- <input type="text" placeholder="Recherche..." /> -->
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
        <div class="buttons">
          <button class="openModal-2" onclick="openModal2()">
            Médécin +
          </button>
          <button class="openModal-3" onclick="openModal3()">
            Service +
          </button>
        </div>
        <div class="informations">
          <div class="recaps">
            <div class="recap">
              <div>
                <span style="font-size: 20px; color: gray">Rendez-vous</span><br /><br />
                <b style="font-size: 40px"><?php echo $nbres_rdv ?></b>
              </div>
              <img src="src/assets/icons/rendez-vous.png" height="85px" alt="" />
            </div>
            <div class="recap">
              <div>
                <span style="font-size: 20px; color: gray">Patients</span><br /><br />
                <b style="font-size: 40px"><?php echo $nbres_dossier ?></b>
              </div>
              <img src="src/assets/icons/patient1.png" height="85px" alt="" />
            </div>
            <div class="recap">
              <div>
                <span style="font-size: 20px; color: gray">Personnel</span><br /><br />
                <b style="font-size: 40px">
                  <?php echo  $nbres_user ?>

                </b>
              </div>
              <img src="src/assets/icons/equipe-medicale.png" height="85px" alt="" />
            </div>
            <div class="recap">
              <div>
                <span style="font-size: 20px; color: gray">Consultations</span><br /><br />
                <b style="font-size: 40px">
                  <?php echo  $nbres_consultation ?>
                </b>
              </div>
              <img src="src/assets/icons/consultation.png" height="85px" alt="" />
            </div>
          </div>

          <div class="sc">
            <div class="stat">
              <h3>Statistiques des patients</h3>
              <div>
                <canvas id="myChart" width="815" height="400"></canvas>
              </div>
            </div>

            <div id="calendar"></div>
          </div>
          <div id="notifications" class="notifications">
            <h3>Ajout récent</h3>
            <table>
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
                      <p>Ouvert</p>
                    <?php else : ?>
                      <img src="src/assets/icons/verifier.png" height="20px" width="20px" alt="">
                      <p>Fermé</p>
                    <?php endif; ?>
                  </td>
                  <td><a href="/Bel-Sante/dossiers?n=<?php echo $dossier['NUMERODOSSIER'] ?>"><img src="src/assets/icons/visuel.png" height="30px" width="30px" alt=""></a></td>
                </tr>
              <?php endfor; ?>
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
  
  <section id="modal-2" class="modal">
    <div class="modal-content">
      <div class="header">
        <h1>AJOUT D'UN MÉDECIN</h1>
        <span class="close" onclick="closeModal2()">&times;</span>
      </div>

      <form action="/Bel-Sante/newsp" method="post">
        <div class="formulaire">
          <div class="">
            <h3>Médecin</h3>
            <div>
              <label for="NOMSPECIALISTE">Nom</label>
              <input type="text" name="NOMSPECIALISTE" />
            </div>
            <div>
              <label for="PRENOMSPECIALISTE">Prenoms</label>
              <input type="text" name="PRENOMSPECIALISTE" />
            </div>
            <div>
              <label for="photourl">Photo</label>
              <input type="file" name="photourl" />
            </div>
            <div>
              <label for="SEXESPECIALISTE">Sexe</label><br />
              F <input type="radio" value="F" name="SEXESPECIALISTE" /> M
              <input type="radio" value="M" name="SEXESPECIALISTE" />
            </div>
          </div>

          <div class="">
            <h3>Information général</h3>
            <div>
              <label for="SPECIALITEDUSPECIALISTE">Spécialité</label>
              <input type="text" name="SPECIALITEDUSPECIALISTE" />
            </div>
            <div>
              <label for="GRADESPECIALISTE">Grade</label><br />
              <select name="GRADESPECIALISTE" id="">
                <option value="">Choisir</option>
                <option value="A1">A 1</option>
                <option value="A2">A 2</option>
                <option value="A3">A 3</option>
                <option value="B1">B 1</option>
                <option value="B2">B 2</option>
                <option value="B3">B 3</option>
              </select>
            </div>
            <div>
              <label for="numero">Contact</label>
              <input type="text" name="numero" />
            </div>
            <div>
              <label for="email">Email</label>
              <input type="email" name="email" />
            </div>
          </div>

          <div class="">
            <h3>Authentification</h3>
            <div>
              <label for="username">Login</label>
              <input type="text" name="username" />
            </div>
            <div>
              <label for="password">Mot de passe</label>
              <input type="password" name="password" />
            </div>
            <div>
              <label for="password">Confirmation Mot de passe</label>
              <input type="password" name="password" />
            </div>
          </div>
        </div>
        <div class="buttonForm">
          <div></div>
          <div>
            <button class="submitButton" href="/Bel-Sante/admin" style="background: red">
              <a href="/Bel-Sante/admin" style="color: white">Annuler</a>
            </button>
            <button type="submit" style="background: rgb(2, 146, 2)">
              Enregistrer
            </button>
          </div>
        </div>
      </form>
    </div>
  </section>

  <section id="modal-3" class="modal">
    <div class="modal-content">
      <div class="header">
        <h1>AJOUT D'UN SERVICE</h1>
        <span class="close" onclick="closeModal3()">&times;</span>
      </div>

      <form action="/Bel-Sante/newsv" method="post">
        <div class="formulaire">
          <div class="">
            <h3>Service</h3>
            <div>
              <label for="NOMSERVICE">Nom du service</label>
              <input type="text" name="NOMSERVICE"  />
            </div>
            <div>
              <label for="RESPONSABLE">Responsable</label>
              <input type="text" name="RESPONSABLE" />
            </div>
            <div>
              <label for="numero">Contact</label>
              <input type="text" name="numero" />
            </div>
          </div>
          <div class="">
            <h3>Authentification</h3>
            <div>
              <label for="username">Login</label>
              <input type="text" name="username" />
            </div>
            <div>
              <label for="password">Mot de passe</label>
              <input type="password" name="password1" />
            </div>
            <div>
              <label for="password">Confirmer le mot de passe</label>
              <input type="password" name="password2" />
            </div>
          </div>
        </div>
        <div class="buttonForm">
          <div></div>
          <div>
            <button class="submitButton" href="/Bel-Sante/admin" style="background: red">
              <a href="/Bel-Sante/admin" style="color: white">Annuler</a>
            </button>
            <button type="submit" style="background: rgb(2, 146, 2)">
              Enregistrer
            </button>
          </div>
        </div>
      </form>
    </div>
  </section>

  <?php

  echo '<script>
            const data = {
                labels: ' . $jsDataLabels . ',
                datasets: [
                    {
                        label: "Nombre de patients par mois",
                        data: ' . $jsDataValues . ',
                        backgroundColor: "#0d6efd",
                        borderColor: "#0d6efd",
                        borderWidth: 1,
                    },
                ],
            };

            const config = {
                type: "line",
                data: data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            };

            var myChart = new Chart(document.getElementById("myChart"), config);
            </script>';
  ?>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var calendarEl = document.getElementById("calendar");
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "dayGridMonth",
      });
      calendar.render();
    });

    function openModal1() {
      document.getElementById("modal-1").style.display = "block";
    }

    function closeModal1() {
      document.getElementById("modal-1").style.display = "none";
    }

    function openModal2() {
      document.getElementById("modal-2").style.display = "block";
    }

    function closeModal2() {
      document.getElementById("modal-2").style.display = "none";
    }

    function openModal3() {
      document.getElementById("modal-3").style.display = "block";
    }

    function closeModal3() {
      document.getElementById("modal-3").style.display = "none";
    }
  </script>
</body>

</html>