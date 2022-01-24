<?php 
require_once("../templates/init.inc.php");
include('../templates/nav.php');


//--- Lien utiles ---//
$contenu .= '<br><a href="?action=affichage" class="select-cat-admin">Affichage des salles</a> ';
$contenu .= '<a href="?action=ajout" class="select-cat-admin">Ajout d\'une salle</a><br><br><hr> ';


//if (!internauteEstConnecteEtEstAdmin()) {
 //   header("location:../connexion.php");
 //   exit();
//}

echo   $contenu ;
// modification de produits

// suppression de produits
if (isset($_GET['id_suppr'])) {
    $id = $_GET['id_suppr'];
    $resultat = $pdo->query("SELECT * FROM produit WHERE id_produit= $id");
    $produit_a_supprimer = $resultat->fetch(PDO::FETCH_ASSOC);

    $chemin_photo_a_supprimer = $produit_a_supprimer['photo'];

    $chemin_photo_a_supprimer =  $_SERVER['DOCUMENT_ROOT'] . $chemin_photo_a_supprimer;
    debug($chemin_photo_a_supprimer);
    if (empty($produit_a_supprimer) && file_exists($chemin_photo_a_supprimer)) {
        debug($chemin_photo_a_supprimer);
        unlink($chemin_photo_a_supprimer);
    }

    $pdo->query("DELETE FROM produit WHERE id_produit= $id ");
}

// Affichage des produits
if (isset($_GET['action']) and $_GET['action'] == 'affichage') {
    $resultat = $pdo->query("SELECT * FROM produit");
    echo "
    <table class='tableau-produit'>
    <tr>
    <th>id </th><th>reference</th><th>catégorie</th><th>titre</th><th>description</th><th>capacité</th><th>adresse</th><th>photo</th><th>pays</th><th>ville</th><th>cp</th class='change'><th>modifier</th><th class='change'>supprimer</th>
</tr>
    ";
    while ($datas = $resultat->fetch(PDO::FETCH_ASSOC)) {
?>
        <tr>
            <td><?php echo $datas['id_produit']; ?></td>
            <td><?php echo $datas['reference']; ?></td>
            <td><?php echo $datas['categorie']; ?></td>
            <td><?php echo $datas['titre']; ?></td>
            <td><?php echo $datas['description']; ?></td>
            <td><?php echo $datas['capacite']; ?></td>
            <td><?php echo $datas['adresse']; ?></td>
            <td><img src="<?php echo $datas['photo']; ?>" height=70 /></td>
            <td><?php echo $datas['pays']; ?></td>
            <td><?php echo $datas['ville']; ?></td>
            <td><?php echo $datas['cp']; ?></td>
            <td><a href="?id_modif=<?php echo $datas['id_produit']; ?>">modifier </a></td>
            <td><a href="?id_suppr=<?php echo $datas['id_produit']; ?>" Onclick="return(confirm('êtes vous certain ?'))">suppimer</a></td>
        </tr>
    <?php
    } 
    echo "</table>";
}

if (!empty($_POST)) 
{
    $photo_bdd = "";

    if (isset($_GET['id_modif'])) {
        $photo_bdd =  $_FILES['photo'];
        
    }
    if (!empty($_FILES['photo']['name']))
    {

        $nom_photo = $_POST['reference'] . '_' . $_FILES['photo']['name'];
        $photo_bdd = RACINE_SITE . "images/salles/$nom_photo";
       // echo '<pre>';
       // echo print_r($photo_bdd);
       // echo '</pre>';

        $photo_dossier = $_SERVER['DOCUMENT_ROOT'] . RACINE_SITE . "images/salles/$nom_photo";
      //  echo '<pre>';
      //  echo print_r($photo_dossier);
      //  echo '</pre>';

        copy($_FILES['photo']['tmp_name'], $photo_dossier);

        if (isset($_GET['action']) and $_GET['action'] == 'ajout') 
        { 
        //    print_r($_POST);
          //  print_r($photo_bdd);
           
            $statement = $pdo->prepare("INSERT INTO produit(reference,categorie,titre,description,capacite,adresse,photo,pays,ville,cp) VALUES(:reference, :categorie, :titre, :description,'$_POST[capacite]',:adresse, '$photo_bdd','$_POST[pays]','$_POST[ville]' , '$_POST[cp]') ");
            $statement->bindValue(':reference', $_POST['reference']);
            $statement->bindValue(':categorie', $_POST['categorie']);
            $statement->bindValue(':titre', $_POST['titre']);
            $statement->bindValue(':description', $_POST['description']);
            $statement->bindValue(':adresse', $_POST['adresse']);
            $statement->execute();
        }
    }
}

