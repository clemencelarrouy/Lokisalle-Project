<?php
require_once("../templates/init.inc.php");
include('../templates/nav.php');

if (isset($_GET['id_modif'])) {
    $id = $_GET['id_modif'];

    if (!empty($_POST)) {
         $pdo->exec("UPDATE membre SET pseudo='$_POST[pseudo]', mdp='$_POST[mdp]', nom='$_POST[nom]', prenom='$_POST[prenom]', email='$_POST[email]', civilite='$_POST[civilite]', ville='$_POST[ville]',
         code_postal='$_POST[code_postal]', adresse='$_POST[adresse]',statut='$_POST[statut]'  WHERE id_membre=$id");

        $_SESSION['membre']['nom'] = $_POST['nom'];
        $_SESSION['membre']['prenom'] = $_POST['prenom'];
        $_SESSION['membre']['civilite'] = $_POST['civilite'];
        $_SESSION['membre']['code_postal'] = $_POST['code_postal'];
            
        $_SESSION['membre']['email'] = $_POST['email'];  
        $_SESSION['membre']['statut'] = $_POST['statut']; 

        }}

if (isset($_SESSION['membre'])) {

     echo "<h2 style='text-align: center'> 
    bonjour " . $_SESSION['membre']['prenom'] . "</h2>";

  echo "<div class='nouveauclient'>";
  echo "<h4> Mes informations</h4>";
  echo "votre email est :". $_SESSION['membre']['email']  . '<br>'; 
  echo "Votre pseudo : " . $_SESSION['membre']['nom'] . '<br>';
  echo "Votre prenom :" . $_SESSION['membre']['prenom'] . "<br>";
  echo "Votre code postal : " . $_SESSION['membre']['code_postal']. '<br>';
  
   
}
// modification du profil 
if ($resultat = $pdo->query("SELECT * FROM membre")){ 
($datas = $resultat->fetch(PDO::FETCH_ASSOC));
 {
?>

<br> <a href="?id_modif=<?php echo $datas['id_membre']; ?>"> Modifier des informations de mon profil </a> <br>
 

<?php 
}

if (isset($_GET['id_modif'])) {
    $id = $_GET['id_modif'];



    

    $resultat = $pdo->query("SELECT * FROM membre WHERE id_membre=$id");
    $data = $resultat->fetch(PDO::FETCH_ASSOC);

?>
<h4> Mes informations à modifier</h4>
    <form method="post" enctype="multipart/form-data" action="">

        <input type="hidden" id="id_membre" name="id_membre" value="<?php if (isset($data['id_membre'])) echo $data['id_membre']; ?>" />

        <label for="pseudo">pseudo</label><br>
        <input type="text" id="pseudo" name="pseudo" value="<?php if (isset($data['pseudo'])) echo $data['pseudo']; ?>" /> <br><br>

        <label for="mdp">mot de passe</label><br>
        <input type="text" id="mdp" name="mdp"  value="<?php if (isset($data['mdp'])) echo $data['mdp']; ?>" /> 
<br><br>

        <label for="nom">nom</label><br>
        <input type="text" id="nom" name="nom"  value="<?php if (isset($data['nom'])) echo $data['nom']; ?>" /> 
<br><br>

        <label for="prenom">prenom</label><br>
        <input type="text" id="prenom" name="prenom"  value="<?php if (isset($data['prenom'])) echo $data['prenom']; ?>" /> <br><br>

        <label for="email">email</label><br>
        <input type="text" id="email" name="email"  value="<?php if (isset($data['email'])) echo $data['email']; ?>" /> <br><br>


        <label for="civilite"></label><br>
        <select name="civilite" id="civilite">
            <option value="m">homme</option>
            <option value="f">femme</option>
        </select> <br>

        <label for="ville">ville</label><br>
        <input type="text" id="ville" name="ville"  value="<?php if (isset($data['ville'])) echo $data['ville']; ?>" /> <br><br>

        <label for="code_postal">code postal</label><br>
        <input type="integer" id="code_postal" name="code_postal"  value="<?php if (isset($data['code_postal'])) echo $data['code_postal']; ?>" /> <br><br>

                <label for="adresse">adresse</label><br>
        <input type="text" id="adresse" name="adresse"  value="<?php if (isset($data['adresse'])) echo $data['adresse']; 
        ?>" /> <br><br>

        <label for="statut">statut</label><br>
        <input type="integer" id="statut" name="statut"  value="<?php if (isset($data['statut'])) echo $data['statut']; ?>" /> <br><br>

        <input type="submit" />
    </form>

<?php
}

}

// dernieres commandes 

if ($_SESSION['membre']['statut'] == 0) {
    $id_membre = $_SESSION['membre']['id_membre'];
    $resultat = $pdo->query("SELECT * FROM commande WHERE id_membre = $id_membre");

    echo "<br> <br> <h4> Mes commandes</h4>";
    echo "
    <table class='tableau-produit'>
    <tr>
    <th>id commande</th>
    <th>id membre </th>
    <th>montant</th>
    <th> état </th>
    </tr>";

    while ($datas = $resultat->fetch(PDO::FETCH_ASSOC)) 
    {?>
        <tr>
            <td><?php echo $datas['id_commande']; ?></td>
            <td><?php echo $datas['id_membre']; ?></td>
            <td><?php echo $datas['montant']; ?></td>
            <td><?php echo $datas['etat']; ?></td>
        </tr>
    <?php
    } 
    echo "</table>";
    


}


echo '</div>';

require_once('../templates/footer.php');
