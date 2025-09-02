<div class="container"> 
    <div class="page-header">
        <h1>Gestion des produits</h1>
        <a href="<?php echo url('products/create'); ?>" class="btn btn-primary">Nouveau produit</a>
    </div>

    <div class="content">
        <?php if (empty($products)): ?>
            <p>Aucun produit trouvé.</p>
        <?php else: ?>
            <div class="products-grid">
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <?php if ($product['image']): ?>
                            <img src="<?php echo url('uploads/products/' . $product['image']); ?>" alt="<?php echo esc($product['name']); ?>">
                        <?php else: ?>
                            <div class="no-image">Pas d'image</div>
                        <?php endif; ?>
                        
                        <div class="product-info">
                            <h3><?php echo esc($product['name']); ?></h3>
                            <p class="price"><?php echo number_format($product['price'], 2, ',', ' '); ?> €</p>
                            <p class="description"><?php echo esc($product['description']); ?></p>
                            
                            <div class="product-actions">
                                <a href="<?php echo url('products/edit/' . $product['id']); ?>" class="btn btn-secondary">Modifier</a>
                                <a href="<?php echo url('products/delete/' . $product['id']); ?>" 
                                   class="btn btn-secondary" 
                                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">Supprimer</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 2rem;
}

.product-card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    overflow: hidden;
}

.product-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.no-image {
    width: 100%;
    height: 200px;
    background: #f0f0f0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #666;
}

.product-info {
    padding: 1rem;
}

.product-info h3 {
    margin: 0 0 0.5rem 0;
}

.price {
    font-size: 1.2rem;
    font-weight: bold;
    color: #3b82f6;
    margin: 0.5rem 0;
}

.description {
    color: #666;
    margin: 0.5rem 0 1rem 0;
}

.product-actions {
    display: flex;
    gap: 0.5rem;
}
</style>
