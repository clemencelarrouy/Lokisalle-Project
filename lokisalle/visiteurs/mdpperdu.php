<?php 
require_once("../templates/init.inc.php");
include('../templates/nav.php');




if ($_POST) {

    if (strlen($_POST['email']) < 1 || strlen($_POST
['email']) > 50) {
        $contenu .= "l'email doit contenir entre 1 
et 20 caractères";
    } else {
        $email = $pdo->query("SELECT * FROM membre 
WHERE email = '$_POST[email]'");
 
        if ($email->rowCount() == 0) {
            $msg =  "Vous n'êtes pas inscrit";
        } else {
           
            $resultat =  $pdo->exec("SELECT mdp FROM membre 
           WHERE email = '$_POST[email]'");
           

            $msg =  " <span style='color:green'>Un email contenant votre mot de passe vous a été envoyé </span>" ; 
            
        }
    }
}

?>




<div class="nouveauclient">
           <div class="mdpperdu">
           <h2>MOT DE PASSE OUBLIE ?</h2>
               <p>
                Afin de pouvoir réinitialiser votre mot de passe, vous devez nous fournir votre adresse mail : 
                 
               </p>
           <br />
           <br />
   <form class="form-mdp" method="post"  >
           <input type="email" placeholder="mon e-mail" name="email" action=""/> <br /> <br>
           <input type="submit" class="button" value="Valider" />
   </form>

   <?php echo $msg ;?>
   </div>

</div>
<?php 
include('../templates/footer.php');
?>
