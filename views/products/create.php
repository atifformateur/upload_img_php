<div class="container">
    <div class="page-header">
        <h1>Nouveau produit</h1>
        <a href="<?php echo url('products'); ?>" class="btn btn-secondary">Retour</a>
    </div>

    <div class="content">
        <div class="form-container">
            <form action="<?php echo url('products/store'); ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Nom du produit</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label for="price">Prix (€)</label>
                    <input type="number" id="price" name="price" step="0.01" min="0" required>
                </div>

                <div class="form-group">
                    <label for="image">Image du produit</label>
                    <input type="file" id="image" name="image" accept="image/*">
                    <small>Formats acceptés : JPG, PNG, GIF. Taille max : 5MB</small>
                </div>

                <button type="submit" class="btn btn-primary">Créer le produit</button>
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
</style>
