<?php
if (!isset($products) || !is_array($products) || empty($products)) {
    return;
}

$chunked_products = array_chunk($products, 4);
?>

<style>
.product-slider-wrapper{
    overflow:hidden;
    width:100%;
}

.product-slider-track{
    display:flex;
    gap:20px;
    overflow-x:auto;
    scroll-snap-type:x mandatory;
    scroll-behavior:smooth;
    -webkit-overflow-scrolling:touch;
    scrollbar-width:none;
}

.product-slider-track::-webkit-scrollbar{
    display:none;
}

.product-slide{
    flex:0 0 calc(25% - 15px);
    scroll-snap-align:start;
}

@media(max-width:992px){
    .product-slide{
        flex:0 0 calc(33.33% - 14px);
    }
}

@media(max-width:768px){
    .product-slide{
        flex:0 0 calc(50% - 10px);
    }
}

@media(max-width:480px){
    .product-slide{
        flex:0 0 85%;
    }
}
</style>

<div class="product-slider-wrapper">
    <div class="product-slider-track">

        <?php foreach($products as $row): ?>

            <div class="product-slide">
                <?php
                $product_id = $row['id'];
                $product_name = $row['name'];
                $product_brand = $row['bname'];
                $product_category = $row['category'];

                include base_app . '/inc/product_card.php';
                ?>
            </div>

        <?php endforeach; ?>

    </div>
</div>