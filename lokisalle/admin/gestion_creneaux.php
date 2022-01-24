<?php 
require_once("../templates/init.inc.php");
include('../templates/nav.php');


//--- Lien utiles ---//
$contenu .= '<br><a href="?action=affichage" class="select-cat-admin">Affichage des creneaux</a> ';
$contenu .= '<a href="?action=ajout" class="select-cat-admin">Ajout d\'un creneaux</a><br><br><hr> ';



echo   $contenu ;
// modification de produits

// suppression de produits
if (isset($_GET['id_suppr'])) {
    $id = $_GET['id_suppr'];
    $resultat = $pdo->query("SELECT * FROM creneaux WHERE id_produit= $id");


    $pdo->query("DELETE FROM creneaux WHERE id_produit= $id ");
}

// Affichage des produits
if (isset($_GET['action']) and $_GET['action'] == 'affichage')
{
    $resultat = $pdo->query("SELECT * FROM creneaux");
    echo "
    <table class='tableau-produit'>
    <tr>
    <th>id du creneaux</th><th>date d'arrivée </th><th>date de départ </th><th> id de la salle </th><th> prix </th><th>etat</th class='change'><th>modifier</th><th class='change'>supprimer</th> 
    </tr>";

    while ($datas = $resultat->fetch(PDO::FETCH_ASSOC)) 
    {
?>
        <tr>
            <td><?php echo $datas['id_creneaux']; ?></td>
            <td><?php echo $datas['date_arrivee']; ?></td>
            <td><?php echo $datas['date_depart']; ?></td>
            <td><?php echo $datas['id_produit']; ?></td>
            <td><?php echo $datas['prix']; ?></td>
            <td><?php echo $datas['etat']; ?></td>
            <td><a href="?id_modif=<?php echo $datas['id_produit']; ?>">modifier </a></td>
            <td><a href="?id_suppr=<?php echo $datas['id_produit']; ?>" Onclick="return(confirm('êtes vous certain ?'))">suppimer</a></td>
        </tr>
    <?php
    } 
    echo "</table>";
}

if (!empty($_POST)) 
{

        if (isset($_GET['action']) and $_GET['action'] == 'ajout') 
        { 
         //   print_r($_POST);
            
           
            $pdo->exec("INSERT INTO creneaux(date_arrivee,date_depart,id_produit,prix,etat) VALUES('$_POST[date_arrivee]','$_POST[date_depart]','$_POST[id_produit]','$_POST[prix]','$_POST[etat]') ");
        }
}


if (isset($_GET['action']) and $_GET['action'] == 'ajout') 
{
    ?> <div class="nouveauclient">
        <h1> Formulaire ajout d'un creneau </h1>
    <form method="post" enctype="multipart/form-data" action="">

        <input type="hidden" id="id_produit" name="id_produit" />

        <label for="date_arrivee">date d'arrivée</label><br>
        <input type="date" id="date_arrivee" name="date_arrivee"  /> <br><br>

        <label for="date_depart">date de départ</label><br>
        <input type="date" id="date_depart" name="date_depart"  /> <br><br>


        <label for="id_produit">nom de la salle</label><br>
        <select id="id_produit" name="id_produit">
            <?php
            $resultat = $pdo->query("SELECT * FROM produit");
            while ($datas2 = $resultat->fetch(PDO::FETCH_ASSOC)) {

                echo "<option value='" . $datas2['id_produit'] . "'>$datas2[titre]</option>";
            }
            ?>
        </select><br><br>


        <label for="prix">prix</label><br>
        <input type="integer" id="prix" name="prix" placeholder="prix" /> <br><br>

        <label for="etat">etat</label><br>
        <input type="integer" id="etat" name="etat" placeholder="etat de la salle" /> 
        <br><br>

        <input type="submit" />
    </form>
    </div>
    <?php 
}

// modification de produit


if (isset($_GET['id_modif'])) {
    $id = $_GET['id_modif'];

    if (!empty($_POST)) {
             $pdo->exec("UPDATE creneaux SET date_arrivee='$_POST[date_arrivee]', date_depart='$_POST[date_depart]',id_produit='$_POST[id_produit]',prix='$_POST[prix]',etat='$_POST[etat]' WHERE id_produit=$id ");
        }
    

    $resultat = $pdo->query("SELECT * FROM creneaux WHERE id_produit=$id");
    $data = $resultat->fetch(PDO::FETCH_ASSOC);

?> <div class="nouveauclient">
<h1> Modification d'un Créneaux </h1>
    <form method="post" enctype="multipart/form-data" action="">

        <input type="hidden" id="id_produit" name="id_produit" value="<?php if (isset($data['id_produit'])) echo $data['id_produit']; ?>" />

        <label for="date_arrivee">reference</label><br>
        <input type="date" id="date_arrivee" name="date_arrivee" value="<?php if (isset($data['date_arrivee'])) echo $data['date_arrivee']; ?>" /> <br><br>

        <label for="date_depart">categorie</label><br>
        <input type="date" id="date_depart" name="date_depart"  value="<?php if (isset($data['date_depart'])) echo $data['date_depart']; ?>" /> <br><br>

        <label for="id_produit">id de la salle à attribuer</label><br>
        <input type="integer" id="id_produit" name="id_produit"  value="<?php if (isset($data['id_produit'])) echo $data['id_produit']; ?>" /> <br><br>

        <label for="prix">prix</label><br>
        <input type="integer" id="prix" name="prix"  value="<?php if (isset($data['prix'])) echo $data['prix']; ?>" /> <br><br>

        <label for="etat">etat</label><br>
        <input type="integer" id="etat" name="etat"  value="<?php if (isset($data['etat'])) echo $data['etat']; ?>" /> <br><br>

        <input type="submit" />
    </form>
 </div>
<?php
}

include('../templates/footer.php');
?>
