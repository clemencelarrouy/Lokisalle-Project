<?php 
require_once("../templates/init.inc.php");
include('../templates/nav.php');

// rechercher une salle 
?>

<div class="nouveauclient">
 <h2>RECHERCHER UNE SALLE PAR MOTS CLEFS </h2> <br>

	<?php $produit = $pdo->query('SELECT * FROM produit ORDER BY id_produit DESC');
if(isset($_GET['q']) AND !empty($_GET['q'])) {
   $q = htmlspecialchars($_GET['q']);
   $produit = $pdo->query('SELECT * FROM produit WHERE titre LIKE "%'.$q.'%" ORDER BY id_produit DESC');
   if($produit->rowCount() == 0) {
      $produit = $pdo->query('SELECT titre FROM produit WHERE CONCAT(titre, description,ville, adresse) LIKE "%'.$q.'%" ORDER BY id_produit DESC');
   }
}
?>
<form method="GET">
   <input type="search" name="q" placeholder="Recherche..." />
   <input type="submit" value="Valider" />
</form> <br>
<?php if($produit->rowCount() > 0) { ?>
   <ul>
   <?php while($a = $produit->fetch()) { ?>
      <li><a href=reservation_details.php?id_produit=<?php echo $a['id_produit'];?>><?= $a['titre'] 
      ?> </a> </li>
   <?php } ?>
   </ul>
<?php } else { 
     ?>
Aucun résultat pour: <?= $q ?>...
<?php }

// rechercher un creneaux horaire ?>
</div>

<div class="nouveauclient">
 <h2>RECHERCHER UN CRENEAUX HORAIRE  </h2> <br>
        <h5> Rechercher par date de debut</h5>


<form method="GET">
  <label for="date_arrivee">Choisir un créneau :</label>
  <select name="date_arrivee" id="date_arrivee"> <?php 

  $date_arrivee = $pdo->query("SELECT * FROM creneaux JOIN produit ON produit.id_produit = creneaux.id_produit ORDER BY date_arrivee ASC");
  $matching_products = [];

  echo " <option> Choisissez un horaire</option>";
 while ($da = $date_arrivee->fetch(PDO::FETCH_ASSOC)) {
     echo "<option value='" . $da['date_arrivee'] ."'>  $da[date_arrivee]</option>"; ?>
     <?php
     if (isset($_GET['date_arrivee']) && $da['date_arrivee'] === $_GET['date_arrivee']) {
        $matching_products[] = $da;
     }
 }
     ?>
   </select>  
   <input type="submit" value="Valider" />
</form> <br>  

<?php if($matching_products) { ?>
   <ul>
   <?php foreach($matching_products as $a) { ?>
      <li><a href=reservation_details.php?id_produit=<?= $a['id_produit'] ?>><?= $a['titre'] 
      ?> </a> </li>
   <?php } ?>
   </ul>
<?php } 
     ?>

 



        <br> <br> <h5> Rechercher par date de depart</h5>


<form method="GET">
  <label for="date_depart">Choisir un créneau :</label>
  <select name="date_depart" id="date_depart"> <?php 

  $date_depart = $pdo->query("SELECT * FROM creneaux JOIN produit ON produit.id_produit = creneaux.id_produit ORDER BY date_depart ASC");
  $matching_products = [];

  echo " <option> Choisissez un horaire</option>";
 while ($dp = $date_depart->fetch(PDO::FETCH_ASSOC)) {
     echo "<option value='" . $dp['date_depart'] ."'>  $dp[date_depart]</option>"; ?>
     <?php
     if (isset($_GET['date_depart']) && $dp['date_depart'] === $_GET['date_depart']) {
        $matching_products[] = $dp;
     }
 }
     ?>
   </select>  
   <input type="submit" value="Valider" />
</form> <br>  

<?php if($matching_products) { ?>
   <ul>
   <?php foreach($matching_products as $a) { ?>
      <li><a href=reservation_details.php?id_produit=<?= $a['id_produit'] ?>><?= $a['titre'] 
      ?> </a> </li>
   <?php } ?>
   </ul>
<?php }

?> </div> <?php 








 

include('../templates/footer.php');
?>
