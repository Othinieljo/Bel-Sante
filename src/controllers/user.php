<?php

require_once('src/models/user.php');
require_once('src/models/specialiste.php');
require_once('session.php');

function connectionpage(){
    $message = '';
    if (isset($_SESSION['login_error'])) {
        $message = $_SESSION['login_error'];
        unset($_SESSION['login_error']); // Supprimer le message d'erreur de la session
    }
    require('./src/templates/connection/connection.php');
}

function deconnexionpage(){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // Détruire toutes les données de la session
    $_SESSION = array();
    // Finalement, détruire la session elle-même
    session_destroy();
    // Rediriger l'utilisateur vers la page de connexion
    header("Location: /Bel-Sante/login");
    exit(); // Assurez-vous de quitter le script après la redirection
}

function loginpage(array $input){
    $username = $input['username'];
    $password = $input['password'];
    $user = new User($username, $password);

    try {
        $user->connection = new DataBaseConnection();
        $result = $user->validateCredentials($username, $password);
        if ($result) {
            $_SESSION['id_user'] = $result['id_user'];
            $_SESSION['username'] = $result['username'];
            $_SESSION['type'] = $result['type'];
        } else {
            $_SESSION['login_error'] = "Nom d'utilisateur ou mot de passe incorrect.";
            header("Location: /Bel-Sante/login");
            exit();
        }
    } catch (Exception $e) {
        echo "Une nouvelle erreur est survenue: " . $e->getMessage();
    }

    if (isset($_SESSION['type'])) {
        header("Location: /Bel-Sante/admin");
        exit();
    }
}

function NewSpecialisteAndUser(array $input){
    $username = $input['username'];
    $password = $input['password'];
    $email = $input['email'];
    $type = "specialiste";
    $numero = $input['numero'];
    $NOMSPECIALITE = $input['NOMSPECIALISTE'];
    $PRENOMSPECIALISTE = $input['PRENOMSPECIALISTE'];
    $SPECIALITEDUSPECIALISTE = $input['SPECIALITEDUSPECIALISTE'];
    $GRADESPECIALISTE = $input['GRADESPECIALISTE'];
    $SEXESPECIALISTE = $input['SEXESPECIALISTE'];
    
    
    
    // Gestion du fichier téléchargé
    $target_dir = "/opt/lampp/htdocs/Bel-Sante/images/";
    $target_file = $target_dir . basename($_FILES["photourl"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Vérifier si le fichier est une image réelle
    $check = getimagesize($_FILES["photourl"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        // echo "File is not an image.";
        $uploadOk = 0;
    }

    // Vérification si le fichier existe déjà
    if (file_exists($target_file)) {
        // echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Limite de taille du fichier (5MB dans cet exemple)
    if ($_FILES["photourl"]["size"] > 5000000) {
        // echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Limiter les formats de fichier autorisés
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Si tout est correct, essayer de télécharger le fichier
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["photourl"]["tmp_name"], $target_file)) {
            // Créer une instance de votre classe User
            $user = new User();
            $user->connection = new DataBaseConnection();

            // Essayer d'ajouter l'utilisateur
            try {
                $result = $user->addUser($username, $password, $email, $numero, $type, $target_file);
                if ($result) {
                    $lastInsertId = $user->connection->getConnection()->lastInsertId();
                    $specialiste = new Specialiste();
                    $specialiste->connection = new DataBaseConnection();
                    $spec = $specialiste->NewSpecialiste($lastInsertId, $NOMSPECIALITE, $PRENOMSPECIALISTE, $SEXESPECIALISTE, $SPECIALITEDUSPECIALISTE, $GRADESPECIALISTE);
                    if ($spec) {
                        header("Location: /Bel-Sante/admin");
                        exit();
                    }
                    header("Location: /Bel-Sante/admin");
                } else {
                    // echo "Error: Could not create user.";
                }
            } catch (Exception $e) {
                // echo 'Une nouvelle erreur est survenue: ' . $e->getMessage();
            }
        } else {
            // echo "Sorry, there was an error uploading your file.";
            // echo "Error details: ";
            // print_r(error_get_last()); // Afficher les détails de l'erreur
        }
    }
}

?>
