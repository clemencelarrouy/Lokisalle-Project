<?php 
require_once("../templates/init.inc.php");
include('../templates/nav.php');

?>

 <div class="resa-afaire">
     <h2>   NOS SALLES A RESERVER </h2> <br>

     <?php
//php pour trier par catégorie
$categories = $pdo->query("SELECT DISTINCT ville FROM produit ");





echo "</div> <div class='catt'>";
echo " <h4>RECHERCHE PAR VILLE </h4>";
echo "<div class='liste-plan'>";
echo "<ul>";
while ($cat = $categories->fetch(PDO::FETCH_ASSOC)) {
    echo "<h5><li>";
    echo "<a href='?ville=" . $cat['ville'] . "'>" . $cat['ville'] . "</a>";
    echo "</li></h5>";
}
echo "</ul>";
echo "</div> </div>";

// php pour afficher toutes les salles sans trie



if (isset($_GET['ville'])) {
    $prodParCategorie = $pdo->query("SELECT * FROM produit WHERE ville= '$_GET[ville]'");
    
    

 //echo "SELECT * FROM produit WHERE categorie= '$_GET[categorie]' ";
    while ($produits = $prodParCategorie->fetch(PDO::FETCH_ASSOC))  { 
        $query = $pdo->query("SELECT MIN(prix) AS prix_minimal FROM creneaux WHERE id_produit = '$produits[id_produit]'");
        $prix_minimal = $query->fetch(PDO::FETCH_ASSOC); ?>

<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10">
            <div class="row p-2 bg-white border rounded">
                <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" 
                src= "<?php echo $produits['photo']; ?>" ></div>

                 <div class="col-md-6 mt-1"><h5><?php echo $produits['titre']; 
                 ?></h5>
                
                    <span>catégorie</span> <?php echo $produits['categorie']; ?>
                    <span class="dot"></span>
                    <span>capacité </span><?php echo $produits['capacite']; ?>
                    <span class="dot"></span>
                    <span><?php echo $produits['adresse'] ?></span>
                    <span class="dot"> </span>
                    <span><?php echo $produits['ville']; ?></span> </div>
                <div class="mt-1 mb-1 spec-1">    
                </div>
                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                    <div class="d-flex flex-row align-items-center">
                     <?php if ($prix_minimal['prix_minimal']){ ?>
 <h4 class="mr-1"> à partir de <?php echo $prix_minimal
['prix_minimal']; ?> € </h4>
 <?php } else { echo "Indisponible"; } ?>
                    </div>
                    <div class="d-flex flex-column mt-4"><button class="btn btn-primary btn-smm" type="button">
                       <?php 
                       if (internauteEstConnecte()) { 
                       echo  "<a href=reservation_details.php?id_produit=$produits[id_produit]> Reservez</a>"; }
                       else { echo  "<a href='connection.php'>Connectez vous pour reserver</a>"; }
                       ?>
                       </button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
   <?php  }
} else {
    $resultat = $pdo->query("SELECT * FROM produit");
    $resultatcreneaux = $pdo->query(" SELECT * FROM creneaux ");

    while ($produits = $resultat->fetch(PDO::FETCH_ASSOC)) {
         $query = $pdo->query("SELECT MIN(prix) AS prix_minimal FROM creneaux WHERE id_produit = '$produits[id_produit]'");
    $prix_minimal = $query->fetch(PDO::FETCH_ASSOC); ?>

<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10">
            <div class="row p-2 bg-white border rounded">
                <div class="col-md-3 mt-1">
                    <img class="img-fluid img-responsive rounded product-image" src= "<?php echo $produits['photo']; ?>" >
                </div>
                <div class="col-md-6 mt-1"><h5><?php echo $produits['titre']; ?></h5>
                    <div class="mt-1 mb-1 spec-1">
                        <span>catégorie</span> <?php echo $produits['categorie']; ?>
                        <span class="dot"></span>
                        <span>capacité </span><?php echo $produits['capacite']; ?>
                        <span class="dot"></span>
                        <span><?php echo $produits['adresse'] ?></span>
                        <span class="dot"> </span>
                        <span><?php echo $produits['ville']; ?></span> </div>
                    <div class="mt-1 mb-1 spec-1">
                    
                </div>

                <p class="text-justify text-truncate para mb-0">  <?php echo $produits['description']; ?> <br><br></p>
                </div>
                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                    <div class="d-flex flex-row align-items-center">
                        <?php if ($prix_minimal['prix_minimal']){ ?>
                        <h4 class="mr-1"> à partir de <?php echo $prix_minimal['prix_minimal']; ?> € </h4>
                        <?php } else { echo "Indisponible"; } ?>
                        
                    </div>
                    <div class="d-flex flex-column mt-4"><button class="btn btn-primary btn-smm" type="button">
                       <?php if (internauteEstConnecte()) { 
                            echo  "<a href=reservation_details.php?id_produit=$produits[id_produit]> 
                        Reservez</a>"; }
else { echo  "<a href='connection.php'>Connectez vous pour reserver</a>"; }?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php 
    }
}




include('../templates/footer.php');
?>
