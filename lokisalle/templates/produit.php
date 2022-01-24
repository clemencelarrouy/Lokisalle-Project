<?php
require_once("init.inc.php");
include('nav.php');
 ?>



<div class="base-produit"> 
    <div class="detail-produit">

    <img src="../images/salles/46841.jpg"  >

        <div class="detail-produit-block">
            <h2>  $produit['nom'] </h2> 
            <p> <u>Catégorie :</u>  $produit['categorie'] </p> 
            <p> <u>Capacité :</u>  $produit['capacite'] </p> 
            <p> <u>Description :</u> $produit['description'] </p>
            <br>
            <p> <u>Adresse :</u> $produit['adresse'] </p>
            <p> <u>Date d'arrivée :</u> $produit['date_arrivee'] </p>
            <p> <u>Date de départ :</u> $produit['date_depart']  </p>
            <p> <u>Prix :</u> $produit['prix']  </p>
        </div>
 <p>  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2144.3546012871266!2d-1.
0558249952008982!3d43.72900930864409!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.
1!3m3!1m2!1s0xd56a621d31d0c13%3A0xf80030748319725c!2zQ3LDqGNoZQ!5e0!3m2!1sfr!2sfr!4v1610462060950!5m2!1sfr!2sf
r" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" 
tabindex="0"></iframe>  <!--$produit['plan']--> </p>
         
            
        
    </div>

 <input type='submit' name='ajout_panier' value='ajouter au panier' class="bouton-panier"> 

</div>




<?php
include('footer.php');
?>
