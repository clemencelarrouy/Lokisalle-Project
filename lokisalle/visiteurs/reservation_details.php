<?php 
require_once("../templates/init.inc.php");
include('../templates/nav.php');



if (isset($_GET['id_produit'])) {
    $resultat = $pdo->query(" SELECT * FROM produit WHERE id_produit= '$_GET[id_produit]' ");
    $produit = $resultat->fetch(PDO::FETCH_ASSOC);
    $resultatcreneaux = $pdo->query(" SELECT * FROM creneaux WHERE id_produit= '$_GET[id_produit]' ");
    $creneaux = [];
        $prix_minimum = PHP_INT_MAX;

    while ($creneau = $resultatcreneaux->fetch(PDO::FETCH_ASSOC)) {
    $creneaux[] = $creneau;
    if ($prix_minimum > $creneau['prix']) {
        $prix_minimum = $creneau['prix'];
    }
}

?>

<link rel='stylesheet' href='https://sachinchoolur.github.io/lightslider/dist/css/lightslider.css'>
<div class="fiche-prod">
<div class="container-fluid mt-2 mb-3">
    <div class="row no-gutters">
        <div class="col-md-5 pr-2">
            <div class="card">
                <div class="demo">
                    <ul id="lightSlider">
                        <li data-thumb="https://i.imgur.com/KZpuufK.jpg"> <img src= "<?php echo $produit['photo']; ?>" > </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="about"> <span class="font-weight-bold"><h5> <?php echo $produit['titre']; ?> </h5></span>
                    <h4 class="font-weight-bold"> <?php if ($creneaux ){ ?>
            <h4 class="mr-1"> à partir de <?php echo $prix_minimum; ?> € </h4>   </div>
            <div class="buttons"> 

            <form method='post' action='panier.php?action=ajout_panier'> <input type='submit' 
            name='ajout_panier'value='ajouter au panier' class="btn btn-warning btn-long 
            buy"> </div>
            <?php } else { echo "Indisponible </h4>"; } ?>
                     
              
              
              
                <hr>
                <div class="product-description">
                    <div><span class="font-weight-bold">Catégorie :</span><span> <?php echo $produit['categorie']; ?> </span><br>
                <span class="font-weight-bold">Capacité :</span><span> <?php echo $produit['capacite']; ?> personnes </span><br><span class="font-weight-bold">adresse:</span> <span> <?php  echo " " . $produit['adresse'] . " " . $produit['cp'] . " " . $produit['ville']; ?> </span><br>
                
                <span> 
                     <span class="font-weight-bold"><label for="date_arrivee">Choisir un créneau :</label>  <?php if ($creneaux ){ ?>
                     <select name="id_creneaux" id="dates_arrivee"> 

                         <?php foreach ($creneaux as $creneau)  { ?>

                         <option value="<?php echo $creneau['id_creneaux'];  ?>">
                              <?php echo $creneau['date_depart'] . ' - ' . $creneau['date_arrivee']; }?>
                        </option>
                        </select>  <?php } ?>
                        </form>
                </span> <br>

</span><br> 

            
            </span><br></div>
                   
                    <div class="mt-2"> <span class="font-weight-bold">Description</span>
                        <p> <?php echo $produit['description'] ?></p>
                        <div class="bullets">
                            <span class="font-weight-bold">Vos avantages à reserver chez nous : </span>
                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text">Aucun frais de réservation</span> </div>
                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text">Annulation gratuite jusqu'à la veille</span> </div>
                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text">98% de client satisfait</span> </div>
                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text">Anti-covid : desinfectées par des professionels</span> </div>
                        </div>
                    </div>
                    
                    <div class="d-flex flex-row align-items-center"> 
                        <div class="d-flex flex-column ml-1 comment-profile">
                        
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-2"> <span>Salles similaires :</span>
                <div class="similar-products mt-2 d-flex flex-row">

<?php 

         $resultat = $pdo->query("SELECT * FROM produit ORDER BY 
id_produit LIMIT 5 ");

          while ($produits = $resultat->fetch(PDO::FETCH_ASSOC)) {
              $query = $pdo->query("SELECT MIN(prix) AS prix_minimal 
FROM creneaux WHERE 
id_produit = '$produits[id_produit]'");
$prix_minimal = $query->fetch(PDO::FETCH_ASSOC); ?>


                    <div class="card border p-1" style="width: 9rem;margin-right: 3px;"> 
                    <?php echo  "<a href=reservation_details.php?id_produit=$produits[id_produit]>"; ?>

<img src="<?php echo $produits['photo']; ?>" class="card-img-top" alt="...">

                        <div class="card-body">
                            <h6 class="card-title">
                            <?php echo $produits['titre']; ?> <br>
                             <?php 
                                 echo $produits['ville']; ?> </h6>
                        </div> </a> </div>
                        <?php } ?>
                    





                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- espace commentaire-->

<?php

if(isset($_GET['id']) AND !empty($_GET['id'])) {
   $getid = htmlspecialchars($_GET['id']);
   $article = $bdd->prepare('SELECT * FROM produits WHERE id = ?');
   $article->execute(array($getid));
   $article = $article->fetch();
   if(isset($_POST['submit_commentaire'])) {
      if(isset($_POST['pseudo'],$_POST['commentaire']) AND !empty($_POST['pseudo']) AND !empty($_POST
['commentaire'])) {
         $pseudo = htmlspecialchars($_POST['pseudo']);
         $commentaire = htmlspecialchars($_POST['commentaire']);
         if(strlen($pseudo) < 25) {
            $ins = $bdd->prepare('INSERT INTO commentaires (pseudo, commentaire, id_produit) VALUES (?,
?,?)');
            $ins->execute(array($pseudo,$commentaire,$getid));
            $c_msg = "<span style='color:green'>Votre commentaire a bien été posté</span>";
         } else {
            $c_msg = "Erreur: Le pseudo doit faire moins de 25 caractères";
         }
      } else {
         $c_msg = "Erreur: Tous les champs doivent être complétés";
      }
   }
   $commentaires = $bdd->prepare('SELECT * FROM commentaires WHERE id_produit = ? ORDER BY id DESC');
   $commentaires->execute(array($getid));
?>

<h2>Article:</h2>
<p><?= $article['contenu'] ?></p>
<br />
<h2>Commentaires:</h2>
<form method="POST">
   <input type="text" name="pseudo" placeholder="Votre pseudo" /><br />
   <textarea name="commentaire" placeholder="Votre commentaire..."></textarea><br />
   <input type="submit" value="Poster mon commentaire" name="submit_commentaire" />
</form>
<?php if(isset($c_msg)) { echo $c_msg; } ?>
<br /><br />
<?php while($c = $commentaires->fetch()) { ?>
   <b><?= $c['pseudo'] ?>:</b> <?= $c['commentaire'] ?><br />
<?php } ?>
<?php
}
?>




<?php

if (isset($_GET['id_produit']))  {
   $getid = htmlspecialchars($_GET['id_produit']);
   $article = $pdo->prepare('SELECT * FROM produit WHERE id_produit = ?');
   $article->execute(array($getid));
   $article = $article->fetch();
   if(isset($_POST['submit_commentaire'])) {
      if(isset($_POST['pseudo'],$_POST['commentaire']) AND !empty($_POST['pseudo']) AND !empty($_POST['commentaire'])) {
         $pseudo = htmlspecialchars($_POST['pseudo']);
         $commentaire = htmlspecialchars($_POST['commentaire']);
         if(strlen($pseudo) < 25) {
            $ins = $pdo->prepare('INSERT INTO commentaires (pseudo, commentaire, id_produit) VALUES (?,?,?)');
            $ins->execute(array($pseudo,$commentaire,$getid));
            $c_msg = "<span style='color:green'>Votre commentaire a bien été posté</span>";
         } else {
            $c_msg = "Erreur: Le pseudo doit faire moins de 25 caractères";
         }
      } else {
         $c_msg = "Erreur: Tous les champs doivent être complétés";
      }
   }
   $commentaires = $pdo->prepare('SELECT * FROM commentaires WHERE id_produit = ? ORDER BY id DESC');
   $commentaires->execute(array($getid));
?>


<div class="nouveauclient">
<h2>Commentaires:</h2>
<form method="POST">
   <input type="text" name="pseudo" placeholder="Votre pseudo" /><br /> <br>
   <textarea name="commentaire" placeholder="Votre commentaire..."></textarea><br />
   <input type="submit" value="Poster mon commentaire" name="submit_commentaire" />
</form>
<?php if(isset($c_msg)) { echo $c_msg; } ?>
<br /><br />
<?php while($c = $commentaires->fetch()) { ?>
   <b><?= $c['pseudo'] ?>:</b> <br> <?= $c['commentaire'] ?><br /> <hr> 
<?php } ?>
<?php
}
?> </div>





<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'></script>
<script src='https://sachinchoolur.github.io/lightslider/dist/js/lightslider.js'></script>
<script>
    $('#lightSlider').lightSlider({
        gallery: true,
        item: 1,
        loop: true,
        slideMargin: 0,
        thumbItem: 9
    });
</script>




<?php
}
include('../templates/footer.php');
?>
