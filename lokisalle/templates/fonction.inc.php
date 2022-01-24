<?php

function debug($variable, $mode = 1)
{
    if ($mode == 1) {
        echo '<pre>';
        echo print_r($variable);
        echo '</pre>';
    }
    if ($mode == 2) {
        echo '<pre>';
        echo var_dump($variable);
        echo '</pre>';
    }
}

function internauteEstConnecte()
{
    if (isset($_SESSION['membre'])) {
        return true;
    } else {
        return false;
    }
}

function internauteEstConnecteEtEstAdmin()
{
    if (internauteEstConnecte() && $_SESSION['membre']['statut'] == 1) {
        //die("ok if");
        return true;
    } else {
        //die("ok else");
        return false;
    }
}

// cette fonction permet de créer un panier s'il n'existe pas encore

function creationDuPanier()
{
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
    } 
}

function ajouterProduitdansPanier($produit)
{
    creationDuPanier();
    $id_produit = $produit['id_produit']; 
    // si rentre dans le panier avec le même produit  on  entrera dans le if
    if (isset($_SESSION['panier'][$id_produit])) {
        echo "ce produit est deja dans votre panier";
    }
    // à chaque fois qu'on rajouter un nouveau produit on va entrer dans le else
    else {
        $_SESSION['panier'][$id_produit] = $produit;
    }
}

function montantTotal()
{
    $total = 0;
    if (!empty($_SESSION['panier'])) {
        foreach ($_SESSION['panier'] as $produit) {
            $total += $produit['prix'];
        }
    }
    // cette fonction permet d'arrondir à 2 chiffres après la virgule
    return round($total, 2);
}

?>