<?php 
require_once("../templates/init.inc.php");
include('../templates/nav.php');


//--- Lien utiles ---//
$contenu .= '<br><a href="?action=affichage" class="select-cat-admin">Affichage des commandes</a> ';
$contenu .= '<a href="?action=ajout" class="select-cat-admin">Ajout d\'une commande </a><br><br><hr> ';



echo   $contenu ;
// modification de produits

// suppression de produits
if (isset($_GET['id_suppr'])) {
    $id = $_GET['id_suppr'];

    $pdo->query("DELETE FROM commande WHERE id_commande= $id ");
}

// Affichage des produits
if (isset($_GET['action']) and $_GET['action'] == 'affichage')
{
    $resultat = $pdo->query("SELECT * FROM commande");
    echo "
    <table class='tableau-produit'>
    <tr>
    <th>id commande</th>
    <th>id membre </th>
    <th>montant</th>
    <th> état </th>
    <th class='change'>modifier</th>
    <th class='change'>supprimer</th>
    </tr>";

    while ($datas = $resultat->fetch(PDO::FETCH_ASSOC)) 
    {
?>
        <tr>
            <td><?php echo $datas['id_commande']; ?></td>
            <td><?php echo $datas['id_membre']; ?></td>
            <td><?php echo $datas['montant']; ?></td>
            <td><?php echo $datas['etat']; ?></td>


            <td><a href="?id_modif=<?php echo $datas['id_commande']; ?>"> modifier </a></td>
            <td><a href="?id_suppr=<?php echo $datas['id_commande']; ?>"
             Onclick="return(confirm('êtes vous certain ?'))">suppimer</a></td>
        </tr>
    <?php
    } 
    echo "</table>";
}

if (!empty($_POST)) 
{

        if (isset($_GET['action']) and $_GET['action'] == 'ajout') 
        { 
            
           
            $pdo->exec("INSERT INTO commande(id_membre,montant,etat) VALUES('$_POST[id_membre]','$_POST[montant]','$_POST[etat]') ");
        }
}


if (isset($_GET['action']) and $_GET['action'] == 'ajout') 
{
    ?> <div class="nouveauclient">
        <h1> Formulaire ajout d'une commande manuelle </h1>
    <form method="post" enctype="multipart/form-data" action="">

        <input type="hidden" id="id_commande" name="id_commande" />

        <label for="id_membre">id du membre</label><br>
        <input type="integer" id="id_membre" name="id_membre"  /> <br><br>

        <label for="montant">montant</label><br>
        <input type="integer" id="montant" name="montant"  /> <br><br>
 
        <label for="etat"></label><br>
            <select name="etat" id="etat">
                    <option value="en cours de traitement">en cours de traitement</option>
                    <option value="envoyé">validé</option>
                    <option value="livré">fini</option>
            </select> <br>
        <input type="submit" />
    </form>
    </div>
    <?php 
}

// modification de produit


if (isset($_GET['id_modif'])) {
    $id = $_GET['id_modif'];

    if (!empty($_POST)) {
         $pdo->exec("UPDATE commande SET id_membre='$_POST[id_membre]', montant='$_POST[montant]', etat='$_POST[etat]'  WHERE id_commande=$id ");

        }
    

    $resultat = $pdo->query("SELECT * FROM commande WHERE id_commande=$id");
    $data = $resultat->fetch(PDO::FETCH_ASSOC);

?> <div class="nouveauclient">
<h1> Modification d'une Commande </h1>
    <form method="post" enctype="multipart/form-data" action="">

        <input type="hidden" id="id_commande" name="id_commande" value="<?php if (isset($data['id_commande'])) echo $data['id_commande']; ?>" />

        <label for="id_membre">id du membre</label><br>
        <input type="integer" id="id_membre" name="id_membre" value="<?php if (isset($data['id_membre'])) echo $data['id_membre']; ?>" /> <br><br>

        <label for="montant">montant</label><br>
        <input type="integer" id="montant" name="montant"  value="<?php if (isset($data['montant'])) echo $data['montant']; ?>" /> <br><br>


        <label for="etat"></label><br>
        <select name="etat" id="etat">
            <option value="en cours de traitement">en cours de traitement</option>
            <option value="envoyé">validé</option>
            <option value="livré">fini</option>
        </select> <br>

        <input type="submit" />
    </form>
</div>
<?php
}

include('../templates/footer.php');
?>
