<?php 
require_once("../templates/init.inc.php");
include('../templates/nav.php');


//--- Lien utiles ---//
$contenu .= '<br><a href="?action=affichage" class="select-cat-admin">Affichage des membres</a> ';
$contenu .= '<a href="?action=ajout" class="select-cat-admin">Ajout d\'un compte administrateur </a><br><br><hr> ';



echo   $contenu ;
// modification de produits

// suppression de produits
if (isset($_GET['id_suppr'])) {
    $id = $_GET['id_suppr'];
    $resultat = $pdo->query("SELECT * FROM membre WHERE id_membre= $id");


    $pdo->query("DELETE FROM membre WHERE id_membre= $id ");
}

// Affichage des produits
if (isset($_GET['action']) and $_GET['action'] == 'affichage')
{
    $resultat = $pdo->query("SELECT * FROM membre");
    echo "
    <table class='tableau-produit'>
    <tr>
    <th>id membre</th>
    <th> pseudo </th>
    <th>mot de passe </th>
    <th> nom </th>
    <th> prenom </th>
    <th> email </th>
    <th> civilite </th>
    <th> ville </th>
    <th> code postal </th>
    <th> adresse </th>
    <th> statut </th>
    <th class='change'>modifier</th>
    <th class='change'>supprimer</th>
    </tr>";

    while ($datas = $resultat->fetch(PDO::FETCH_ASSOC)) 
    {
?>
        <tr>
            <td><?php echo $datas['id_membre']; ?></td>
            <td><?php echo $datas['pseudo']; ?></td>
            <td><?php echo $datas['mdp']; ?></td>
            <td><?php echo $datas['nom']; ?></td>
            <td><?php echo $datas['prenom']; ?></td>
            <td><?php echo $datas['email']; ?></td>
            <td><?php echo $datas['civilite']; ?></td>
            <td><?php echo $datas['ville']; ?></td>
            <td><?php echo $datas['code_postal']; ?></td>
            <td><?php echo $datas['adresse']; ?></td>
            <td><?php echo $datas['statut']; ?></td>


            <td><a href="?id_modif=<?php echo $datas['id_membre']; ?>"> modifier </a></td>
            <td><a href="?id_suppr=<?php echo $datas['id_membre']; ?>"
             Onclick="return(confirm('êtes vous certain ?'))">suppimer</a></td>
        </tr>


        
    <?php
    } 
    echo "</table>";
}

if (!empty($_POST)) 
{

        if (isset($_GET['action']) and $_GET['action'] == 'ajout') 
        { print_r($_POST);
            
           
            $pdo->exec("INSERT INTO membre(pseudo,mdp,nom,prenom,email, civilite, ville, code_postal, adresse, statut) VALUES('$_POST[pseudo]','$_POST[mdp]','$_POST[nom]','$_POST[prenom]','$_POST[email]','$_POST[civilite]','$_POST[ville]','$_POST[code_postal]','$_POST[adresse]','$_POST[statut]') ");
        }
}


if (isset($_GET['action']) and $_GET['action'] == 'ajout') 
{
    ?> <div class="nouveauclient">
        <h1> Formulaire ajout d'un membre </h1>
    <form method="post" enctype="multipart/form-data" action="">

        <input type="hidden" id="id_produit" name="id_produit" />

        <label for="pseudo">pseudo</label><br>
        <input type="text" id="pseudo" name="pseudo"  /> <br><br>

        <label for="mdp">mot de passe</label><br>
        <input type="text" id="mdp" name="mdp"  /> <br><br>

        <label for="nom">nom</label><br>
        <input type="text" id="nom" name="nom" placeholder="nom" /> <br><br>

        <label for="prenom">prenom</label><br>
        <input type="text" id="prenom" name="prenom" placeholder="prenom" /> <br><br>

        <label for="email">email</label><br>
        <input type="text" id="email" name="email" placeholder="email" /> <br><br>
 
        <label for="civilite"></label><br>
            <select name="civilite" id="civilite">
                    <option value="m">homme</option>
                    <option value="f">femme</option>
            </select> <br>

        <label for="ville">ville</label><br>
        <input type="ville" id="ville" name="ville" placeholder="ville" /> <br><br>

        <label for="code_postal">code postal</label><br>
        <input type="integer" id="code_postal" name="code_postal" placeholder="code_postal" /> 
        <br><br>

        <label for="adresse">adresse</label><br>
        <input type="text" id="adresse" name="adresse" placeholder="adresse" /> <br><br>

        <label for="statut">statut</label><br>
        <input type="integer" id="statut" name="statut" placeholder="statut" /> 
        <br><br> 
        <input type="submit" />
    </form> </div>
    <?php 
}

// modification de produit


if (isset($_GET['id_modif'])) {
    $id = $_GET['id_modif'];

    if (!empty($_POST)) {
         $pdo->exec("UPDATE membre SET pseudo='$_POST[pseudo]', mdp='$_POST[mdp]', nom='$_POST[nom]', prenom='$_POST[prenom]', email='$_POST[email]', civilite='$_POST[civilite]', ville='$_POST[ville]',
         code_postal='$_POST[code_postal]', adresse='$_POST[adresse]',statut='$_POST[statut]'  WHERE id_membre=$id");

        }
    

    $resultat = $pdo->query("SELECT * FROM membre WHERE id_membre=$id");
    $data = $resultat->fetch(PDO::FETCH_ASSOC);

?> <div class="nouveauclient">
<h1> Modification d'un Membre </h1>
    <form method="post" enctype="multipart/form-data" action="">

        <input type="hidden" id="id_membre" name="id_membre" value="<?php if (isset($data['id_membre'])) echo $data['id_membre']; ?>" />

        <label for="pseudo">pseudo</label><br>
        <input type="text" id="pseudo" name="pseudo" value="<?php if (isset($data['pseudo'])) echo $data['pseudo']; ?>" /> <br><br>

        <label for="mdp">mot de passe</label><br>
        <input type="text" id="mdp" name="mdp"  value="<?php if (isset($data['mdp'])) echo $data['mdp']; ?>" /> <br><br>

        <label for="nom">nom</label><br>
        <input type="text" id="nom" name="nom"  value="<?php if (isset($data['nom'])) echo $data['nom']; ?>" /> <br><br>

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
    </form> </div>

<?php
}

include('../templates/footer.php');
?>
