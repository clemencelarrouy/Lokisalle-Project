
<?php 
require_once("../templates/init.inc.php");
include('../templates/nav.php');

?>


<div class="presentation-index">
    <div class="text-index">

    <h1> UNE SALLE CLEF EN MAIN A TOUS MOMENT </h1>
    <br>
        Trouvez en quelques minutes le lieu idéal pour votre événement d'entreprise ou privés à Paris, Marseille et Lyon.

    LOKISALLE a selectionné les meilleures salles de séminaire, réunion et conférence de la capitale et vous fait économiser un temps précieux dans vos recherches.

    Vous bénéficiez des mêmes tarifs qu'en direct et centralisez toutes vos demandes sur la seule plateforme réservée aux entreprises ainsi qu'aux particuliers.

    Séminaire, réunion, cocktail, conférence,mariage, soirée... quel que soit votre événement, vous trouverez la salle qu'il vous faut, au meilleur prix et sans perdre de temps.
    </div>
    
    <img src="../images/salles/8_55239.jpg" class="photo-index" >
    </div> 
</div> 
    
    
<div class="offres-index">

<h2> NOS DERNIERES OFFRES</h2>

<?php 

         $resultat = $pdo->query("SELECT * FROM produit ORDER BY id_produit ASC LIMIT 3 ");

          while ($produits = $resultat->fetch(PDO::FETCH_ASSOC)) {
              $query = $pdo->query("SELECT MIN(prix) AS prix_minimal FROM creneaux WHERE 
id_produit = '$produits[id_produit]'" );
$prix_minimal = $query->fetch(PDO::FETCH_ASSOC); ?>

<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10">
            <div class="row p-2 bg-white border rounded">
                <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded 
product-image" 
                src= "<?php echo $produits['photo']; ?>" ></div>
                <div class="col-md-6 mt-1">
                <h5><?php echo $produits['titre']; ?></h5>
                    <span>catégorie</span> <?php echo $produits['categorie']; ?>
                    <span class="dot"></span>
                    <span>capacité </span><?php echo $produits['capacite']; ?>
                    <span class="dot"></span>
                    <span><?php echo $produits['adresse'] ?></span>
                    <span class="dot"> </span>
                    <span><?php echo $produits['ville']; ?></span> </div>
                <div class="mt-1 mb-1 spec-1">    
                </div>
                <div class="align-items-center align-content-center col-md-3 border-left 
mt-1">
                    <div class="d-flex flex-row align-items-center">
                        <h4 class="mr-1"> 
                        <?php if ($prix_minimal['prix_minimal']){ ?>
                 à partir de <?php echo $prix_minimal['prix_minimal']; ?> € 
  <?php } else { echo "Indisponible"; 
} ?>

 </h4>
                    </div>
                    <div class="d-flex flex-column mt-4"><button class="btn btn-primary 
btn-smm" type="button">
                       <?php echo  "<a href=reservation_details.php?id_produit=$produits[id_produit]>Détails</a>"; ?>
                       </button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
  </div> 
            
           <?php  } ?>
          
 <div class="presentation-index">

 <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d656.5971349117159!2d2.353835929261496!3d48.831727081517975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6718dee23a4d7%3A0x65f846b3bb97d6f9!2sPlace%20d&#39;Italie%2C%2075013%20Paris!5e0!3m2!1sfr!2sfr!4v1610812267245!5m2!1sfr!2sfr" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> 

    <div class="text-index">
        <h2>   QUI SOMMES-NOUS ? </h2>
        Lokisalle est le service permettant aux entreprises de réserver simplement le lieu idéal pour leurs réunions, séminaires, conférences ou formations.
        Lokisalle a été créée en décembre 2013 par Arnaud Katz, Michael Zribi et Kévin Dréno.

Être au contact de professionnels qui perdaient beaucoup trop de temps à rechercher des espaces de travail et d'entreprises disposant d'espaces sous utilisés, les a mené à Bird Office : le site de location de salles de réunion, de formation, de séminaire ou de conférence. une équipe de passionnés qui souhaite simplifier la vie des entreprises en leur donnant accès à des salles de réunion, de formation ou de conférence au meilleur prix et en quelques minutes.

 </div>


          </div>
<?php
include('../templates/footer.php');

?>
