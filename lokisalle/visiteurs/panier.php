<?php 
require_once("../templates/init.inc.php");
include('../templates/nav.php');


//debug($_POST);
if (isset($_GET['action']) AND $_GET['action']=='ajout_panier') {


     $resultat = $pdo->query(" SELECT * FROM creneaux  JOIN produit ON creneaux.id_produit = produit.id_produit WHERE id_creneaux = '$_POST[id_creneaux]' ");
    $produit = $resultat->fetch(PDO::FETCH_ASSOC);
   
    ajouterProduitDansPanier($produit);
}

// vider le panier
if (isset($_GET['action']) and $_GET['action'] == 'vider') {
    unset($_SESSION['panier']);
}



echo "<table border='1' style='border-collapse: collapse' cellpadding='7'>";
echo "<tr><td colspan='5'>Panier</td></tr>";
echo "<tr><th>Titre</th><th>Produit</th><th>ville</th><th>Prix Unitaire</th><th>creneaux</th></tr>";

// debug($_SESSION['panier']);
if (empty($_SESSION['panier'])) {
    echo "<tr><td colspan='5'> Votre panier est vide </td></tr>";
} else {
    foreach ($_SESSION['panier'] as $produit) {
        echo "<tr>";
        echo "<td>" . $produit['titre'] . "</td>";
        echo "<td>" . $produit['id_produit'] . "</td>";
        echo "<td>" . $produit['ville'] . "</td>";
        echo "<td>" . $produit['prix'] . "</td>";
        echo "<td>" . $produit['date_arrivee'] . ' - ' . $produit['date_depart'] . "</td>";
        echo "</tr>";
    }
}
echo "<tr><th colspan='3'>Total</th><td colspan='2'> " . montantTotal() . " euros</td></tr>";

echo '<form method="post" action="">';
echo '<tr><td colspan="5"><input type="submit" name="payer" value="Valider et déclarer le 
paiement"></td></tr>';
echo '</form>';
if (internauteEstConnecte()) { } else { 
echo '<tr><td colspan="3">Veuillez vous <a href="inscription.php">inscrire</a> ou vous <a 
href="connection.php">connecter</a> afin de pouvoir payer</td></tr>'; }

echo "<tr><td colspan='5'><a href='?action=vider'>Vider mon panier</a></td></tr>";

echo "</table><br>";

?>

<?php 
include('../templates/footer.php');
?>
