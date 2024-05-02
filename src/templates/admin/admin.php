<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/templates/admin/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <title>Médécin | bel'Santé</title>
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
                    <span>Dashbord</span>
                </div>
                <div>
                    <img src="src/assets/icons/patient.png" height="30px" alt="">
                    <span>Patients</span>
                </div>
                <div>
                    <img src="src/assets/icons/docteur.png" height="30px" alt="">
                    <span>Médécins</span>
                </div>
                <div>
                    <img src="src/assets/icons/boite.png" height="30px" alt="">
                    <span>Messagerie</span>
                </div>
            </div>
        </div>
        <div class="dashbord">
            <div class="navbar">
                <div class="search">
                    <!--<img src="../assets/icons/recherche.png" height="30px" alt="">-->
                    <input type="text" placeholder="Recherche...">
                </div>
                <div class="user">
                    <div class="notif" style="cursor: pointer;">
                        <div class="news">10</div>
                        <img src="src/assets/icons/notification.png" height="30px" alt="">
                    </div>
                    <div class="profil">
                        <img src="src/assets/pp/IMG_6596.jpg" height="50px" width="50px" style="border-radius: 50%; cursor: pointer;" style="border-radius: 50%;" title="Connecté">
                        <p class="name"><b>BAHILI</b><br> Esli Ariel</p>
                    </div>
                    <div class="deconnection">
                        <img src="src/assets/icons/se-deconnecter.png" height="50px" width="50px" style="border-radius: 50%; cursor: pointer;" style="border-radius: 50%;" title="Se déconnecter">
                    </div>
                </div>
            </div>
            <div class="buttons">
                <button class="openModal-1" onclick="openModal1()">Patient +</button>
                <button class="openModal-2" onclick="openModal2()">Médécin +</button>
            </div>
            <div class="informations">
                <div class="recaps">
                    <div class="recap">
                        <div>
                            <span style="font-size: 20px; color: gray;">Rendez-vous</span><br><br>
                            <b style="font-size: 40px;">20</b>
                        </div>
                        <img src="src/assets/icons/rendez-vous.png" height="85px" alt="">
                    </div>
                    <div class="recap">
                        <div>
                            <span style="font-size: 20px; color: gray;">Patients</span><br><br>
                            <b style="font-size: 40px;">12</b>
                        </div>
                        <img src="src/assets/icons/patient1.png" height="85px" alt="">
                    </div>
                    <div class="recap">
                        <div>
                            <span style="font-size: 20px; color: gray;">Personnel</span><br><br>
                            <b style="font-size: 40px;">14</b>
                        </div>
                        <img src="src/assets/icons/equipe-medicale.png" height="85px" alt="">
                    </div>
                    <div class="recap">
                        <div>
                            <span style="font-size: 20px; color: gray;">Consultations</span><br><br>
                            <b style="font-size: 40px;">39</b>
                        </div>
                        <img src="src/assets/icons/consultation.png" height="85px" alt="">
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

                <div class="notifications">
                    <h3>Notifications</h3>
                    <table>
                        <tr>
                            <th>Nom</th>
                            <th>Lieu de résidence</th>
                            <th>Contact</th>
                            <th>Heure</th>
                            <th>Date</th>
                            <th>Statut</th>
                            <th>+</th>
                        </tr>
                        <tr>
                            <td>BAHILI Esli Ariel</td>
                            <td>Treichville</td>
                            <td>0777409491</td>
                            <td>07:51</td>
                            <td>1/05/2024</td>
                            <td class="state">
                                <img src="src/assets/icons/horloge.png" height="20px" width="20px" alt="">
                                <span>En cours</span>
                            </td>
                            <td>Voir plus</td>
                        </tr>
                        <tr>
                            <td>BAHILI Esli Ariel</td>
                            <td>Treichville</td>
                            <td>0777409491</td>
                            <td>07:51</td>
                            <td>1/05/2024</td>
                            <td class="state">
                                <img src="src/assets/icons/verifier.png" height="20px" width="20px" alt="">
                                <span>Terminé</span>
                            </td>
                            <td>Voir plus</td>
                        </tr>
                        <tr>
                            <td>BAHILI Esli Ariel</td>
                            <td>Treichville</td>
                            <td>0777409491</td>
                            <td>07:51</td>
                            <td>1/05/2024</td>
                            <td class="state">
                                <img src="src/assets/icons/horloge.png" height="20px" width="20px" alt="">
                                <span>En cours</span>
                            </td>
                            <td>Voir plus</td>
                        </tr>
                        <tr>
                            <td>BAHILI Esli Ariel</td>
                            <td>Treichville</td>
                            <td>0777409491</td>
                            <td>07:51</td>
                            <td>1/05/2024</td>
                            <td class="state">
                                <img src="src/assets/icons/verifier.png" height="20px" width="20px" alt="">
                                <span>Terminé</span>
                            </td>
                            <td>Voir plus</td>
                        </tr>
                        <tr>
                            <td>BAHILI Esli Ariel</td>
                            <td>Treichville</td>
                            <td>0777409491</td>
                            <td>07:51</td>
                            <td>1/05/2024</td>
                            <td class="state">
                                <img src="src/assets/icons/horloge.png" height="20px" width="20px" alt="">
                                <span>En cours</span>
                            </td>
                            <td>Voir plus</td>
                        </tr>
                        <tr>
                            <td>BAHILI Esli Ariel</td>
                            <td>Treichville</td>
                            <td>0777409491</td>
                            <td>07:51</td>
                            <td>1/05/2024</td>
                            <td class="state">
                                <img src="src/assets/icons/verifier.png" height="20px" width="20px" alt="">
                                <span>Terminé</span>
                            </td>
                            <td>Voir plus</td>
                        </tr>
                        <tr>
                            <td>BAHILI Esli Ariel</td>
                            <td>Treichville</td>
                            <td>0777409491</td>
                            <td>07:51</td>
                            <td>1/05/2024</td>
                            <td class="state">
                                <img src="src/assets/icons/horloge.png" height="20px" width="20px" alt="">
                                <span>En cours</span>
                            </td>
                            <td>Voir plus</td>
                        </tr>
                        <tr>
                            <td>BAHILI Esli Ariel</td>
                            <td>Treichville</td>
                            <td>0777409491</td>
                            <td>07:51</td>
                            <td>1/05/2024</td>
                            <td class="state">
                                <img src="src/assets/icons/verifier.png" height="20px" width="20px" alt="">
                                <span>Terminé</span>
                            </td>
                            <td>Voir plus</td>
                        </tr>
                    </table>
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
    <section id="modal-2" class="modal">
        <div class="modal-content">
            <div class="header">
                <h1>AJOUT D'UN MÉDECIN</h1>
                <span class="close" onclick="closeModal2()">&times;</span>
            </div>
        </div>
    </section>
    

    <script>
        const data = {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai'],
            datasets: [{
                label: 'Nombre de patients par mois',
                data: [12, 19, 3, 5, 2],
                backgroundColor: '#0d6efd',
                borderColor: '#0d6efd',
                borderWidth: 1
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        var myChart = new Chart(
            document.getElementById('myChart'),
            config
        );


        document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
        });
        calendar.render();
      });

        function openModal1() {
            document.getElementById('modal-1').style.display = 'block';
        }

        function closeModal1() {
            document.getElementById('modal-1').style.display = 'none';
        }

        function openModal2() {
            document.getElementById('modal-2').style.display = 'block';
        }

        function closeModal2() {
            document.getElementById('modal-2').style.display = 'none';
        }
    </script>
</body>
</html>