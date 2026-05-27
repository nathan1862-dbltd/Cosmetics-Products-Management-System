<?php
/**
 * Reusable product card for product listings and sliders.
 * Expected variables:
 * - $product_id, $product_name, $product_brand, $product_category, $product_price, $product_image
 */
?>
<a class="card product-item product-card text-reset text-decoration-none h-100"
   href=".?p=view_product&id=<?php echo md5($product_id) ?>">

    <div class="overflow-hidden shadow-sm product-holder product-card-media">
        <img class="card-img-top w-100 product-cover"
             src="<?php echo validate_image($product_image) ?>"
             alt="<?php echo htmlspecialchars($product_name, ENT_QUOTES) ?>" />
    </div>

    <div class="card-body p-3 d-flex flex-column">

        <p class="brand">
            <?php echo $product_brand ?>
        </p>

        <h5 class="product-title">
            <?php echo $product_name ?>
        </h5>

        <span class="product-price">
            <?php echo $product_price ?>
        </span>

    </div>
</a>