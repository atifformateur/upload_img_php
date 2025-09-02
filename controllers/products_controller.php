<?php
/**
 * Contrôleur des produits
 */

require_once MODEL_PATH . '/product_model.php';

/**
 * Liste tous les produits
 */
function products_index() {
    $products = get_all_products();
    load_view_with_layout('products/index', ['products' => $products, 'title' => 'Produits']);
}

/**
 * Formulaire de création d'un produit
 */
function products_create() {
    load_view_with_layout('products/create', ['title' => 'Nouveau produit']);
}

/**
 * Traitement de la création d'un produit
 */
function products_store() {
    if (!is_post()) {
        redirect('products');
    }
    
    $name = clean_input(post('name'));
    $description = clean_input(post('description'));
    $price = (float) post('price');
    
    // Validation simple
    if (empty($name) || empty($price)) {
        set_flash('error', 'Le nom et le prix sont obligatoires');
        redirect('products/create');
    }
    

    // Upload de l'image
    $image_filename = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_filename = upload_product_image($_FILES['image']);
        if (!$image_filename) {
            set_flash('error', 'Erreur lors de l\'upload de l\'image');
            redirect('products/create');
        }
    }
    
    // Créer le produit
    if (create_product($name, $description, $price, $image_filename)) {
        set_flash('success', 'Produit créé avec succès');
    } else {
        set_flash('error', 'Erreur lors de la création du produit');
    }
    
    redirect('products');
}

/**
 * Formulaire d'édition d'un produit
 */
function products_edit($id) {
    $product = get_product_by_id($id);
    if (!$product) {
        set_flash('error', 'Produit introuvable');
        redirect('products');
    }
    
    load_view_with_layout('products/edit', ['product' => $product, 'title' => 'Modifier le produit']);
}

/**
 * Traitement de la modification d'un produit
 */
function products_update($id) {
    if (!is_post()) {
        redirect('products');
    }
    
    $product = get_product_by_id($id);
    if (!$product) {
        set_flash('error', 'Produit introuvable');
        redirect('products');
    }
    
    $name = clean_input(post('name'));
    $description = clean_input(post('description'));
    $price = (float) post('price');
    
    // Validation simple
    if (empty($name) || empty($price)) {
        set_flash('error', 'Le nom et le prix sont obligatoires');
        redirect('products/edit/' . $id);
    }
    
    // Upload de la nouvelle image
    $image_filename = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_filename = upload_product_image($_FILES['image']);
        if (!$image_filename) {
            set_flash('error', 'Erreur lors de l\'upload de l\'image');
            redirect('products/edit/' . $id);
        }
        
        // Supprimer l'ancienne image
        if ($product['image']) {
            delete_product_image($product['image']);
        }
    }
    
    // Mettre à jour le produit
    if (update_product($id, $name, $description, $price, $image_filename)) {
        set_flash('success', 'Produit modifié avec succès');
    } else {
        set_flash('error', 'Erreur lors de la modification du produit');
    }
    
    redirect('products');
}

/**
 * Suppression d'un produit
 */
function products_delete($id) {
    $product = get_product_by_id($id);
    if (!$product) {
        set_flash('error', 'Produit introuvable');
        redirect('products');
    }
    
    // Supprimer l'image
    if ($product['image']) {
        delete_product_image($product['image']);
    }
    
    // Supprimer le produit
    if (delete_product($id)) {
        set_flash('success', 'Produit supprimé avec succès');
    } else {
        set_flash('error', 'Erreur lors de la suppression du produit');
    }
    
    redirect('products');
}
