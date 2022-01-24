<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FOOTER</title>
    <link rel="stylesheet" href="../css_loki.css" />
  </head>

  <body>


<div class="footer-general">
  <div class="cat-ge"><a href="../visiteurs/mentions.php"> Mentions légales</a> </div>
  <div class="cat-ge"><a href="../visiteurs/cgv.php">C.G.V </a></div> 
  <div class="cat-ge"><a href="../visiteurs/plan.php">Plan du site </a></div>
  <div class="cat-ge"><a href="#" onclick="javascript:window.print()">Imprimer la page</a></div> 

  <?php if (internauteEstConnecteEtEstAdmin()) { }
   elseif (internauteEstConnecte()) { ?>
   <div class="cat-ge"><a href="../visiteurs/newsletter.php" onclick="window.open(this.href);return false"
> S'inscrire à la newsletter </a> </div> 
  <div class="cat-ge"><a href="../visiteurs/contact.php"> Contact
</a> </div> 
<?php
} else { ?> 
  <div class="cat-ge"><a href="../visiteurs/contact.php"> Contact
</a> </div> <?php } ?>
</div>

  
</body>
</html>