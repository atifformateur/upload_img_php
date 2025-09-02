<?php
/**
 * Test simple de la route products
 */

// Charger la configuration
require_once '../bootstrap.php';

echo "<h2>Test de la route products</h2>";

// Vérifier que les fonctions existent
$functions = [
    'products_index',
    'products_create', 
    'products_store',
    'products_edit',
    'products_update',
    'products_delete'
];

echo "<h3>Fonctions du contrôleur :</h3>";
foreach ($functions as $function) {
    if (function_exists($function)) {
        echo "✅ $function() existe<br>";
    } else {
        echo "❌ $function() n'existe pas<br>";
    }
}

// Vérifier que le modèle fonctionne
echo "<h3>Test du modèle :</h3>";
try {
    $products = get_all_products();
    echo "✅ get_all_products() fonctionne - " . count($products) . " produit(s) trouvé(s)<br>";
} catch (Exception $e) {
    echo "❌ Erreur get_all_products() : " . $e->getMessage() . "<br>";
}

echo "<h3>Test des URLs :</h3>";
echo "URL racine : " . url('products') . "<br>";
echo "URL création : " . url('products/create') . "<br>";

echo "<br><a href='" . url('products') . "'>🔗 Tester la page des produits</a>";
?>
