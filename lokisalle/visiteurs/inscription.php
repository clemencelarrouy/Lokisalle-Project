<?php 
require_once("../templates/init.inc.php");
include('../templates/nav.php');

if ($_POST) {

    if (strlen($_POST['pseudo']) < 3) {
        $contenu .= "le pseudo doit contenir 3 caractères minimum";
        echo $contenu ;
    } else {
        $membre = $pdo->query("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'");

         echo 'Merci de votre inscription ! Vous pouvez maintenant vous connecter.';
        
        // rowCount() retourne le nombre de ligne qui existe dans une table
        if ($membre->rowCount() > 0) {
            echo "ce pseudo existe déja";
        } else {
            $resultat =  $pdo->exec("INSERT INTO membre(pseudo,mdp,nom, prenom, email, civilite,ville,
code_postal, adresse) 
           VALUES('$_POST[pseudo]','$_POST[mdp]','$_POST[nom]','$_POST[prenom]','$_POST[email]','$_POST[civilite]','$_POST[ville]','$_POST[code_postal]','$_POST[adresse]' )");
            print_r($resultat);
        }
    }
}

?>



<div id="corps">
    <div class="nouveauclient">
     <h2>PAS ENCORE CLIENT?</h2>
     <p>
       Inscrivez-vous pour profiter d’offres et d’avantages exclusifs.
     </p>
     <form method="post" class="inscription-new">
        <label for="pseudo"> Pseudo : </label> <input type="text" id="pseudo" name="pseudo">
            <br>
        <label for="mdp"> Mot de passe :  </label> <input type="password" id="mpd" name="mdp">
             <br>
        <label for="nom"> Nom : </label> <input type="text" id="nom" name="nom">
             <br>
        <label for="prenom"> Prénom : </label> <input type="text" id="prenom" name="prenom">
             <br>
        <label for="email"> Mail : </label> <input type="email" id="email" name="email">
             <br>
        <label for="civilite"> Civilité : </label> 
                <select name="civilite" id="civilite">
                    <option value="f">Homme</option>
                    <option value="m">Femme</option>  
                </select> <br>
        <label for="ville"> Ville : </label> <input type="text" id="ville" name="ville">
             <br>
        <label for="code_postal"> C-p : </label> <input type="text" id="code_postal" name="code_postal">
             <br>
        <label for="adresse"> Adresse : </label> 
                <textarea id="adresse" name="adresse" rows="5" cols="33">
                </textarea> <br>

       <input type="submit" class="button" value="S'inscrire" />
     </form>
   </div>

</div>


<?php 
include('../templates/footer.php');
?>
