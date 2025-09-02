<?php

/**
 * Modèle Product - Gestion des produits
 */

/**
 * Récupère tous les produits
 */
function get_all_products()
{
    $query = "SELECT * FROM products ORDER BY created_at DESC";
    return db_select($query);
}

/**
 * Récupère un produit par son ID
 */
function get_product_by_id($id)
{
    $query = "SELECT * FROM products WHERE id = ? LIMIT 1";
    return db_select_one($query, [$id]);
}

/**
 * Crée un nouveau produit
 */
function create_product($name, $description, $price, $image = null)
{
    $query = "INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)";
    return db_execute($query, [$name, $description, $price, $image]);
}

/**
 * Met à jour un produit
 */
function update_product($id, $name, $description, $price, $image = null)
{
    if ($image) {
        $query = "UPDATE products SET name = ?, description = ?, price = ?, image = ? WHERE id = ?";
        return db_execute($query, [$name, $description, $price, $image, $id]);
    } else {
        $query = "UPDATE products SET name = ?, description = ?, price = ? WHERE id = ?";
        return db_execute($query, [$name, $description, $price, $id]);
    }
}

/**
 * Supprime un produit
 */
function delete_product($id)
{
    $query = "DELETE FROM products WHERE id = ?";
    return db_execute($query, [$id]);
}

/**
 * Upload d'image - Fonction simple et sécurisée
 */
function upload_product_image($file)
{
    // Vérifier qu'un fichier a été uploadé
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return false;
    }

    // Extensions autorisées
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    // Vérifier l'extension
    if (!in_array($file_extension, $allowed_extensions)) {
        return false;
    }

    // Vérifier la taille (max 5MB)
    if ($file['size'] > 5 * 1024 * 1024) {
        return false;
    }

    // Générer un nom unique
    $filename = uniqid() . '.' . $file_extension;
    $upload_path = PUBLIC_PATH . '/uploads/products/' . $filename;

    // Déplacer le fichier
    if (move_uploaded_file($file['tmp_name'], $upload_path)) {
        return $filename;
    }

    return false;
}

/**
 * Supprime une image du serveur
 */
function delete_product_image($filename)
{
    if ($filename) {
        $file_path = PUBLIC_PATH . '/uploads/products/' . $filename;
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }
}
