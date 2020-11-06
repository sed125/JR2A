<?php
session_start();
include('../connexion_Bdd/connexionBdd.php');

// Suppression user interface admin
if (isset($_GET['idDelAdmin'])) {
    $rqstDel = $bdd->prepare('DELETE FROM `membres` WHERE id = :id');
    $rqstDel->execute(array(
        'id' => $_GET['idDelAdmin']
    ));
    $rqstDel->closeCursor();
    header('Location: ../admin/interfaceAdministration/listUsers.php');
}

// Supprimer son compte
if (isset($_GET['idDel'])) {
    $rqstDel = $bdd->prepare('DELETE FROM `membres` WHERE id = :id');
    $rqstDel->execute(array(
        'id' => $_GET['idDel']
    ));
    $rqstDel->closeCursor();
    header('Location: ../index.php');
}

// Supprimer message chat
if (isset($_GET['idDelMsg'])) {
    $rqstDel = $bdd->prepare('DELETE FROM `chat` WHERE id = :id');
    $rqstDel->execute(array(
        'id' => $_GET['idDelMsg']
    ));
    $rqstDel->closeCursor();
    header('Location: ../admin/interfaceAdministration/chat.php');
}

// Supprimer message aide utilisateurs
if (isset($_GET['idDelMsgAide'])) {
    $rqstDel = $bdd->prepare('DELETE FROM `aide` WHERE id = :id');
    $rqstDel->execute(array(
        'id' => $_GET['idDelMsgAide']
    ));
    $rqstDel->closeCursor();
    header('Location: ../admin/interfaceAdministration/aide.php');
}
// Supprimer un post
if (isset($_GET['idDelPost'])) {
    $rqstDel = $bdd->prepare('DELETE FROM `post` WHERE id = :id');
    $rqstDel->execute(array(
        'id' => $_GET['idDelPost']
    ));
    $rqstDel->closeCursor();
    header('Location: ../admin/interfaceAdministration/post.php');
}
// Supprimer un post
if (isset($_GET['idDelComPost'])) {
    $rqstDel = $bdd->prepare('DELETE FROM `commentairesPost` WHERE id = :id');
    $rqstDel->execute(array(
        'id' => $_GET['idDelComPost']
    ));
    $rqstDel->closeCursor();
    header('Location: ../admin/interfaceAdministration/post.php');
}
// Supprimer un avis
if (isset($_GET['idAvis'])) {
    $rqstDel = $bdd->prepare('DELETE FROM `avis` WHERE id = :id');
    $rqstDel->execute(array(
        'id' => $_GET['idAvis']
    ));
    $rqstDel->closeCursor();
    header('Location: ../admin/interfaceAdministration/avis.php');
}
// Reset password
if (isset($_GET['resetPass'])) {
    if ($_POST['password'] == $_POST['confirmPassw']) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $rqst = $bdd->prepare('UPDATE `membres` SET pass = :password WHERE id = :id');
        $rqst->execute(array(
            'id' => $_GET['resetPass'],
            'password' => $password
        ));
        $rqst->closeCursor();
        header('location ../connexion.php');
    } else {
        echo '<p>Votre mot de passe doit être le même que celui de la confirmation.</p>';
    }
}
// Recup champs formulaire
$passwo = password_hash($_POST['password'], PASSWORD_DEFAULT);
$update = $_POST['update'];
$add = $_POST['add'];
$rqst = $bdd->prepare('SELECT COUNT(*) FROM membres WHERE email = ?');
$rqst->execute(array($_POST['email']));
$array = $rqst->fetch();
$rqst->closeCursor();
$rqst = $bdd->prepare('SELECT pass FROM membres WHERE id = :id');
$rqst->execute(array(
    'id' => $_SESSION['id']
));
$pass = $rqst->fetch();
$rqst->closeCursor();

if (isset($_POST['email'])) {
    if (!($array[0] == 0)) {
        echo 'Email déja utilisé';
    } else {
        if ($_POST['password'] != $_POST['confirmPassw']) {
            echo '<p>Votre mot de passe doit être le même que celui de la confirmation.</p>';
        }
        // Modifier informations membre
        if ($update == 'Modifier') {
            $rqst = $bdd->prepare('UPDATE membres SET email = :email, prenom = :prenom, nom = :nom, pass = :password, telephone = :telephone, role = :role WHERE id = :id');
            $rqst->execute(array(
                'id' => $_SESSION['idUpdate'],
                'email' => $_POST['email'],
                'prenom' => $_POST['prenom'],
                'nom' => $_POST['nom'],
                'password' => $passwo,
                'telephone' => $_POST['tel'],
                'role' => $_POST['role']
            ));
            $rqst->closeCursor();
            unset($_SESSION['idUpdate']);
            header('location: ../admin/interfaceAdministration/listUsers.php');
        } // Add user
        elseif ($add == 'Ajouter') {
            $rqst = $bdd->prepare('INSERT INTO membres (`email`, `prenom`, `nom`, `pass`, `telephone`, `role`, `date_Inscription`) VALUES (:email, :prenom, :nom, :password, :telephone, :role, CURDATE())');
            $rqst->execute(array(
                'email' => $_POST['email'],
                'prenom' => $_POST['prenom'],
                'nom' => $_POST['nom'],
                'password' => $passwo,
                'telephone' => $_POST['tel'],
                'role' => $_POST['role'],
            ));
            $rqst->closeCursor();
            header('location: ../admin/interfaceAdministration/listUsers.php');
        } else {
            if ($_SESSION['role'] == 'admin') {
                echo 'Quelque chose ne va pas';
                header('Refresh 3; url=../admin/interfaceAdmin/interface.php');
            } elseif ($_SESSION['role'] == 'membre') {
                echo 'Quelque chose ne va pas';
                header('Refresh 3; url=../membres/espaceMembre.php');
            }
        }
    }
}
?>

