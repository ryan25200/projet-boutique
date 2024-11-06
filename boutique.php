<?php

// ----------------- initialisation et affichage des noms des articles -----------------

$nomArticles = ["🧦 Chaussettes", "👕 T-shirts", "👟 Chaussures", "👖 Pantalons", "👓 Lunettes"];

for ($i=0; $i<count($nomArticles); $i++) {
    echo "$nomArticles[$i]\n";
}

echo PHP_EOL;
foreach($nomArticles as $i => $nomArticle) {
    echo "$nomArticles[$i]\n";
}

// ----------------- initialisation et affichage des stocks -----------------

$quantiteStock = [10, 5, 8, 3, 12];

echo PHP_EOL;
for ($j=0; $j<count($quantiteStock); $j++) {
    echo "Il y a actuellement en stock : $quantiteStock[$j] $nomArticles[$j]\n";
}

// ----------------- Simulation d'une vente dans la boutique -----------------

$choixArticle = (int)readline("Saisir un article (par son index) : ");
$quantiteArticle = (int)readline("Saisir la quantité : ");

// Vérification du stock suffisant
if ($quantiteArticle <= 0 || $quantiteArticle > $quantiteStock[$choixArticle]) {
    echo "Le stock est insuffisant ❌\n";
    return;
}

// Mise à jour du stock après la vente
$quantiteStock[$choixArticle] -= $quantiteArticle;

// Message de confirmation de vente réussie
echo "✅ Vente réussie ! Vous avez acheté $quantiteArticle $nomArticles[$choixArticle].\n";
echo "Il reste en stock : {$quantiteStock[$choixArticle]} $nomArticles[$choixArticle].\n";

// ----------------- Simulation du réapprovisionnement dans la boutique -----------------

$choixReapprovisionnement = readline("Saisir un article à réapprovisionner (par son index) : ");
$quantiteReapprovisionnement = readline("Saisir la quantité à ajouter au stock : ");

// Vérification de l'index de l'article et de la quantité à ajouter
if ($choixReapprovisionnement < 0 || $choixReapprovisionnement >= count($nomArticles)) {
    echo "L'article choisi pour le réapprovisionnement n'existe pas. Veuillez entrer un index valide. ❌\n";
    return;
}

if ($quantiteReapprovisionnement <= 0) {
    echo "La quantité de réapprovisionnement doit être supérieure à 0 ❌.\n";
    return;
}

// Mise à jour du stock après le réapprovisionnement
$quantiteStock[$choixReapprovisionnement] += $quantiteReapprovisionnement;

// Message de confirmation du réapprovisionnement
echo "La nouvelle quantité en stock de $nomArticles[$choixReapprovisionnement] est de {$quantiteStock[$choixReapprovisionnement]}.\n";

// ----------------- Synthèse et affichage du stock -----------------

for ($i = 0; $i < count($nomArticles); $i++) {
    if ($quantiteStock[$i] == 0) {
        echo "$nomArticles[$i] : En rupture de stock ❌\n";
    } else {
        echo "$nomArticles[$i] : {$quantiteStock[$i]} en stock\n";
    }
}

// ----------------- Suivi des ventes -----------------

$ventesTotales = [];

for ($i = 0; $i < count($nomArticles); $i++) {
    $ventesTotales[$i] = 0; // Initialise chaque index à 0
}

// Mise à jour des ventes après la vente initiale
$ventesTotales[$choixArticle] += $quantiteArticle; // Ajoute la quantité vendue

// Affichage du suivi des ventes totales
echo "\n--- Suivi des ventes totales par article ---\n\n";
foreach ($nomArticles as $i => $article) {
    echo "$article : {$ventesTotales[$i]} vendus\n"; // Affichage des ventes
}

// ----------------- Suppression d'un Article -----------------

// Demande à l'utilisateur de choisir l'article à supprimer
$indexSuppression = (int)readline("Saisir l'index de l'article à supprimer 🗑️ : ");

// Vérifie que l'index est valide
if ($indexSuppression >= 0 && $indexSuppression < count($nomArticles)) {
    $nouveauNomArticles = [];
    $nouveauQuantiteStock = [];

    // Construit les nouveaux tableaux sans l'article à supprimer
    for ($i = 0; $i < count($nomArticles); $i++) {
        if ($i != $indexSuppression) {
            $nouveauNomArticles[] = $nomArticles[$i];
            $nouveauQuantiteStock[] = $quantiteStock[$i];
        }
    }

    // Remplace les tableaux originaux par les versions mises à jour
    $nomArticles = $nouveauNomArticles;
    $quantiteStock = $nouveauQuantiteStock;

    echo "L'article a été supprimé avec succès 🗑️\n";

    // Affiche la liste des articles restants
    echo "\n--- Liste des articles restants ---\n\n";
    foreach ($nomArticles as $i => $article) {
        echo "$article : {$quantiteStock[$i]} en stock 📉\n";
    }
} else {
    echo "Index invalide. Aucun article supprimé.\n";
}