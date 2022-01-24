<?php 
require_once("../templates/init.inc.php");

if ($_POST) {

    if (strlen($_POST['email']) < 1 || strlen($_POST
['email']) > 50) {
        $contenu .= "l'email doit contenir entre 1 
et 20 caractères";
    } else {
        $email = $pdo->query("SELECT * FROM newsletter 
WHERE email = '$_POST[email]'");
 
        if ($email->rowCount() > 0) {
            echo "Vous êtes déjà inscrit";
        } else {
            print_r($_POST);
            $resultat =  $pdo->exec("INSERT INTO newsletter (email) 
           VALUES('$_POST[email]')");
           
           print_r($resultat);
            
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.
0" />
    <title>LOKISALLE - NEWSLETTER </title>

    <link rel="stylesheet" href="../css_loki.css" />
  </head>
  <body>
  <div class="newsletter">
<H2> INSCRIVEZ-VOUS A NOTRE NEWSLETTER !</H2>
<p> Et recevez nos dernières offres promotionnelles, ainsi que de nombreux avantages. </p>
<form class="form-mdp" method="post" action="" >
        <input type="email" 
placeholder="mon e-mail" name="email" /> <br />
        <input type="submit" 
class="button" value="Valider" />
</form>

</div>


