

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LOKISALLE</title>
    <meta
  name="description"
  content="Location de salle pour vos évènements privés et professionnels à Paris, Marseille, et Lyon. -15% sur votre première reservation"/>

    <link rel="stylesheet" href="../css_loki.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  </head>

  <body>


  <a href="../visiteurs/index.php"></div><div class="img-logo"><img src="../images/logo.jpg"></div>   </a>
 <div class="conteneur">

<?php 


if (internauteEstConnecteEtEstAdmin()) {?>

  <div class="nav-general">
    <div class="cat-ge"><a href="../visiteurs/index.php">Accueil  </a></div>
      <div class="cat-ge"><a href="../admin/gestion_creneaux.php">Gestion des creneaux </a></div>
      <div class="cat-ge"><a href="../admin/gestion_commandes.php">Gestion des commandes </a></div>
      <div class="cat-ge"><a href="../admin/gestion_salles.php">Gestion des salles </a></div> 
      <div class="cat-ge"><a href="../admin/gestion_membres.php">Gestion des membres </a></div> 
      <div class="cat-ge"><a href="../visiteurs/profil.php">Mon profil  </a></div>
      <div class="cat-ge"><a href="../visiteurs/deconnexion.php">Deconnexion </a></div> 
  </div> <?php
} elseif (internauteEstConnecte()) { ?>
  <div class="nav-general">
    <div class="cat-ge"><a href="../visiteurs/index.php">Accueil  </a></div>
    <div class="cat-ge"><a href="../visiteurs/reservation.php">Réservation </a></div>
    <div class="cat-ge"><a href="../visiteurs/recherche.php">Recherche </a></div> 
    <div class="cat-ge"><a href="../visiteurs/panier.php"> Panier</a></div> 
    <div class="cat-ge"><a href="../visiteurs/profil.php">Mon profil  </a></div>
    <div class="cat-ge"><a href="../visiteurs/deconnexion.php">Deconnexion </a></div> 
  </div> <?php } else { ?> 
  <div class="nav-general">
    <div class="cat-ge"><a href="../visiteurs/index.php">Accueil  </a></div>
    <div class="cat-ge"><a href="../visiteurs/reservation.php">Réservation </a></div>
    <div class="cat-ge"><a href="../visiteurs/recherche.php">Recherche </a></div> 
    <div class="cat-ge"><a href="../visiteurs/connection.php"> Connexion</a></div> 
    <div class="cat-ge"><a href="../visiteurs/inscription.php"> Inscription </a></div> 
  </div>
 <?php 
 } 


  

  
  
?>
  
  
  

</body>
</html>