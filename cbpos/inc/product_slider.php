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

            $upload_path = base_app . '/uploads/product_' . $row['id'];

            $img = '';

            if(is_dir($upload_path)){

                $fileO = scandir($upload_path);

                if(isset($fileO[2])){

                    $img = 'uploads/product_' . $row['id'] . '/' . $fileO[2];

                }

            }

            $inventory = $conn->query("SELECT DISTINCT(price) FROM inventory WHERE product_id=".$row['id']." ORDER BY price ASC");

            $inv = [];

            while($ir = $inventory->fetch_assoc()){

                $inv[] = format_num($ir['price']);

            }

            $price = '';

            if(isset($inv[0])) $price = $inv[0];

            if(count($inv) > 1) $price .= ' ~ '.end($inv);
                $product_id = $row['id'];

            $product_name = $row['name'];

            $product_brand = $row['bname'];

            $product_category = $row['category'];

            $product_price = $price;

            $product_image = $img;

            ?>

            <div class="product-slide">

            <div class="product-slide">

    <?php include base_app.'/inc/product_card.php'; ?>

    <?php if(!empty($product_price)): ?>
    <div class="slider-price">
        $<?php echo $product_price; ?>
    </div>
    <?php endif; ?>

</div>

        <?php endforeach; ?>

    </div>
</div>

<script>
document.querySelectorAll('.product-slider-track').forEach(slider => {

    let isDown = false;
    let startX;
    let scrollLeft;

    slider.addEventListener('mousedown', e => {
        isDown = true;
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });

    slider.addEventListener('mouseleave', () => isDown = false);
    slider.addEventListener('mouseup', () => isDown = false);

    slider.addEventListener('mousemove', e => {
        if(!isDown) return;

        e.preventDefault();

        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 2;

        slider.scrollLeft = scrollLeft - walk;
    });
});
</script>