if (isset($_GET['action']) and $_GET['action'] == 'ajout') 
{
    ?> <div class="nouveauclient">
        <h1> Formulaire Salle </h1>
    <form method="post" enctype="multipart/form-data" action="">

        <input type="hidden" id="id_produit" name="id_produit" />

        <label for="reference">reference</label><br>
        <input type="text" id="reference" name="reference" placeholder="la référence de produit" /> <br><br>

        <label for="categorie">categorie</label><br>
        <input type="text" id="categorie" name="categorie" placeholder="la categorie de produit" /> <br><br>

        <label for="titre">titre</label><br>
        <input type="text" id="titre" name="titre" placeholder="le titre du produit" /> <br><br>

        <label for="description">description</label><br>
        <textarea name="description" id="description" placeholder="la description du produit" ></textarea><br><br>

        <label for="capacite">capacite</label><br>
        <input type="integer" id="capacite" name="capacite" placeholder="la capacite du produit" /> <br><br>

        <label for="adresse">adresse</label><br>
        <input type="text" id="adresse" name="adresse" placeholder="l'adresse de produit" /> 
        <br><br>

        <label for="photo">photo</label><br>
        <input type="file" id="photo" name="photo"><br><br>

        <label for="pays">pays</label><br>
        <input type="text" id="pays" name="pays" placeholder="pays" /> 
        <br><br>

         <label for="ville">ville</label><br>
        <input type="text" id="ville" name="ville" placeholder="ville" /> 
        <br><br>

        <label for="cp">code postal</label><br>
        <input type="integer" id="cp" name="cp" placeholder="code postal de la salle"><br><br>


        <input type="submit" />
    </form> </div>
    <?php 
}

// modification de produit


if (isset($_GET['id_modif'])) {
    $id = $_GET['id_modif'];

    if (!empty($_POST)) {
        if (!empty($_FILES['photo']['tmp_name'])) {
   
            $statement = $pdo->prepare("UPDATE produit SET reference=:reference, categorie=:categorie, titre=:titre, description=:description,capacite='$_POST[capacite]',adresse=:adresse, photo='$photo_bdd', pays='$_POST[pays]',ville='$_POST[ville]',cp='$_POST[cp]' WHERE id_produit=$id ");
                $statement->bindValue(':reference', $_POST['reference']);
                $statement->bindValue(':categorie', $_POST['categorie']);
                $statement->bindValue(':titre', $_POST['titre']);
                $statement->bindValue(':description', $_POST['description']);
                $statement->bindValue(':adresse', $_POST['adresse']);
                $statement->execute();


        } else {
             $statement = $pdo->prepare("UPDATE produit SET reference=:reference, categorie=:categorie, titre=:titre, description=:description,capacite='$_POST[capacite]',adresse=:adresse, pays='$_POST[pays]',ville='$_POST[ville]',cp='$_POST[cp]' WHERE id_produit=$id ");
                $statement->bindValue(':reference', $_POST['reference']);
                $statement->bindValue(':categorie', $_POST['categorie']);
                $statement->bindValue(':titre', $_POST['titre']);
                $statement->bindValue(':description', $_POST['description']);
                $statement->bindValue(':adresse', $_POST['adresse']);
                $statement->execute();
            
        }
    }

    $resultat = $pdo->query("SELECT * FROM produit WHERE id_produit=$id");
    $data = $resultat->fetch(PDO::FETCH_ASSOC);

?> <div class="nouveauclient">
<h1> Modification d'une Salle </h1>
    <form method="post" enctype="multipart/form-data" action="">

        <input type="hidden" id="id_produit" name="id_produit" value="<?php if (isset($data['id_produit'])) echo $data['id_produit']; ?>" />

        <label for="reference">reference</label><br>
        <input type="text" id="reference" name="reference" placeholder="la référence de produit" value="<?php if (isset($data['reference'])) echo $data['reference']; ?>" /> <br><br>

        <label for="categorie">categorie</label><br>
        <input type="text" id="categorie" name="categorie" placeholder="la categorie de produit" value="<?php if (isset($data['categorie'])) echo $data['categorie']; ?>" /> <br><br>

        <label for="titre">nom</label><br>
        <input type="text" id="titre" name="titre" placeholder="le titre de la salle" value="<?php if (isset($data['titre'])) echo $data['titre']; ?>" /> <br><br>

        <label for="description">description</label><br>
        <textarea name="description" id="description" placeholder="la description du produit"> <?php if (isset($data['description'])) echo $data['description']; ?> </textarea><br><br>

        <label for="capacite">capacite</label><br>
        <input type="integer" id="capacite" name="capacite" placeholder="la capacite de la salle" value="<?php if (isset($data['capacite'])) echo $data['capacite']; ?>" /> <br><br>

        <label for="adresse">adresse</label><br>
        <input type="text" id="adresse" name="adresse" placeholder="la capacite de la salle" 
        value="<?php if (isset($data['adresse'])) echo $data['adresse']; ?>" /> <br><br>

        <label for="photo">photo</label><br>
        <input type="file" id="photo" name="photo" value="<?php if (isset($data['photo'])) echo $data['photo']; ?>"><br><br>
        <?php if (isset($data['photo'])) {
            echo '<i>Vous pouvez uplaoder une nouvelle photo si vous souhaitez la changer</i><br>';
            echo '<img src="' . $data['photo'] . '"  ="90" height="90"><br>';
            echo '<input type="hidden" name="photo_actuelle" value="' . $data['photo'] . '"><br>';
        }

        ?>

    <label for="pays"> Pays </label><br>
    <input type="text" id="pays" name="pays" placeholder="pays de la salle" 
    value="<?php if (isset($data['pays'])) echo $data['pays']; ?>" /> <br><br>

    <label for="ville"> Ville </label><br>
    <input type="text" id="ville" name="ville" placeholder="ville de la salle" 
    value="<?php if (isset($data['ville'])) echo $data['ville']; ?>" /> <br><br>

        <label for="cp">Code postal</label><br>
        <input type="integer" id="cp" name="cp" placeholder="code postal" value="<?php if (isset($data['cp'])) echo $data['cp']; ?> "> <br><br>

        <input type="submit" />
    </form> </div>

<?php
}

include('../templates/footer.php');
?>
