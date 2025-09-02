<div class="container">
    <div class="page-header">
        <h1>Modifier le produit</h1>
        <a href="<?php echo url('products'); ?>" class="btn btn-secondary">Retour</a>
    </div>

    <div class="content">
        <div class="form-container">
            <form action="<?php echo url('products/update/' . $product['id']); ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Nom du produit</label>
                    <input type="text" id="name" name="name" value="<?php echo esc($product['name']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4"><?php echo esc($product['description']); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="price">Prix (€)</label>
                    <input type="number" id="price" name="price" step="0.01" min="0" value="<?php echo $product['price']; ?>" required>
                </div>

                <?php if ($product['image']): ?>
                <div class="form-group">
                    <label>Image actuelle</label>
                    <div class="current-image">
                        <img src="<?php echo url('uploads/products/' . $product['image']); ?>" alt="<?php echo esc($product['name']); ?>">
                    </div>
                </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="image">Nouvelle image (optionnel)</label>
                    <input type="file" id="image" name="image" accept="image/*">
                    <small>Formats acceptés : JPG, PNG, GIF. Taille max : 5MB</small>
                </div>

                <button type="submit" class="btn btn-primary">Modifier le produit</button>
            </form>
        </div>
    </div>
</div>

<style>
.form-container {
    max-width: 600px;
    background: white;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.form-group small {
    display: block;
    color: #666;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.current-image img {
    max-width: 200px;
    height: auto;
    border-radius: 4px;
    border: 1px solid #ddd;
}
</style>
