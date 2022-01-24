<?php 
require_once("../templates/init.inc.php");
include('../templates/nav.php');


 
if (isset($_GET['action']) and $_GET['action'] == 'deconnexion') {
    session_destroy();
}

if ($_POST) {



    $resultat = $pdo->query("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]' ");

    if ($resultat->rowCount() != 0) {
        $membre = $resultat->fetch(PDO::FETCH_ASSOC);

        if ($membre['mdp'] == $_POST['mdp']) {
            $_SESSION['membre']['id_membre'] = $membre['id_membre'];
            $_SESSION['membre']['nom'] = $membre['nom'];
            $_SESSION['membre']['prenom'] = $membre['prenom'];
            $_SESSION['membre']['civilite'] = $membre['civilite'];
            $_SESSION['membre']['code_postal'] = $membre['code_postal'];
            $_SESSION['membre']['email'] = $membre['email'];  
            $_SESSION['membre']['statut'] = $membre['statut']; 
            header("Location:profil.php");

        } else {
            echo "Erreur de mot de passe";
        }
    } else {
        echo "Erreur de pseudo";
    }   

}






?>

<div id="corps">
    <div class="connexion">
        <div class="membre">

        <?php 
         if ($_SESSION) { 
             echo "Vous êtes connectés, vous pouvez acceder à votre <a href='profil.php'> profil </a>"; 
         }
         ?>
            <h2>DEJA MEMBRE ?</h2>
                <p>
                 Connectez-nous à votre compte pour continuer à profiter de vos
                 avantages et consulter votre historique de réservation.
                </p>
            <br />
    <form class="connection"  method="post" action="">
             <label for="pseudo">Pseudo</label><br>
  <input type="text" id="pseudo" name="pseudo"><br> <br>
  <label for="mdp">Mot de passe</label><br>
  <input type="password" id="mdp" name="mdp"><br><br>
           

           
           
            <p><a href="mdpperdu.php">Mot de passe oublié ?</a></p>
            <input type="submit" class="button" value="se connecter" />
    </form>
    </div>

    <div class="pasmembre">
        <h2>PAS ENCORE MEMBRE ?</h2>
        
        <p> <a href="inscription.php"> Inscrivez-vous</a></p>
    </div>

</div>
</div>

<?php 
include('../templates/footer.php');
?>
